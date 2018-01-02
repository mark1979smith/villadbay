<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/01/2018
 * Time: 15:03
 */

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BookingController
 *
 * @package App\Controller
 */
class BookingController extends Controller
{
    /**
     * @Route("/booking", name="booking")
     */
    public function home()
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        return $this->render('booking/home.html.twig', array(
            'form' => $form->createView(),
            'disablePanoramicView' => true,
        ));
    }
}
