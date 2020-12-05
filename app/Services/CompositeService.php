<?php


namespace App\Services;


use App\Repositries\CompositeRepositry;
use Illuminate\Http\Request;

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
        return $data;
    }

}
