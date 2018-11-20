<?php
/**
 * Created by PhpStorm.
 * User: mark.smith
 * Date: 20/11/2018
 * Time: 15:57
 */

namespace App\Component\Page;

/**
 * Trait TemplateSetter
 *
 * @package App\Component\Page
 */
trait TemplateSetter
{
    public function setTemplate(string $template): self
    {
        $existingTemplate = $this->template;

        if (substr_count($template, '%s') != substr_count($existingTemplate, '%s')) {
            throw new \LogicException('Incorrect placeholder');
        }
        $this->template = $template;

        return $this;
    }

}
