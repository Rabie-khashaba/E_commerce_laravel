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
            Language::create($request->except(['_token']));  // هيحفظ كل الداتا معادا token

            return redirect()->route('admin.languages')->with(['success' => 'Saved successfully']);
        }catch (\Exception $ex){
            return redirect()->route('admin.languages')->with(['errors' => 'Not Saved Try Again']);

        }
    }


    public function deleteLanguage($language_id){
        //return $language_id;

        $language = Language::find($language_id);  // Offer::where('id', $offer_id)-> first();
        if(!$language){
            return redirect()->back()->with(['error' => 'حدث خطا برجاء اعاده المحاوله']);
        }

        //if exist
        $language -> delete();
        return  redirect()->back()->with(['success' => 'تم الحذف بنجاح']);

    }

    public function editLanguages($language_id){
        //return $language_id;

        $language = Language::selection()->find($language_id);
        return view('admin.languages.edit' , compact('language'));
    }

    public function saveUpdateLanguages(LanguageRequest $request , $language_id){
            //return $language_id;

            // request ===>  data that i updated in form

        try {

            $language = Language::find($language_id);
            if(!$language){
                return redirect()->route('edit.admin.languages',$language_id)->with(['error' => 'حدث خطا برجاء اعاده المحاوله']);
            }

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);  // to add active = 0


            $language -> update($request ->except('_token'));
            return  redirect()->route('admin.languages')->with(['success' => 'تم التعديل بنجاح']);
        }catch (\Exception $ex){
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطا برجاء اعاده المحاوله']);

        }

    }
}
