<?php

namespace App\Models\productvariableValues\Traits;

/**
 * Class ProductvariableValues.
 */
trait ProductvariableValuesAttribute
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
         '.$this->getViewButtonAttribute("business_settings", "biller.productvariables.show").'
                '.$this->getEditButtonAttribute("business_settings", "biller.productvariables.edit").'
                '.$this->getDeleteButtonAttribute("business_settings", "biller.productvariables.destroy").'
                ';
    }
}
