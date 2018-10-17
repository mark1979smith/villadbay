<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 17/10/2018
 * Time: 08:23
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('user/login.html.twig');
    }
}
