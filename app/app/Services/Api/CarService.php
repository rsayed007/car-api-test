<?php

namespace App\Services\Api;

use App\Models\Year;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CarService{

    public function __construct()
    {
    }

    public function create(array $data): CarModel
    {
        try {
            $car = CarModel::create($data);
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        
        return $car;
    }

    public function getCarById(int $id)
    {
        $carData = CarModel::find($id);

        if (!empty($carData)) {
            return $carData;
        }
        return false;
    }


    public function getCarByYears(array $years):Collection|False
    {

        $carsData = CarModel::with('brand','year')->whereHas('year', function($query) use($years) {
            $yearIds = Year::whereIn('model_year',$years)->pluck('id');
            $query->whereIn('year_id',$yearIds);
        })->get();

        if (!empty($carsData)) {
            return $carsData;
        }
        return false;
    }

}