<?php

namespace App\Repositories\Focus\tax;

use DB;
use Carbon\Carbon;
use App\Models\tax\Tax;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaxRepository.
 */
class TaxRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Tax::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
            ->get(['id','code','Desc_en','Desc_ar']);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        $input = array_map( 'strip_tags', $input);
        if (Tax::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.taxes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Country $country
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Tax $tax, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($tax->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.taxes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Country $country
     * @throws GeneralException
     * @return bool
     */
    public function delete(Tax $tax)
    {
        if ($tax->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.taxes.delete_error'));
    }
}
