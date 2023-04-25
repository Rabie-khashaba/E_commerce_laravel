<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_categories';
    protected $fillable = ['language_lang', 'language_of' , 'name' , 'slug' , 'photo' , 'active' , 'created_at' ,'updated_at'];
    protected $hidden = ['created_at' ,'updated_at'];
}
