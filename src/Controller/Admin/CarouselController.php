<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 13/05/2018
 * Time: 20:43
 */

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CarouselController
 *
 * @Annotation
 * @Route("/admin/carousel")
 * @package App\Controller\Admin
 */
class CarouselController extends Controller
{
    private $selectedNav = 'admin-carousel';

    /**
     * @Route("/", name="admin-carousel")
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));
    }

    /**
     * @Route("/create", name="admin-carousel-create")
     */
    public function create(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.create.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));

    }

    /**
     * @Route("/view", name="admin-carousel-list")
     */
    public function list(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }

        return $this->render('admin/carousel.list.html.twig', array(
            'selectedNav' => $this->selectedNav,
        ));

    }
}
