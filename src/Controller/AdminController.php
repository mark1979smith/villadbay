<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 12:12
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AdminController
 *
 * @Route("/admin")
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin-home")
     */
    public function home()
    {
        return $this->render('admin/home.html.twig', array(
            'selectedNav' => 'admin-home'
        ));
    }

    /**
     * @Route("/page-manager", name="admin-pages")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pages()
    {
        return $this->render('admin/pages.html.twig', array(
            'selectedNav' => 'admin-pages'
        ));
    }
}
