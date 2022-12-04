<?php

namespace App\Repositories\Focus\productVariable;

use DB;
use App\Models\productVariable\ProductVariable;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

/**
 * Class ProductVariableRepository.
 */
class ProductVariableRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ProductVariable::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {

        return $this->query()
            ->get();
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
        if ($productVariable = ProductVariable::create($input)) {
            return $productVariable;
        }
        throw new GeneralException(trans('exceptions.backend.productVariables.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param ProductVariable $productVariable
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(ProductVariable $productVariable, array $input)
    {
        $input = array_map( 'strip_tags', $input);
    	if ($productVariable->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.productVariables.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param ProductVariable $productVariable
     * @throws GeneralException
     * @return bool
     */
    public function delete(ProductVariable $productVariable)
    {
        if ($productVariable->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.productVariables.delete_error'));
    }
}
