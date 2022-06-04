<?php

namespace App\Repositories\Focus\screen;

use DB;
use Carbon\Carbon;
use App\Models\screen\Screen;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScreenRepository.
 */
class ScreenRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Screen::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
            ->get(['id','code','name_ar','name_en', 'type', 'active']);
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
        if (Screen::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.screens.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Screen $screen
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Screen $screen, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($screen->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.screens.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Screen $screen
     * @throws GeneralException
     * @return bool
     */
    public function delete(Screen $screen)
    {
        if ($screen->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.screens.delete_error'));
    }
}
