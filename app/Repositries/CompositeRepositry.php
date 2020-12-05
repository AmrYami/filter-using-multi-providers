<?php


namespace App\Repositries;


use App\SupplierClasses\DataProviderX;
use App\SupplierClasses\DataProviderY;

class CompositeRepositry
{
    //to work with database

//        get data from first provider x
    public function listDataProviderX(array $request)
    {
        if ((isset($request['provider']) && $request['provider'] == 'DataProviderX') || !isset($request['provider'])) {
            $dataFromProviderX = new DataProviderX();
            return $dataFromProviderX->manageData($request);
        }
        return false;

    }
//        get data from first provider y
    public function listDataProviderY(array $request)
    {
        if ((isset($request['provider']) && $request['provider']== 'DataProviderY') || !isset($request['provider'])) {
            $dataFromProviderX = new DataProviderY();
            return $dataFromProviderX->manageData($request);
        }
        return false;

    }
}
