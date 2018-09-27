<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 15/01/2018
 * Time: 12:12
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
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
}
