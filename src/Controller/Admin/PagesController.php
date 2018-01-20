<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 21:27
 */

namespace App\Controller\Admin;

use App\Entity\Page\DisplayOrder;
use App\Entity\Page\ListGroup;
use App\Entity\Page\PageRoute;
use App\Entity\Page\ParagraphText;
use App\Entity\Page\TextHeading\CssClass;
use App\Entity\Page\TextHeading\TextValue;
use App\Entity\Page\TextHeading\Type;
use App\Entity\Page\TextLead;
use App\Form\Admin\PageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {

        $form = $this->createForm(PageType::class, [
            'page_route'              => new PageRoute(),
            'page_stage'              => '',
            'text_heading_type'       => [new Type()],
            'text_heading_css_class'  => [new CssClass()],
            'text_heading_text_value' => [new TextValue()],
            'text_leading'            => [new TextLead()],
            'paragraph_text'          => [new ParagraphText()],
            'list_group'              => [new ListGroup()],
            'display_order'           => [new DisplayOrder()],
        ]);

        $templates = [
            'text_heading_type' => $form->get('text_heading_type')->createView(),
            'text_heading_css_class' => $form->get('text_heading_css_class')->createView(),
            'text_heading_text_value' => $form->get('text_heading_text_value')->createView(),
            'paragraph_text' => $form->get('paragraph_text')->createView(),
            'text_leading' => $form->get('text_leading')->createView(),
            'list_group' => $form->get('list_group')->createView(),
        ];

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
//                return $this->redirectToRoute('search');
            }
        }


        return $this->render('admin/pages.create.html.twig', array(
            'selectedNav' => 'admin-pages',
            'form'        => $form->createView(),
            'template' => $templates,
            'current_index' => end($form->getData()['display_order'])+1
        ));

    }
}
