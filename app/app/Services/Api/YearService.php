<?php

namespace App\Services\Api;

use App\Models\Year;
use App\Models\CarModel;
use Symfony\Component\HttpKernel\Exception\HttpException;

class YearService{

    public function __construct()
    {
    }

    public function create(array $years)
    {
        try {
            
            foreach($years as $year){
                $getYears = Year::firstOrCreate(['model_year' => $year]);
                $yearIds[] = $getYears->id;
            }
            return $yearIds;
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
        
        return $year;

    }

}