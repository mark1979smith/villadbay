<?php

namespace App\Component;

class Configuration
{
    protected $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function render()
    {
        $str = '';

        /** @var \App\Entity\Config $configRow */
        foreach ($this->data as $configRow) {
            $str .= $configRow->getValue();
        }

        return $str;
    }

}
