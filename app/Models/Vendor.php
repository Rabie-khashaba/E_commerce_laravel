<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{

    use HasFactory;
    use Notifiable;

    protected $table = "vendors";
    protected $fillable = ['name' , 'email','password', 'address' ,'mobile' ,'category_id','active','logo','created_at' ,'updated_at'];

    protected $hidden = ['created_at' ,'updated_at','category_id','password'];

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
            'email',
            'address',
            'mobile',
            'active'
        );
    }

    public function getActive(){
        return $this->active == 1 ? 'معفل' : "غير مفعل";
    }


    public function category()
    {
        return $this->belongsTo('App\Models\MainCategory', 'category_id', 'id');
    }

    public function setPasswordAttribute($password){
        if(!empty($password)){
            $this -> attributes['password'] = bcrypt($password);
        }
    }

}
