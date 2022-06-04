<?php

namespace App\Repositories\Focus\costcenter;

use App\Models\costCenter\CostCenter;
use DB;
use Carbon\Carbon;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CostCenterRepository.
 */
class CostCenterRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CostCenter::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable($screen_id)
    {

        return $this->query()->where('screen_id', $screen_id)
            ->get(['id','code','name_ar','name_en', 'screen_id', 'active', 'user_id', 'type', 'cost_balance']);
    }

    public function getForCostCentersDataTable()
    {

        return $this->query()
            ->get(['id','code','name_ar','name_en', 'screen_id', 'active', 'user_id', 'type', 'cost_balance']);
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
        if (CostCenter::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.costcenters.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param CostCenter $costcenter
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(CostCenter $costcenter, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($costcenter->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.costcenters.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param CostCenter $costcenter
     * @throws GeneralException
     * @return bool
     */
    public function delete(CostCenter $costcenter)
    {
        if ($costcenter->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.costcenters.delete_error'));
    }
}
