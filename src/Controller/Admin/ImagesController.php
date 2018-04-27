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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(Request $request)
    {

        $twigData = [];

        $twigData['imageTypes'] = $this->getImageTypes();

        /** @var \App\Utils\Redis $redisService */
        $redisService = $this->container->get('app.redis');
        $redisClient = $redisService->get();
        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $this->container->get('app.aws.s3');

        $awsListingData = [];

        foreach ($twigData['imageTypes'] as $imageType) {
            $coreData = [
                'Prefix'     => 'images/'. $imageType,
                'Bucket'     => $s3Service->getBucket(),
                'MaxKeys'    => 100,
                'StartAfter' => 'images/'. $imageType .'/',
            ];

            $cacheKey = 'aws.s3.listobjects.' . $s3Service->getBucket() . '-' . md5(serialize($coreData));
            if ($redisClient->hasItem($cacheKey)) {
                /** \Aws\Result $results */
                $results = $redisClient->getItem($cacheKey)->get();
                $twigData['objects'] = $results;
            } else {
                $s3Client = $s3Service->get();

                $isTruncated = false;
                $page = 1;
                $awsListingData[$imageType] = [];

                // Build up the assets list available on AWS S3
                do {
                    $response = $s3Client->listObjectsV2($coreData);
                    if ($response instanceof \Aws\Result) {
                        $isTruncated = $response->get('IsTruncated');
                        if (is_iterable($response->get('Contents'))) {
                            foreach ($response->get('Contents') as $asset) {
                                // Only return assets which are lowercase
                                if (strcmp($asset['Key'], strtolower($asset['Key'])) === 0) {
                                    $headers = $s3Client->headObject(['Bucket' => $s3Service->getBucket(), 'Key' => $asset['Key']]);
                                    $awsListingData[$imageType][] = array_merge($asset, ['DisplayKey' => basename($asset['Key']), 'Metadata' => $headers->get('Metadata')]);
                                }
                            }
                        }
                    }

                    if ($isTruncated) {
                        $coreData['ContinuationToken'] = $response->get('NextContinuationToken');
                    } else {
                        unset($coreData['ContinuationToken']);
                    }

                    $page++;
                } while ($isTruncated === true);
                $twigData['objects'] = $awsListingData;
            }
        }


        return $this->render('admin/images.list.html.twig', $twigData);
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
        switch ($imageType) {
            case Type::TYPE_PANORAMIC:
                $dirPrefix = 'pano';
                $settings = [
                    'lg' => [
                        'width'   => 1199,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 991,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 767,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 575,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                ];
                break;
            case Type::TYPE_BACKGROUND:
                $dirPrefix = 'backgrounds';
                $settings = [
                    'lg' => [
                        'width'   => 1199,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 991,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 767,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 575,
                        'rows'    => null,
                        'bestfit' => false,
                    ],
                ];
                break;

            case Type::TYPE_CAROUSEL:
                $dirPrefix = 'carousel';
                $settings = [
                    'lg' => [
                        'width'   => 930,
                        'rows'    => 800,
                        'bestfit' => false,
                    ],
                    'md' => [
                        'width'   => 690,
                        'rows'    => 594,
                        'bestfit' => false,
                    ],
                    'sm' => [
                        'width'   => 510,
                        'rows'    => 439,
                        'bestfit' => false,
                    ],
                    'xs' => [
                        'width'   => 290,
                        'rows'    => 249,
                        'bestfit' => false,
                    ],
                ];
                break;
        }
        /** @var \App\Utils\AwsS3Client $s3Service */
        $s3Service = $this->container->get('app.aws.s3');
        $s3Client = $s3Service->get();

        $imagick = new \Imagick($file->getPathname());
        $imagick->setImageCompressionQuality(80);

        $s3Client->putObject([
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
                $s3Client->putObject([
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
        $redisClient = $redisService->get();

        $response = $s3Client->listObjectsV2([
            'Bucket' => $s3Service->getBucket(),
        ]);

        $cacheKey = 'aws.s3.listobjects.' . $s3Service->getBucket();
        $cacheItem = $redisClient->getItem($cacheKey);
        $cacheItem->set($response);

        $redisClient->save($cacheItem);
    }
}
