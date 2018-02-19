<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 21/12/2017
 * Time: 11:59
 */

namespace App\Controller;

use App\Entity\Availability;
use App\Entity\Contact;
use App\Entity\Page;
use App\Entity\Search;
use App\Form\Search as SearchForm;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;

class PagesController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(Request $request)
    {
        $viewData = $this->defineViewData($request);

        return $this->render('pages/home.html.twig', $viewData);
    }

    /**
     * @Route("/search-availability", name="search")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $viewData = $this->defineViewData($request);

        $form = $this->getSearchForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            $viewData['searchData'] = Availability::search($search);
            $viewData['searchDataSerialised'] = base64_encode(serialize($search));
            $viewData['form_search'] = $form->createView();
        }



        return $this->render('pages/search.html.twig', $viewData);
    }

    /**
     * @Route("/about", name="about")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about(Request $request)
    {
        $viewData = $this->defineViewData($request);

        return $this->render('pages/about.html.twig', $viewData);
    }

    /**
     * @Route("/contact-us", name="contact")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(Request $request)
    {
        $viewData = $this->defineViewData($request);

        $form = $this->getContactForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $viewData['form_contact'] = $form->createView();
        }


        return $this->render('pages/contact.html.twig', $viewData);
    }

    /**
     * Define View Data for Current Page
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function defineViewData(Request $request): array
    {
        $route = $request->attributes->get('_route');
        if ($request->getQueryString('preview')) {
            /** @var \App\Entity\Page $page */
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByLatestPage($route);

        } else {
            /** @var \App\Entity\Page $page */
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByLatestPublishedPage($route);
        }

        $viewData = [];
        if (null !== $page) {
            $viewData['selectedNav'] = $route;
            $viewData['disablePanoramicView'] = true;

            $pageContent = $page->__toString();
            $viewData['page'] = $pageContent;
            $viewData['styles'] = $page->__toStyles();

            if (preg_match('/#search-form#/', $pageContent)) {
                $form = $this->getSearchForm();

                $viewData['form_search'] = $form->createView();
            }

            if (preg_match('/#contact-form#/', $pageContent)) {
                $form = $this->getContactForm();

                $viewData['form_contact'] = $form->createView();
            }
        }

        return $viewData;
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getSearchForm(): \Symfony\Component\Form\FormInterface
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search, ['action' => $this->generateUrl('search')]);

        return $form;
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getContactForm(): \Symfony\Component\Form\FormInterface
    {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('subject', TextType::class, [
                'required' => false
            ])
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Send'])
            ->getForm();

        return $form;
    }
}
