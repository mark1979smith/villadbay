<?php

namespace App\Component\Config;

/**
 * Class Groups
 *
 * @package App\Component\Config
 */
class Groups
{
    /** @var \ArrayIterator */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $this->transferDataToIterable($data);
    }

    public function getGroups()
    {
        return $this->data;
    }



    protected function transferDataToIterable(array $data): \ArrayIterator
    {
        $array = new \ArrayIterator();
        /** @var \App\Entity\ConfigGroup $configGroup */
        foreach ($data as $configGroup)
        {
            $array->append($configGroup);
        }

        return $array;
    }
}
