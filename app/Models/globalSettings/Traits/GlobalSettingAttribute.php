<?php

namespace App\Models\globalSettings\Traits;

/**
 * Class GlobalSettingAttribute.
 */
trait GlobalSettingAttribute
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
         '.$this->getViewButtonAttribute("business_settings", "biller.globalsettings.show").'
                '.$this->getEditButtonAttribute("business_settings", "biller.globalsettings.edit").'
                '.$this->getDeleteButtonAttribute("business_settings", "biller.globalsettings.destroy").'
                ';
    }
}
