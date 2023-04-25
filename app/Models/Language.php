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

}
