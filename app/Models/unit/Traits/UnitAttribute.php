<?php

namespace App\Models\unit\Traits;

/**
 * Class UnitAttribute.
 */
trait UnitAttribute
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
         '.$this->getViewButtonAttribute("business_settings", "biller.units.show").'
                '.$this->getEditButtonAttribute("business_settings", "biller.units.edit").'
                '.$this->getDeleteButtonAttribute("business_settings", "biller.units.destroy").'
                ';
    }
}
