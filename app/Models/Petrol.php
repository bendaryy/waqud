<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petrol extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(){
        return $this->belongsTo(Company::class,'companyId','id');
    }
    public function car(){
        return $this->belongsTo(subCar::class,'carId','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
