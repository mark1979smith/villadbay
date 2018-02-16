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
use App\Form\Admin\PageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

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
     * @param \Symfony\Component\HttpFoundation\Request                 $request
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, ContainerInterface $container)
    {

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
                    if (!$page->isPreview()) {
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

        return $this->render('admin/pages.create.html.twig', array(
            'selectedNav'   => 'admin-pages',
            'form'          => $form->createView(),
            'template'      => $templates,
            'current_index' => $index + 1,
            'dev_mode'      => getenv('DEV_MODE'),
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
                    'text_heading_type'         => array_map(function($obj){ return $obj->getValue();}, $dbData['text_heading_type']),
                    'text_heading_size_class'   => array_map(function($obj){ return $obj->getValue();}, $dbData['text_heading_size_class']),
                    'text_heading_colour_class' => array_map(function($obj){ return $obj->getValue();}, $dbData['text_heading_colour_class']),
                    'text_heading_align_class'  => array_map(function($obj){ return $obj->getValue();}, (isset($dbData['text_heading_align_class']) ? $dbData['text_heading_align_class'] : [])),
                    'text_heading_text_value'   => array_map(function($obj){ return $obj->getValue();}, $dbData['text_heading_text_value']),
                ],
                'text_leading'            => array_map(function($obj){ return $obj->getTextValue();}, $dbData['text_leading']),
                'paragraph_text'          => array_map(function($obj){ return $obj->getTextValue();}, $dbData['paragraph_text']),
                'list_group'              => array_map(function($obj){ return $obj->getListItems();}, $dbData['list_group']),
                'panoramic_image'         => array_map(function($obj){ return $obj->getPanoramicImage();}, $dbData['panoramic_image']),
                'background_image'        => array_map(function($obj){ return $obj->getBackgroundImage();}, $dbData['background_image']),
                'display_order'           => $dbData['display_order'],
                'page_preview'            => $page->isPreview(),
            ];
        }

        return $this->json($pageData);
    }
}
