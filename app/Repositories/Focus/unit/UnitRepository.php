<?php

namespace App\Repositories\Focus\unit;

use DB;
use Carbon\Carbon;
use App\Models\unit\Unit;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnitRepository.
 */
class UnitRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Unit::class;

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
        if (Unit::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.units.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Country $country
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Unit $unit, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($unit->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.units.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Unit $country
     * @throws GeneralException
     * @return bool
     */
    public function delete(Unit $unit)
    {
        if ($unit->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.units.delete_error'));
    }
}
