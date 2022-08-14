<?php

namespace App\Http\Controllers\API;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Api\CarService;
use Illuminate\Http\JsonResponse;
use App\Services\Api\BrandService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CarModelRequest;

class CarModelController extends Controller
{

    public function __construct(
        protected BrandService $brandService,
        protected CarService $carService
        ){}


    /**
     * store car information 
     * with brand
     */
    public function storeCar(Request $request): JsonResponse
    {

        $carBrand = $this->brandService->createOrGet(['name' => $request->make]);

        if(!empty($carBrand)){
            
            $inputs['model'] =  $request->model;
            $inputs['brand_id'] =  $carBrand->id;
            
            $carModel = $this->carService->create($inputs);
            
            if($carModel->save()){
                return response()->json([
                    'success' => true, 
                    'message' => 'data insert successfully', 
                    'data' => [
                        'insert_car_id'=> $carModel->id
                    ]
                ], Response::HTTP_CREATED);
            }
        }

        return response()->json([
            'success' => false, 
            'message' => 'somthing wrong', 
        ], Response::HTTP_BAD_REQUEST);

    }

    /**
     * get car by id
     * @param int $id 
     */
    public function getCar(int $id): JsonResponse
    {
        $carData = $this->carService->getCarById($id);

        if(!empty($carData)){
            return response()->json([
                'success' => true, 
                'message' => 'success', 
                'data' => [
                    'id' => $id,
                    'info' => $carData->load('brand'),
                    'years' => $carData->year
                ]
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => false, 
            'message' => 'somthing wrong', 
        ], Response::HTTP_BAD_REQUEST);
    }
}
