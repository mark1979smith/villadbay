<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 21/12/2017
 * Time: 11:59
 */

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Search;
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
    public function rooms(Request $request)
    {

        $search = new Search();

        $form = $this->createFormBuilder($search)
            ->add('date_start', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'placeholder' => 'Please select a date',
                'label' => 'Check-In',
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d'),
                    'max' => (new \DatetIme('+15 years 6 months'))->format('Y-m-d')
                ]
            ])
            ->add('date_end', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'placeholder' => 'Please select a date',
                'label' => 'Check-Out',
                'attr' => [
                    'min' => (new \DateTime('+1 day'))->format('Y-m-d'),
                    'max' => (new \DatetIme('+16 years'))->format('Y-m-d')
                ]
            ])
            ->add('adult_count', IntegerType::class, [
                'grouping' => true,
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_UP,
                'label' => 'How many Adults?',
                'attr' => [
                    'min' => '0',
                    'max' => '10'
                ],
                'data' => '0'
            ])
            ->add('child_count', IntegerType::class, [
                'grouping' => true,
                'scale' => 0,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_UP,
                'label' => 'How many Children?',
                'attr' => [
                    'min' => '0',
                    'max' => '10'
                ],
                'data' => '0'
            ])
            ->add('search', SubmitType::class, ['label' => 'Search'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            var_dump($search); exit;
        }
        return $this->render('pages/rooms.html.twig', array(
            'form' => $form->createView(),
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
