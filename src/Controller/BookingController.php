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
use Doctrine\ORM\EntityManagerInterface;
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
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Doctrine\ORM\EntityManagerInterface      $entityManager
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function home(Request $request, EntityManagerInterface $entityManager)
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

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    /** @var \App\Entity\Booking $bookingData */
                    $bookingData = $form->getData();
                    $booking->setTimeOfArrival($bookingData->getTimeOfArrival())
                        ->setContactName($bookingData->getContactName())
                        ->setContactAddress($bookingData->getContactAddress())
                        ->setAlternativeContactNumber($bookingData->getAlternativeContactNumber())
                        ->setFaxNumber($bookingData->getFaxNumber())
                        ->setEmailAddress($bookingData->getEmailAddress())
                        ->setCheckIn($availability->getDateStart())
                        ->setCheckOut($availability->getDateEnd())
                        ->setAdults($results->getAdultCount())
                        ->setChildren($results->getChildCount())
                        ->setTotalPrice($availability->getPrice());

                    $entityManager->persist($booking);

                    $entityManager->flush();

                    return $this->redirectToRoute('booking-thanks');

                }

                return $this->render('booking/home.html.twig', array(
                    'form'                 => $form->createView(),
                    'searchData'           => $results,
                    'availableData'        => $availability,
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

    /**
     * @Route("/booking-thanks", name="booking-thanks")
     */
    public function thanks()
    {
        return $this->render('booking/thanks.html.twig', []);
    }
}
