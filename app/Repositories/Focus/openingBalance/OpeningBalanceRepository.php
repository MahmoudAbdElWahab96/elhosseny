<?php

namespace App\Repositories\Focus\openingBalance;

use DB;
use Carbon\Carbon;
use App\Models\OpeningBalance\OpeningBalance;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OpeningBalanceRepository.
 */
class OpeningBalanceRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = OpeningBalance::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->get(['id','number','holder','level','balance','debit','credit','account_type','created_at']);
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
        if (OpeningBalance::create($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.openingBalance.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param OpeningBalance $openingBalance
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(OpeningBalance $openingBalance, array $input)
    {
        $openingBalance->balance = $openingBalance->balance + $input['credit'];
        $openingBalance->balance = $openingBalance->balance - $input['debit'];
        $openingBalance->debit += $input['debit'];
        $openingBalance->credit += $input['credit'];
        
    	if ($openingBalance->save()){
            $openingBalance->CalcOpeningBalance();

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.openingBalance.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param OpeningBalance $openingBalance
     * @throws GeneralException
     * @return bool
     */
    public function delete(OpeningBalance $openingBalance)
    {
        if ($openingBalance->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.openingBalance.delete_error'));
    }
}
