<?php

namespace App\Services;
use App\Repositries\CompositeRepositry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CompositeService
{
    /**
     * @var CompositeRepositry
     */
    private $compositeRepositry;
    /**
     * CompositeService constructor.
     * @param CompositeRepositry $compositeRepositry
     */
    public function __construct(CompositeRepositry $compositeRepositry)
    {
        $this->compositeRepositry = $compositeRepositry;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     * please note that every provider has its class to manage data and classes has abstract class and using trait to manage filter
     */
    public function listData(Request $request){
        $data = collect();
        //data from provider X
        $providersX = $this->compositeRepositry->listDataProviderX($request->all());
        if ($providersX)
            $data = $data->merge($providersX);
        //data from provider X

        //data from provider Y
        $providersY = $this->compositeRepositry->listDataProviderY($request->all());
        if ($providersY)
            $data = $data->merge($providersY);
        //data from provider Y

        return $this->paginate($data);
//        return $data;
    }
    public function paginate($items, $perPage = 100, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
