<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;


class LanguagesController extends Controller
{
    public function index(){
        $languages = Language::selection()->paginate(PAGINATION_COUNT);

        //return $languages;
        return view('admin.languages.index' , compact('languages')) ;
    }



    public function createLanguage(){
        return view('admin.languages.create');
    }

    public function saveLanguage(LanguageRequest $request){

        //save
//        Language::create(
//            [
//                'name' => $request ->name,
//                'abbr' => $request ->abbr,
//                'direction' => $request ->direction,
//                'active' => $request ->active,
//            ]
//        );
//
//        return redirect()->back()->with(['success' => 'Saved successfully']);


        try {
            Language::create($request->except(['token']));  // هيحفظ كل الداتا معادا token

            return redirect()->route('admin.languages')->with(['success' => 'Saved successfully']);
        }catch (Exception $ex){
            return redirect()->route('admin.languages')->with(['errors' => 'Not Saved Try Again']);

        }
    }


    public function deleteLanguage($language_id){
        //return $language_id;

        $language = Language::find($language_id);  // Offer::where('id', $offer_id)-> first();
        if(!$language){
            return redirect()->back()->with(['errorس' => 'حدث خطا برجاء اعاده المحاوله']);
        }

        //if exist
        $language -> delete();
        return  redirect()->back()->with(['success' => 'تم الحذف بنجاح']);

    }

    public function editLanguages($language_id){
        //return $language_id;

        $language = Language::select(
            'id',
            'name',
            'abbr',
            'direction',
            'active',
        )->find($language_id);
        return view('admin.languages.edit' , compact('language'));
    }

    public function saveUpdateLanguages(LanguageRequest $request , $language_id){
            //return $language_id;

            // request ===>  data that i updated in form

            $language = Language::find($language_id);
            if(!$language){
                return redirect()->back()->with(['errors' => 'حدث خطا برجاء اعاده المحاوله']);
            }

            //if exist
            $language -> update($request ->all());
            return  redirect()->route('admin.languages')->with(['success' => 'تم التعديل بنجاح']);

    }
}
