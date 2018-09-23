<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 21:27
 */

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Entity\Page\DisplayOrder;
use App\Entity\Page\ListGroup;
use App\Entity\Page\PageRoute;
use App\Entity\Page\PanoramicImage;
use App\Entity\Page\ParagraphText;
use App\Entity\Page\TextHeading\SizeClass;
use App\Entity\Page\TextHeading\ColourClass;
use App\Entity\Page\TextHeading\AlignClass;
use App\Entity\Page\TextHeading\TextValue;
use App\Entity\Page\TextHeading\Type;
use App\Entity\Page\TextLead;
use App\Form\Admin\ApprovePageRevision;
use App\Form\Admin\DeletePageRevision;
use App\Form\Admin\PageType;
use App\Utils\Helpers\ScreenSize;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class PagesController
 *
 * @Route("/admin/pages")
 * @package App\Controller\Admin
 */
class PagesController extends Controller
{
    /**
     * @Route("/", name="admin-pages")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('admin/pages.html.twig', array(
            'selectedNav' => 'admin-pages',
        ));
    }

    /**
     * @Route("/new", name="admin-pages-create")
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\DependencyInjection\ContainerInterface                    $container
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, ContainerInterface $container, AuthorizationCheckerInterface $authorizationChecker)
    {

        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }


        $form = $this->createForm(PageType::class, [
            'page_route'                => new PageRoute(),
            'page_stage'                => '',
            'text_heading_type'         => [new Type()],
            'text_heading_size_class'   => [new SizeClass()],
            'text_heading_colour_class' => [new ColourClass()],
            'text_heading_align_class'  => [new AlignClass()],
            'text_heading_text_value'   => [new TextValue()],
            'text_leading'              => [new TextLead()],
            'paragraph_text'            => [new ParagraphText()],
            'list_group'                => [new ListGroup()],
            'panoramic_image'           => [new PanoramicImage()],
            'background_image'          => [new Page\BackgroundImage()],
            'form'                      => [new Page\Form()],
            'image_carousel'            => [new Page\Carousel()],
            'display_order'             => [new DisplayOrder()],
        ], [
            'container_interface' => $container,
        ]);

        $templates = [
            'text_heading_type'         => $form->get('text_heading_type')->createView(),
            'text_heading_size_class'   => $form->get('text_heading_size_class')->createView(),
            'text_heading_colour_class' => $form->get('text_heading_colour_class')->createView(),
            'text_heading_align_class'  => $form->get('text_heading_align_class')->createView(),
            'text_heading_text_value'   => $form->get('text_heading_text_value')->createView(),
            'paragraph_text'            => $form->get('paragraph_text')->createView(),
            'text_leading'              => $form->get('text_leading')->createView(),
            'list_group'                => $form->get('list_group')->createView(),
            'panoramic_image'           => $form->get('panoramic_image')->createView(),
            'background_image'          => $form->get('background_image')->createView(),
            'form'                      => $form->get('form')->createView(),
            'image_carousel'            => $form->get('image_carousel')->createView(),
        ];

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $route = $form->getData()['page_route']->getPageRoute();

                /** @var \App\Entity\Page $page */
                $page = $this->getDoctrine()
                    ->getRepository(Page::class)
                    ->findOneByLatestPage($route);

                if ($form->getData()['page_stage'] == 'options') {
                    if (null === $page || ($page instanceof Page && !$page->isPreview())) {
                        // Insert new record
                        $page = new Page();
                        $page->setRouteName($route);
                    }

                    $page->setData($form->getData());
                    $page->setPublish(new \DateTime());
                    $page->setPreview(true);
                }

                $em->persist($page);
                $em->flush();
                return $this->redirectToRoute($route, ['preview' => 1]);

            }


        }

        $index = end($form->getData()['display_order']);
        if ($index instanceof DisplayOrder) {
            $index = $index->__toString();
        }

        $deleteRevisionForm = $this->createForm(DeletePageRevision::class);

        return $this->render('admin/pages.create.html.twig', array(
            'selectedNav'   => 'admin-pages',
            'form'          => $form->createView(),
            'template'      => $templates,
            'current_index' => $index + 1,
            'dev_mode'      => getenv('DEV_MODE'),
            'delete_revision_form' => $deleteRevisionForm->createView()
        ));

    }

    /**
     * @Route("/get-page-data/{slug}",
     *     name="admin-page-data",
     *     defaults={"slug": ""}
     * )
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getLatestPage(Request $request)
    {
        /** @var \App\Entity\Page $homePage */
        $page = $this->getDoctrine()
            ->getRepository(Page::class)
            ->findOneByLatestPage($request->get('slug'));

        $pageData = [];
        if ($page) {
            $dbData = $page->getData();
            $pageData = [
                'page_type'               => $dbData['page_type']->getPageType(),
                'page_route'              => $dbData['page_route']->getPageRoute(),
                'page_stage'              => '',
                'text_heading_type'       => [
                    'text_heading_type'         => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_type']) ? $dbData['text_heading_type'] : [])),
                    'text_heading_size_class'   => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_size_class']) ? $dbData['text_heading_size_class'] : [])),
                    'text_heading_colour_class' => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_colour_class']) ? $dbData['text_heading_colour_class'] : [])),
                    'text_heading_align_class'  => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_align_class']) ? $dbData['text_heading_align_class'] : [])),
                    'text_heading_text_value'   => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_text_value']) ? $dbData['text_heading_text_value'] : [])),
                ],
                'text_leading'            => array_map(function($obj){ return $obj->getTextValue();}, (isset($dbData['text_leading']) ? $dbData['text_leading'] : [])),
                'paragraph_text'          => array_map(function($obj){ return $obj->getTextValue();}, (isset($dbData['paragraph_text']) ? $dbData['paragraph_text'] : [])),
                'list_group'              => array_map(function($obj){ return $obj->getListItems();}, (isset($dbData['list_group']) ? $dbData['list_group'] : [])),
                'panoramic_image'         => array_map(function($obj){ return $obj->getPanoramicImage(new ScreenSize(ScreenSize::EXTRA_LARGE));}, (isset($dbData['panoramic_image']) ? $dbData['panoramic_image'] : [])),
                'background_image'        => array_map(function($obj){ return $obj->getBackgroundImage(new ScreenSize(ScreenSize::EXTRA_LARGE));}, (isset($dbData['background_image']) ? $dbData['background_image'] : [])),
                'display_order'           => $dbData['display_order'],
                'form'                    => (isset($dbData['form']) ? $dbData['form'] : []),
                'image_carousel'          => array_map(function($obj){ return $obj->getId();}, (isset($dbData['image_carousel']) ? $dbData['image_carousel'] : [])),
                'page_preview'            => $page->isPreview(),
            ];
        }

        return $this->json($pageData);
    }

    /**
     * @Route("/progress-revision", name="admin-progress-revision")
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function approveRevision(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $form = $this->createForm(ApprovePageRevision::class, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            // If APPROVE button clicked
            if ($form->get('approve')->isClicked()) {
                /** @var \App\Entity\Page $page */
                $page = $this->getDoctrine()
                    ->getRepository(Page::class)
                    ->findOneByLatestPage($formData['slug']);

                $page->setPreview(false);

                $em = $this->getDoctrine()->getManager();
                $em->persist($page);
                $em->flush();

                $this->addFlash(
                    'admin-success',
                    'Your changes were published!'
                );

                return $this->redirectToRoute('admin-pages-create');
            }

            // If DECLINE button clicked
            if ($form->get('decline')->isClicked()) {

                $this->addFlash(
                    'admin-notice',
                    'Your changes were not published!'
                );
                return $this->redirectToRoute('admin-pages-create');
            }
        }
    }

    /**
     * @Route("/delete-revision", name="admin-delete-revision")
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteRevision(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        $form = $this->createForm(DeletePageRevision::class, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            /** @var \App\Entity\Page $page */
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByLatestPage($formData['slug']);

            // Only allow deleting of un-published revisions
            if ($page->isPreview()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($page);
                $em->flush();

                $this->addFlash(
                    'admin-success',
                    'This page revision has been deleted'
                );
            } else {
                $this->addFlash(
                    'admin-info',
                    'This page revision could not be deleted because it was published'
                );
            }

            return $this->redirectToRoute('admin-pages-create');
        }
    }
}
