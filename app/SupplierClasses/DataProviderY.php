<?php


namespace App\SupplierClasses;


use App\Abstractions\DataProviders;
use App\Traits\FilterClientsTrait;

class DataProviderY extends DataProviders
{
use FilterClientsTrait;
    /**
     * @param array $request
     * @return object
     * manage data after filter if exist and mapping data to return same object
     */
    public function manageData(array $request): object
    {
        $result = $this->readData(storage_path('providers/DataProviderY.json'));
        $result = collect($result['users']);
        $this->filter = [
            'status' => 'status',
            'balance' => 'balance',
            'currency' => 'currency',
        ];
        $result = $this->proccessFilterData($result, $request);// add filter to query
        if ($result)
            return $result;
        return false;
    }
    /**
     * @param string $state
     * @return int of states
     */
    public function states($state): int
    {
        $data = [
            'authorised' => 100,
            'decline' => 200,
            'refunded' => 300
        ];
        return $data[$state];
    }
}