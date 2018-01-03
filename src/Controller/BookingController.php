<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 02/01/2018
 * Time: 15:03
 */

namespace App\Controller;

use App\Entity\Availability;
use App\Entity\Booking;
use App\Entity\Search;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/booking/{_search}", name="booking")
     */
    public function home(Request $request)
    {
        // Validate request
        /** @var Search $results */
        $results = unserialize(base64_decode($request->get('_search')));
        if ($results instanceof Search) {
            /** @var Availability $availability */
            $availability = Availability::search($results);
            if ($availability->isAvailable()) {
                $booking = new Booking();
                $form = $this->createForm(BookingType::class, $booking);

                return $this->render('booking/home.html.twig', array(
                    'form'                 => $form->createView(),
                    'searchData'           => $results,
                    'availableData'        => $availability,
                    'disablePanoramicView' => true,
                    'selectedNav'          => 'rooms',
                ));
            } else {
                $this->addFlash('notice', 'Your selected dates are no longer available');
                return $this->redirectToRoute('search');
            }
        } else {
            return $this->redirectToRoute('search');
        }
    }
}
