<?php

namespace App\Http\Controllers\API;

use App\Models\Year;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Api\CarService;
use App\Services\Api\YearService;
use App\Http\Controllers\Controller;

class YearController extends Controller
{
    public function __construct(
        protected CarService $carService,
        protected YearService $yearService
    ){}

    public function storeYear(Request $request, $id)
    {

        $yearIds = $this->yearService->create($request->years);
        $carData = $this->carService->getCarById($id);

        if($carData->year()->syncWithPivotValues($yearIds, ['expires' => $request->expiry])){
            return response()->json([
                'success' => true,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'success' => false
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * 
     */

    public function getCarByYear(Request $request)
    {
        if (empty($request->years)) {

            return response()->json([
                'success' => false
            ],
            Response::HTTP_BAD_REQUEST);
        }

        $years = explode(',', $request->get('years'));
        $carsData = $this->carService->getCarByYears($years);

        foreach ($carsData as $key => $car) {
            $data[$key] ['id']= $car->id;
            $data[$key] ['name'] = $car->brand->name." ". $car->model ." ". $car->year[$key]->model_year;
            foreach ($car->year as $k => $year) {
                $data[$key]['years'][] = $year->model_year;
            }
        }

        return response()->json([
            'success' => true, 
            'message' => 'success', 
            'data' => [
                'cars'=> $data
            ]
        ], Response::HTTP_OK);
    }
}
