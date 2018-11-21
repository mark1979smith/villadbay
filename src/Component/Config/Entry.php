<?php

namespace App\Component\Config;

use App\Entity\Config;

/**
 * Class Entry
 *
 * @package App\Component
 */
class Entry
{
    /** @var \ArrayIterator */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $this->transferDataToIterable($data);
    }

    public function getData(): \ArrayIterator
    {
        return $this->data;
    }

    public function getLatestRevision(?string $slug = null)
    {
        $revisions = $this->data;

        if (!is_null($slug)) {
            /** @var \ArrayIterator $revisions */
            $revisions = $revisions->offsetGet($slug);

            return reset($revisions);
        } else {
            $array = new \ArrayIterator();
            foreach ($revisions as $slug => $revisionSet) {
                $array->offsetSet($slug, reset($revisionSet));
            }
            return $array;
        }
    }

    protected function transferDataToIterable(array $data): \ArrayIterator
    {
        $array = new \ArrayIterator();
        // Group By Slug
        /** @var Config $config */
        foreach ($data as $config) {
            if (!$array->offsetExists($config->getSlug())) {
                $array->offsetSet($config->getSlug(), new \ArrayIterator());
            }
            $array->offsetGet($config->getSlug())->append($config);
        }

        /**
         * @var string         $slug
         * @var \ArrayIterator $revisions
         */
        foreach ($array as $slug => $revisions) {
            $revisions->uasort(function (Config $a, Config $b) {
                return ($a->getCreated() > $b->getCreated()) ? -1 : 1;
            });
        }

        return $array;
    }

    public function getGroups(): \ArrayIterator
    {
        $groups = new \ArrayIterator();
        /** @var \ArrayIterator $revisionSet */
        foreach($this->getData() as $slug => $revisionSet)
        {
            $groups->append($revisionSet->current()->getConfigGroup());
        }

        return $groups;
    }
}
