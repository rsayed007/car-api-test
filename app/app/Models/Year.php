<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function car_model()
    {
        return $this->belongsToMany(CarModel::class,'car_model_year','year_id','car_model_id')->withPivot('expires');
    }
}
