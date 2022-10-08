<?php

namespace App\Repositories\Focus\branch;

use DB;
use App\Exceptions\GeneralException;
use App\Models\Company\Branch;
use App\Repositories\BaseRepository;

/**
 * Class BranchRepository.
 */
class BranchRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Branch::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
                ->get(['id','name', 'country', 'city', 'region', 'postbox' , 'phone', 'email']);
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
        if (Branch::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.accounts.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Branch $branch
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Branch $branch, array $input)
    {
        if ($branch->update($input))
        return true;

        throw new GeneralException(trans('exceptions.backend.accounts.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Branch $branch
     * @throws GeneralException
     * @return bool
     */
    public function delete(Branch $branch)
    {
        if ($branch->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.accounts.delete_error'));
    }
}
