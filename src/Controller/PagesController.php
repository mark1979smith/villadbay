<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 21/12/2017
 * Time: 11:59
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact()
    {
        $number = mt_rand(0, 1000);

        return $this->render('pages/contact.html.twig', array(
            'number' => $number,
            'selectedNav' => 'contact'
        ));
    }
}
