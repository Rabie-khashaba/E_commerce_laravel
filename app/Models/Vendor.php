<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    use HasFactory;

    protected $table = "vendors";
    protected $fillable = ['name' , 'email' , 'address' ,'mobile' ,'category_id','active','logo','created_at' ,'updated_at'];

    protected $hidden = ['created_at' ,'updated_at'];

    public $timestamps = true;
}
