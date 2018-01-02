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
    public function home()
    {
        $search = new Search();

        $form = $this->createForm(SearchType::class, $search, ['action' => $this->generateUrl('search')]);
        return $this->render('pages/home.html.twig', array(
            'disablePanoramicView' => true,
            'form' => $form->createView(),
            'selectedNav' => 'home'
        ));
    }

    /**
     * @Route("/search-availability", name="search")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {

        $search = new Search();

        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        $returnedData = [
            'selectedNav' => 'rooms'
        ];
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            $returnedData['searchData'] = Availability::search($search);
        }
        $returnedData['form'] = $form->createView();

        return $this->render('pages/search.html.twig', $returnedData);
    }

    /**
     * @Route("/about", name="about")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about()
    {
        $number = mt_rand(0, 1000);

        return $this->render('pages/about.html.twig', array(
            'number' => $number,
            'selectedNav' => 'about'
        ));
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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

        }

        return $this->render('pages/contact.html.twig', array(
            'form' => $form->createView(),
            'selectedNav' => 'contact'
        ));
    }
}
