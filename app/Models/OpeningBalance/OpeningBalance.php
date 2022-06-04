<?php

namespace App\Models\OpeningBalance;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\OpeningBalance\Traits\OpeningBalanceAttribute;

class OpeningBalance extends Model
{
    use ModelTrait,
        OpeningBalanceAttribute;
    /**
     * NOTE : If you want to implement Soft Deletes in this model,
     * then follow the steps here : https://laravel.com/docs/5.4/eloquent#soft-deleting
     */

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'opening_balances';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    protected static function boot()
    {
            parent::boot();
            static::addGlobalScope('ins', function($builder){
                $builder->where('ins', '=', auth()->user()->ins);
            });
    }

    public function subAccounts()
    {
        return $this->hasMany(OpeningBalance::class,'parent_account_id', 'id');
    }

    public function parentAccount()
    {
        return OpeningBalance::where('id', $this->parent_account_id)->first();
    }

    public function CalcOpeningBalance()
    {
        $debit = 0; $credit = 0;
        $parent = $this->parentAccount();
        
        foreach($parent->subAccounts as $child){
            $debit += $child->debit;
            $credit += $child->credit;

            $parent->debit = $debit;
            $parent->credit = $credit;
            $parent->save();

            $deb = 0; $cre = 0;

            if($v = $parent->parentAccount()){
                foreach($v->subAccounts as $c){
                    $deb += $c->debit;
                    $cre += $c->credit;
            
                    $v->debit = $deb;
                    $v->credit = $cre;
                    $v->save();

                    $de = 0; $cr = 0;
            
                    if($b = $v->parentAccount()){
                        foreach($b->subAccounts as $r){
                            $de += $r->debit;
                            $cr += $r->credit;
                        
                            $b->debit = $de;
                            $b->credit = $cr;
                            $b->save();

                            $ded = 0; $crd = 0;

                            if($n = $b->parentAccount()){
                                foreach($n->subAccounts as $o){
                                    $ded += $o->debit;
                                    $crd += $o->credit;
                                    
                                    $n->debit = $ded;
                                    $n->credit = $crd;
                                    $n->save();

                                    $dee = 0; $cee = 0;
    
                                    if($m = $n->parentAccount()){
                                        foreach($m->subAccounts as $l){
                                            $dee += $l->debit;
                                            $cee += $l->credit;

                                            $m->debit = $dee;
                                            $m->credit = $cee;
                                            $m->save();
                                        }
                                    }
                                }
                            }
                        }      
                    }
                }
            }
        }
    }
}
