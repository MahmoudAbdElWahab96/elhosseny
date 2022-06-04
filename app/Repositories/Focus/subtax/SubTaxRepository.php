<?php

namespace App\Repositories\Focus\subtax;

use DB;
use Carbon\Carbon;
use App\Models\subtax\SubTax;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubTaxRepository.
 */
class SubTaxRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = SubTax::class;

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
        if (SubTax::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.subtaxes.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param SubTax $country
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(SubTax $subtax, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($subtax->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.subtaxes.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Country $subtax
     * @throws GeneralException
     * @return bool
     */
    public function delete(SubTax $subtax)
    {
        if ($subtax->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.subtaxes.delete_error'));
    }
}
