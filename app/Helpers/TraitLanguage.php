<?php

namespace App\Helpers;

trait TraitLanguage
{
    public function getAttribute($key)
    {
        if (in_array($key, $this->languageColumns)) {
            return $this->getAttribute($key.'_'.app()->getLocale());
        } else {
            return parent::getAttribute($key);
        }
    }
}