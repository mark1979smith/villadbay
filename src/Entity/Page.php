<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 14/01/2018
 * Time: 19:13
 */

namespace App\Entity;


use App\Component\Page\TextHeading;
use App\Utils\Helpers\Data;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;

/**
 * Class Page
 *
 * @package App\Entity\Admin
 * @ORM\Entity
 * @Table(name="pages",indexes={@Index(name="route_name", columns={"route_name"})})
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
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
     * @var array
     */
    private $data;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @var \DateTime
     */
    private $publish;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $preview;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     *
     * @return Page
     */
    public function setRouteName(string $routeName): Page
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        asort($this->data['display_order'], SORT_REGULAR);
        foreach ($this->data as $key => $row) {
            if (is_array($row)) {
                foreach ($row as $k => $v) {
                    if (Data::isSerializedObject($v)) {
                        $this->data[$key][$k] = Data::convertToObject($v);
                    }
                }
            } elseif (Data::isSerializedObject($row)) {
                $this->data[$key] = Data::convertToObject($row);
            }
        }

        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return Page
     */
    public function setData(array $data): Page
    {
        foreach ($data as $key => $row) {
            if (is_array($row)) {
                foreach ($row as $k => $v) {
                    if (is_object($v)) {
                        if ($v instanceof TextHeading\TextValue) {
                            $data['text_heading'][$k] = serialize(
                                (new TextHeading())
                                    ->setSizeClass(Data::convertToObject($data['text_heading_size_class'][$k]))
                                    ->setColourClass(Data::convertToObject($data['text_heading_colour_class'][$k]))
                                    ->setAlignClass(Data::convertToObject($data['text_heading_align_class'][$k]))
                                    ->setType(Data::convertToObject($data['text_heading_type'][$k]))
                                    ->setTextValue(Data::convertToObject($data['text_heading_text_value'][$k]))
                            );
                        }
                        $data[$key][$k] = serialize($v);
                    }
                }
            } elseif (is_object($row)) {
                $data[$key] = serialize($row);
            }
        }
        $this->data = $data;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPublish(): \DateTime
    {
        return $this->publish;
    }

    /**
     * @param \DateTime $publish
     *
     * @return Page
     */
    public function setPublish(\DateTimeImmutable $publish): Page
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPreview(): bool
    {
        return $this->preview;
    }

    /**
     * @param bool $preview
     *
     * @return Page
     */
    public function setPreview(bool $preview): Page
    {
        $this->preview = $preview;

        return $this;
    }


    public function __toString()
    {

        $html = '';
        foreach ($this->getData()['display_order'] as $key => $order) {
            $keyParts = explode('--', $key);
            if (preg_match('/^text_heading_text_value/', $key)) {
                if (preg_match('/^</', $this->getData()['text_heading'][$keyParts[1]])) {
                    $html .= $this->getData()['text_heading'][$keyParts[1]];
                    continue;
                }
            } elseif (!preg_match('/^text_heading_/', $key)) {
                if (stristr($key, '--')) {
                    /** @var object|string $object */
                    $object = $this->getData()[$keyParts[0]][$keyParts[1]];
                    if (is_object($object)) {
                        if (method_exists($object, '__toString')) {
                            $html .= $object->__toString();
                            continue;
                        }
                    } else {
                        $html .= '#' . $object . '#';
                    }
                }
            }

        }

        return $html;
    }

    public function __toStyles()
    {
        $styles = [];
        foreach ($this->getData()['display_order'] as $key => $order) {
            if (stristr($key, '--')) {
                $keyParts = explode('--', $key);
                if (isset($this->getData()[$keyParts[0]][$keyParts[1]])) {
                    $object = $this->getData()[$keyParts[0]][$keyParts[1]];
                    if (is_object($object) && method_exists($object, '__toStyles')) {
                        $styles[] = $object->__toStyles();
                    }
                }
            }
        }

        if (count($styles)) {
            return '<style type="text/css">' .
                implode('', $styles) .
                '</style>';
        } else {
            return '';
        }
    }

    public function getPreview(): ?bool
    {
        return $this->preview;
    }

}

