<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    use HasFactory;
    protected $table = "company_users";

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function companies(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
