<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';
    protected $fillable =['abbr' , 'locale' , 'name' , 'direction' , 'active' , 'created_at' , 'updated_at'];
    protected $hidden =['created_at' , 'updated_at'];


    public function scopeActive($query){
        return $query -> where('active' , 1);
    }

    public function scopeSelection($query){
        return $query-> select(
            'id',
            'abbr',
            'locale',
            'name',
            'direction',
            'active',
        );
    }



    // if getActiveAttribute  will change the data in everything in the code  (accessor)
    // if getActive  will change the data in the place that called in it (normal method)
    public function getActive(){  // normal method
        return  $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }



}
