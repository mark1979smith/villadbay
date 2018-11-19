<?php

namespace App\Twig;

use App\Component\Config\Entry;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class Config
 *
 * @package App\Twig
 */
class ConfigExtension  extends AbstractExtension
{
    /** @var \ArrayIterator */
    protected $entries;

    public function __construct(EntityManagerInterface $em)
    {
        $entities = $em->getRepository(\App\Entity\Config::class)
            ->findAll();
        $config = new Entry($entities);
        $this->entries = $config->getLatestRevision();
    }
    public function getFunctions()
    {
        return array(
            new TwigFunction('config', array($this, 'configEntry')),
        );
    }
    public function ConfigEntry(string $slug = null): string
    {
        return ($this->entries->offsetExists($slug) ? $this->entries->offsetGet($slug) : '');
    }
}
