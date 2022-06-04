<?php

namespace App\Models\additional\Traits;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Class AdditionalAttribute.
 */
trait AdditionalAttribute
{
    // Make your attributes functions here
    // Further, see the documentation : https://laravel.com/docs/5.4/eloquent-mutators#defining-an-accessor


    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        $currentURL = URL::current();
        $show = ''; $edit = ''; $destroy = '';

        if(Str::contains($currentURL, 'additionals')){
            $show = "biller.additionals.show";
            $edit = "biller.additionals.edit";
            $destroy = "biller.additionals.destroy";
        }elseif(Str::contains($currentURL, 'discounts')){
            $show = "biller.discounts.show";
            $edit = "biller.discounts.edit";
            $destroy = "biller.discounts.destroy";
        }
        return '
         ' . $this->getViewButtonAttribute("business_settings", $show) . '
                ' . $this->getEditButtonAttribute("business_settings", $edit) . '
                ' . $this->getDeleteButtonAttribute("business_settings", $destroy) . '
                ';
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = numberClean($value);
    }

     public function getValueAttribute($value)
    {
        return $this->attributes['value'] = numberFormat($value);
    }
}
