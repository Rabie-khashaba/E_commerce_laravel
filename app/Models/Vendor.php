<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    use HasFactory;

    protected $table = "vendors";
    protected $fillable = ['name' , 'email' , 'address' ,'mobile' ,'category_id','active','logo','created_at' ,'updated_at'];

    protected $hidden = ['created_at' ,'updated_at','category_id'];

    public $timestamps = true;


    // condition on vendors active only
    public function scopeActive($query){
        return $query -> where('active' , 1);
    }


    public function getLogoAttribute($val){
        return ($val !== null) ? asset('assets/'.$val) : "";   // asset ==> put localhost:8000/value of photo
    }

    public function scopeSelection($query){
        return $query -> select(
            'id',
            'name',
            'category_id',
            'logo',
            'mobile',
        );
    }

    public function getActive(){
        return $this->active == 1 ? 'معفل' : "غير مفعل";
    }


    public function category()
    {
        return $this->belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }


}
