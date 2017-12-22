<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 21/12/2017
 * Time: 11:59
 */

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PagesController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        $number = mt_rand(0, 1000);

        return $this->render('pages/home.html.twig', array(
            'number' => $number,
            'selectedNav' => 'home'
        ));
    }

    /**
     * @Route("/rooms", name="rooms")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rooms()
    {
        $number = mt_rand(0, 1000);

        return $this->render('pages/rooms.html.twig', array(
            'number' => $number,
            'selectedNav' => 'rooms'
        ));
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
     * @Route("/contact", name="contact")
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
            ->add('subject', TextType::class)
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
