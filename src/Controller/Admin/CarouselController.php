<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 13/05/2018
 * Time: 20:43
 */

namespace App\Controller\Admin;

use App\Entity\CarouselContainer;
use App\Entity\CarouselSlides;
use App\Form\Admin\CarouselSlideType;
use App\Form\Admin\CarouselType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CarouselController
 *
 * @Annotation
 * @Route("/admin/carousel")
 * @package App\Controller\Admin
 */
class CarouselController extends Controller
{
    private $selectedNav = 'admin-carousel';

    /**
     * @Route("/", name="admin-carousel")
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));
    }

    /**
     * @Route("/create", name="admin-carousel-create")
     */
    public function create(AuthorizationCheckerInterface $authorizationChecker, Request $request)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }


        $carousel = new CarouselContainer();
        $form = $this->createForm(CarouselType::class, $carousel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $entity = $form->getData();
            try {
                $em->persist($entity);
                $em->flush();

                $msg = <<<MSG
                    Your carousel has been created successfully. <a href="{$this->generateUrl('admin-carousel-edit', ['id' => $entity->getId()], UrlGeneratorInterface::ABSOLUTE_URL)}">
                    Would you like to add to it</a>?
MSG;
                $this->addFlash('admin-success', $msg);

            } catch (ORMException $e) {
                $this->addFlash('admin-notice', 'There was a problem saving the Carousel');
            } finally {
                return $this->redirectToRoute('admin-carousel');
            }

        }


        return $this->render('admin/carousel.create.html.twig', array(
            'selectedNav' => $this->selectedNav,
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/view", name="admin-carousel-list")
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     * @param \Doctrine\ORM\EntityManagerInterface $em
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list(AuthorizationCheckerInterface $authorizationChecker, EntityManagerInterface $em, Request $request)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }


        $carousel = $em->getRepository(CarouselContainer::class);
        $carousels = $carousel->findAll();

        $twigOptions =  [
            'selectedNav' => $this->selectedNav,
            'carousels' => $carousels,
        ];

        if (count($carousels) > 0) {
            $deleteCarouselForm = $this->createFormBuilder(new CarouselContainer())
                ->getForm();

            $twigOptions['deleteForm'] = $deleteCarouselForm->createView();
        }

        return $this->render('admin/carousel.list.html.twig', $twigOptions);

    }

    /**
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     * @param \Doctrine\ORM\EntityManagerInterface                                         $em
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edit/{id}", name="admin-carousel-edit")
     */
    public function edit(AuthorizationCheckerInterface $authorizationChecker, EntityManagerInterface $em, Request $request)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $carouselRepo = $em->getRepository(CarouselContainer::class);
        /** @var CarouselContainer $carousel */
        $carousel = $carouselRepo->find($request->get('id'));

        $form = $this->createForm(CarouselType::class, $carousel);


        $newSlideForm = $this->createForm(CarouselSlideType::class, new CarouselSlides(), [
            'service_redis' => $this->container->get('app.redis'),
            'service_aws_s3' => $this->container->get('app.aws.s3'),
            'submit_button_label' => 'Create carousel slide'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $entity = $form->getData();
            try {
                $em->persist($entity);
                $em->flush();

                $msg = <<<'MSG'
                    Your carousel has been edited successfully.
MSG;
                $this->addFlash('admin-success', $msg);

            } catch (ORMException $e) {
                $this->addFlash('admin-notice', 'There was a problem saving the Carousel');
            } finally {
                return $this->redirectToRoute('admin-carousel');
            }

        }


        $carouselSlideForms = [];
        foreach ($carousel->getCarouselSlides() as $carouselSlide) {
            $existingSlideForm = $this->createForm(CarouselSlideType::class, $carouselSlide, [
                'service_redis' => $this->container->get('app.redis'),
                'service_aws_s3' => $this->container->get('app.aws.s3'),
            ]);
            $carouselSlideForms[] = $existingSlideForm->createView();
        }
        return $this->render('admin/carousel.edit.html.twig', [
            'selectedNav'        => $this->selectedNav,
            'carousel'           => $carousel,
            'carouselSlideForms' => $carouselSlideForms,
            'form'               => $form->createView(),
            'newSlideForm'       => $newSlideForm->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin-carousel-delete", methods={"POST"})
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(AuthorizationCheckerInterface $authorizationChecker, EntityManagerInterface $em, Request $request)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $carouselRepository = $em->getRepository(CarouselContainer::class);
        $carousel = $carouselRepository->find($request->get('id'));
        if ($carousel) {
            $em->remove($carousel);
            $em->flush();
            $this->addFlash('admin-success', 'The carousel has been deleted');
        } else {
            $this->addFlash('admin-error', 'The carousel could not be deleted. Has it already been deleted?');
        }

        return $this->redirectToRoute('admin-carousel-list');
    }
}
