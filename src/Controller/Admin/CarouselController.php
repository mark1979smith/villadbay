<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 13/05/2018
 * Time: 20:43
 */

namespace App\Controller\Admin;

use App\Entity\Carousel;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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


        $carousel = new Carousel();
        $form = $this->createFormBuilder($carousel)
            ->add('name', TextType::class, [
                'label' => 'Name',
                'help' => 'Must be unique',
                'required' => true
            ])
            ->add('description', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Create carousel'])
            ->getForm();

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
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/view", name="admin-carousel-list")
     */
    public function list(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.list.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));

    }

    /**
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     * @Route("/edit/{id}", name="admin-carousel-edit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.list.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));

    }
}
