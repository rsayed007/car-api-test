<?php

namespace App\Services\Api;

use App\Models\CarBrand;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BrandService{

    public function __construct()
    {
    }

    public function createOrGet(array $data): CarBrand
    {
        try {
            $brand = CarBrand::firstOrCreate($data);
        } catch (\Exception $e) {
            throw new HttpException(404, $e->getMessage());
        }

        return $brand;
    }

}