<?php

namespace App\Models\OpeningBalance\Traits;

/**
 * Class OpeningBalanceAttribute.
 */
trait OpeningBalanceAttribute
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
         '.$this->getViewButtonAttribute("account-manage", "biller.opening_balance.show").'
                '
                // .$this->getEditButtonAttribute("account-data", "biller.opening_balance.edit").'
                // '.$this->getDeleteButtonAttribute("account-data", "biller.opening_balance.destroy").'
                // '
                ;
    }
}
