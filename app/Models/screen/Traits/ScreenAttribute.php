<?php

namespace App\Models\screen\Traits;

/**
 * Class ScreenAttribute.
 */
trait ScreenAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '
         '.$this->getViewButtonAttribute("business_settings", "biller.screens.show").'
                '.$this->getEditButtonAttribute("business_settings", "biller.screens.edit").'
                '.$this->getDeleteButtonAttribute("business_settings", "biller.screens.destroy").'
                ';
    }
}
