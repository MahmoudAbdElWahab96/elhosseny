<?php

namespace App\Repositories\Focus\globalsetting;

use DB;
use Carbon\Carbon;
use App\Models\globalSettings\GlobalSetting;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GlobalSettingRepository.
 */
class GlobalSettingRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = GlobalSetting::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
            ->get(['id','key','value']);
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
        throw new GeneralException(trans('exceptions.backend.globalsettings.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param GlobalSetting $country
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(GlobalSetting $globalsetting, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($globalsetting->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.globalsettings.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param GlobalSetting $globalsetting
     * @throws GeneralException
     * @return bool
     */
    public function delete(GlobalSetting $globalsetting)
    {
        if ($globalsetting->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.globalsettings.delete_error'));
    }
}
