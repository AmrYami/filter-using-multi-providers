<?php


namespace App\SupplierClasses;


use App\Abstractions\DataProviders;
use App\Traits\FilterClientsTrait;
class DataProviderX extends DataProviders
{
use FilterClientsTrait;

    /**
     * @param array $request
     * @return object
     * manage data after filter if exist and mapping data to return same object
     */
    public function manageData(array $request): object
    {
        $result = $this->readData(storage_path('providers/DataProviderX.json'));
        $result = collect($result['users']);
        $this->filter = [
            'status' => 'statusCode',
            'balance' => 'parentAmount',
            'currency' => 'Currency',
        ];
        $result = $this->proccessFilterData($result, $request);// add filter to query
        if ($result)
           return $this->mapingData($result);
        return false;
    }

    /**
     * @param object $result
     * @return object after mapped data to get same object in every provider
     */
    public function mapingData(object $result): object
    {
        return $result->map(function ($client) {
            return [
                'balance' => $client['parentAmount']?? null,
                'currency' => $client['Currency']?? null,
                'email' => $client['parentEmail']?? null,
                'status' => $client['statusCode']?? null,
                'created_at' => $client['registerationDate']?? null,
                'id' => $client['parentIdentification']?? null
            ];
        });
    }

    /**
     * @param string $state
     * @return int of states
     */
    public function states(string $state): int
    {
        $data = [
            'authorised' => 1,
            'decline' => 2,
            'refunded' => 3
        ];
        return $data[$state];
    }
}