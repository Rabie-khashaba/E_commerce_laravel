<?php

 // method that used in more than place in the project


use Illuminate\Support\Facades\Config;

function get_language(){  // active language
    return \App\Models\Language::active()->selection()->get();
}


// get default language from config
function get_default_language(){
    return Config::get('app.locale');
}


//function saveImage($photo,$folder){
//    //save photo in folder
//    $file_extension = $photo -> getClientOriginalExtension();
//    $file_name = time().'.'.$file_extension;
//    $path = $folder;
//    $photo -> move($path,$file_name);
//
//    return $file_name;
//}


//or
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}
