<?php

namespace App\Twig;

use App\Component\Config\Entry;
use App\Component\Helpers\Data;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class Config
 *
 * @package App\Twig
 */
class ConfigExtension extends AbstractExtension
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

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('config_filter_var', [$this, 'configFilterValue']),
            new \Twig_SimpleFilter('config_filter_var_admin', [$this, 'configFilterValueForAdmin']),
        ];
    }

    public function configEntry(string $slug = null): string
    {
        return ($this->entries->offsetExists($slug) ? $this->entries->offsetGet($slug) : '');
    }

    public function configFilterValue($string): ?string
    {
        $data = Data::getBeforeSubstring($string, ':');

        if ($data == '*') {
            return null;
        }

        return $data;
    }

    public function configFilterValueForAdmin($string): string
    {
        return Data::getAfterSubstring($string, ':');
    }
}
