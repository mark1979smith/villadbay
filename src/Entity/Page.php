<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:13
 */

namespace App\Entity;

/**
 * Class Page
 *
 * @package App\Entity\Admin
 * @ORM\Entity
 * @Table(name="pages",indexes={@Index(name="route_name", columns={"route_name"})})
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $routeName;

    /**
     * @ORM\Column(type="json_array")
     * @var string
     */
    private $data;

}
