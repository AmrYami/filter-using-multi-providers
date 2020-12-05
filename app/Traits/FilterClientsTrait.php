<?php


namespace App\Traits;


trait FilterClientsTrait
{
    public array $filter = [];

    /**
     * @param object $result
     * @param array $request
     * @return false|object after filter
     *
     */
    public function proccessFilterData(object $result, array $request){
        if (isset($request['statusCode'])) {
            $state = $this->states($request['statusCode']);
            if ($state)
                $result = $result->where($this->filter['status'], $state);
            else
                return false;
        }
        if (isset($request['balanceMin']) && $request['balanceMin'] && is_numeric($request['balanceMin'])) {
            $result = $result->where($this->filter['balance'], '>=', $request['balanceMin']);
        }
        if (isset($request['balanceMax']) && $request['balanceMax'] && is_numeric($request['balanceMax'])) {
            $result = $result->where($this->filter['balance'], '<=', $request['balanceMax']);
        }
        if (isset($request['currency']) && $request['currency']) {
            $result = $result->where($this->filter['currency'], $request['currency']);
        }
        return $result;
    }

}