<?php

namespace App\Models\orderedSupply\Traits;

/**
 * Class OrderedSupplyAttribute.
 */
trait OrderedSupplyAttribute
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
         '.$this->getViewButtonAttribute("invoice-manage", "biller.orderedSupply.show").'
                '.$this->getEditButtonAttribute("invoice-edit", "biller.orderedSupply.edit").'
                '.$this->getDeleteButtonAttribute("invoice-delete", "biller.orderedSupply.destroy",'table').'
                ';
    }


}
