<?php

namespace App\Http\Controllers;

use App\Services\CompositeService;
use Illuminate\Http\Request;
use Response;
class CompositeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['listData']]);
    }

    public function listData(Request $request, CompositeService $compositeService){
        try {
            $data = $compositeService->listData($request);
            if ($data)
                return response()->json(array(
                    'data' => $data,
                ), 200);
        }catch (\Exception $e){
            return Response::json(array('error' => 'Something Went Wrong'), 200);
        }
    }
}
