<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/03/2018
 * Time: 09:59
 */

namespace App\Controller\Admin;

use App\Component\ImageTypes;
use App\Entity\Image\Type;
use App\Form\Admin\ImageTypesType;
use Aws\S3\S3Client;
use function GuzzleHttp\default_ca_bundle;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Imagick;

/**
 * Class ImagesController
 *
 * @Route("/admin/images")
 * @package App\Controller\Admin
 */
class ImagesController extends Controller
{
    use ImageTypes;

    /**
     * @Route("/", name="admin-images")
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/images.html.twig', array(
            'selectedNav' => 'admin-images',
        ));
    }

    /**
     * @Route("/create/{type}", name="admin-images-create", defaults={"type":""})
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\DependencyInjection\ContainerInterface                    $container
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \ImagickException
     */
    public function create(
        Request $request,
        ContainerInterface $container,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        if ($request->get('type') === "") {
            $form = $this->createForm(ImageTypesType::class, new Type());

            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()) {
                return $this->redirectToRoute('admin-images-create', ['type' => $form->get('value')->getNormData()]);
            }
        } else {
            $imageType = strtolower($request->get('type'));
            switch ($imageType) {
                case Type::TYPE_BACKGROUND:
                    $entity = new Type\Background();
                    $form = $this->createFormBuilder($entity)
                        ->add('file', FileType::class, [
                            'label' => 'Choose an image to upload',
                            'attr'  => [
                                'description' => 'Requirements: 1,200px minimum width and 1,200px minimum height.',
                            ],
                        ]);
                    break;
                case Type::TYPE_CAROUSEL:
                    $entity = new Type\Carousel();
                    $form = $this->createFormBuilder($entity)
                        ->add('file', FileType::class, [
                            'label' => 'Choose an image to upload',
                            'attr'  => [
                                'description' => 'Requirements: Width: 1,110px. Height: 955px.',
                            ],
                        ]);
                    break;
                case Type::TYPE_PANORAMIC:
                    $entity = new Type\Panoramic();
                    $form = $this->createFormBuilder($entity)
                        ->add('file', FileType::class, [
                            'label' => 'Choose an image to upload',
                            'attr'  => [
                                'description' => 'Requirements: Landscape images only with a minimum width of 1,200px.',
                            ],
                        ]);
                    break;
                default:
                    throw new \LogicException('Illegal type detected');
            }
            $form = $form->add('upload', SubmitType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $entity->getFile();

                $fileName = $this->generateUniqueFileName();
                $fileNameExt = $file->guessExtension();

                $this->sendImageToAWS($request->get('type'), $file, $fileName, $fileNameExt);

                $this->addFlash('admin-success', 'Your image ('. $file->getClientOriginalName() .') has been uploaded successfully');
            }
        }


        $twigData = array(
            'selectedNav' => 'admin-images',
            'form'        => $form->createView(),
        );
        if (isset($imageType)) {
            $twigData['image-type'] = $imageType;
        }

        return $this->render('admin/images.create.html.twig', $twigData);
    }

    /**
     * @Route("/list", name="admin-images-list")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $twigData = [];

        $twigData['imageTypes'] = $this->getImageTypes();

        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $this->container->get('app.aws.s3');

        $awsListingData = [];

        $awsData = $s3Service->getImagesBasedOnConfig();

        foreach ($twigData['imageTypes'] as $imageType) {
            foreach ($awsData as $data) {
                if (preg_match('/^'. preg_quote('images/' . $this->getImageTypeDirectory($imageType) .'/', '/') .'/', $data['Key'])) {
                    $awsListingData[$imageType][] = $data;
                }
            }
        }

        $twigData['objects'] = $awsListingData;


        return $this->render('admin/images.list.html.twig', $twigData);
    }

    /**
     * @Route("/delete/{key}", name="admin-images-delete", methods={"POST"})
     */
    public function delete($key)
    {
        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $this->container->get('app.aws.s3');
        $s3Service->deleteImages(substr(base64_decode($key), 0, strrpos(base64_decode($key), '.')));

        $this->addFlash('success', 'The image has been deleted');

        return $this->redirectToRoute('admin-images-list');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @param                                                     $imageType
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string                                              $fileName Thumbnails will use this as a directory followed by a child directory lg, md, sm, xs
     * @param string                                              $fileNameExt
     *
     * @throws \ImagickException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    private function sendImageToAWS($imageType, $file, $fileName, $fileNameExt)
    {
        $dirPrefix =  $this->getImageTypeDirectory($imageType);
        $settings = $this->getImageTypesSettings($imageType);

        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $this->container->get('app.aws.s3');

        $imagick = new \Imagick($file->getPathname());
        $imagick->setImageCompressionQuality(80);

        $s3Service->putObject([
            'Bucket'        => $s3Service->getBucket(),
            'Key'           => 'images/' . $dirPrefix . '/' . $fileName . '.' . $fileNameExt,
            'Body'          => $imagick->getImageBlob(),
            'ACL'           => 'public-read',
            'Metadata' => [
                'filename' => $file->getClientOriginalName()
            ]
        ]);

        if (isset($settings)) {
            foreach ($settings as $responsiveSizeClass => $thumbnailSettings) {
                $imagick->scaleImage($thumbnailSettings['width'], $thumbnailSettings['rows'], $thumbnailSettings['bestfit']);
                $s3Service->putObject([
                    'Bucket'  => $s3Service->getBucket(),
                    'Key'     => 'images/' . $dirPrefix . '/' . $fileName . '--' . $responsiveSizeClass . '.' . $fileNameExt,
                    'Body'    => $imagick->getImageBlob(),
                    'ACL'     => 'public-read',
                    'Metadata' => [
                        'parent' => 'images/' . $dirPrefix . '/' . $fileName . '.' . $fileNameExt
                    ]
                ]);
            }
        }

        /** @var \App\Utils\Redis $redisService */
        $redisService = $this->container->get('app.redis');
        $redisService->invalidateTag($s3Service::CACHE_TAG_ASSET_LIST);

        $s3Service->getImagesBasedOnConfig();
    }
}
