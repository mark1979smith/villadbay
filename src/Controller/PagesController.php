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

class PagesController
{
    /**
     * @Route("/")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number: '. $number .'</body></html>'
        );
    }
}
