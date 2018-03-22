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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class PagesController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $viewData = $this->defineViewData($request, $authorizationChecker);

        return $this->render('pages/home.html.twig', $viewData);
    }

    /**
     * @Route("/search-availability", name="search")
     *
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $viewData = $this->defineViewData($request, $authorizationChecker);

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
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $viewData = $this->defineViewData($request, $authorizationChecker);

        return $this->render('pages/about.html.twig', $viewData);
    }

    /**
     * @Route("/contact-us", name="contact")
     *
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(Request $request, AuthorizationCheckerInterface $authorizationChecker)
    {
        $viewData = $this->defineViewData($request, $authorizationChecker);

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
     * @param \Symfony\Component\HttpFoundation\Request                                    $request
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return array
     */
    protected function defineViewData(Request $request, AuthorizationCheckerInterface $authorizationChecker): array
    {
        $route = $request->attributes->get('_route');
        $viewData = [];
        if ($request->getQueryString('preview')) {
            /** @var \App\Entity\Page $page */
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByLatestPage($route);

            $approvePageForm = $this
                ->createForm(\App\Form\Admin\ApprovePageRevision::class, ['slug' => $route])
                ->createView();

            $viewData['preview_mode'] = ((false !== $authorizationChecker->isGranted('ROLE_ADMIN')) && $request->getQueryString('preview'));
            $viewData['preview_mode_form'] = ((false !== $authorizationChecker->isGranted('ROLE_ADMIN')) && $request->getQueryString('preview') ? $approvePageForm : null);
        } else {
            /** @var \App\Entity\Page $page */
            $page = $this->getDoctrine()
                ->getRepository(Page::class)
                ->findOneByLatestPublishedPage($route);
        }


        if (null !== $page) {
            $viewData['selectedNav'] = $route;

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
