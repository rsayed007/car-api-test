<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = ['model','brand_id'];


    public function brand()
    {
        return $this->belongsTo(CarBrand::class,'brand_id');
    }

    public function year()
    {
        return $this->belongsToMany(Year::class,'car_model_year','car_model_id','year_id')->withPivot('expires');
    }
}
