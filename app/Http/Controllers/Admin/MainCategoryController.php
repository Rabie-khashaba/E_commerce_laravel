<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\Language;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class MainCategoryController extends Controller
{

        public function index(){

            $default_Lang= get_default_language();
            $mainCategories = MainCategory::where('translation_lang' , $default_Lang) -> selection()->get();
            //return $mainCategories;
            return view('admin.mainCategories.index' , compact('mainCategories')) ;
        }

        public function createMainCategory(){
            return view('admin.mainCategories.create');
        }

        public function saveMainCategory(MainCategoriesRequest $request){

           // return  $request;
            try {
                //$file_name = $this -> uploadImage($request -> photo , 'assets/images/offers');

                //return $request;
                $mainCategories = collect($request -> category);
                $filter = $mainCategories->filter(function ($value , $key){
                    return $value['abbr'] == get_default_language();
                });

                //return $filter;

                $default_category = array_values($filter ->all())[0];  // to get first index in array

                //(insertGetId)    to save to DB and get id of table
                //(create)         to save to DB

                $filePath = '';
                if($request ->has('photo')){
                    $filePath = uploadImage('mainCategories',$request -> photo);
                }

                DB::beginTransaction();

                //save default_category
                $default_category_id = MainCategory::insertGetId([
                    'translation_lang' => $default_category['abbr'], // $default_category['abbr'] because $default_category is array
                    'translation_of' => 0,
                    'name' => $default_category['name'],
                    'slug' => $default_category['name'],
                    'photo' => $filePath,
                ]);

                //return $default_category_id;   // return id

                //save category not default
                $categories = $mainCategories->filter(function ($value , $key){
                    return $value['abbr'] != get_default_language();
                });

                //return $categories;

                if(isset($categories) && $categories -> count()){
                    $categories_arr = [];
                    foreach ($categories as $category){
                        $categories_arr[] = [
                            'translation_lang' => $category['abbr'],
                            'translation_of' => $default_category_id, // id of default category
                            'name' => $category['name'],
                            'slug' => $category['name'],
                            'photo' => $filePath,
                        ];
                    }
                }

                //return $categories_arr;
                //save in DB
                MainCategory::insert($categories_arr);     // not use create in that
                DB::commit();  // if all right save
                return redirect()->route('admin.mainCategories')->with(['success' => 'Save Successfully']);

            }catch (\Exception $ex){
                DB::rollBack();  // if there any bugs ,do not save anything
                return redirect()->route('create.admin.mainCategories')->with(['error' => 'There Are Errors ,Try Again']);
            }


        }


        public function editMainCategory($id){

            // get specific language and its translations
            $mainCategory = MainCategory::with('categories')
                ->selection()
                ->find($id);
            //return  $mainCategory -> categories;

            if(!$mainCategory){
                return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
            }
            return view('admin.mainCategories.edit',compact('mainCategory'));
        }


        public function saveUpdateMainCategory(MainCategoriesRequest $request , $id){

            try {

                //return $id;
            $mainCategory =  MainCategory::find($id);
            // return  $request;
            if(!$mainCategory){
                return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
            }

            $category = array_values($request -> category)[0];
            //return $category;

            // add active = 0
            if (!$request->has('category.0.active')){
                $request->request->add(['active' => 0]);  // to add active = 0
            }
            else{
                $request->request->add(['active' => 1]);
            }

            //$mainCategory->update([])  or
            MainCategory::where('id', $id)->update([
                'name'=> $category['name'],
                'active' => $request->active,
            ]);


            // save image

            if ($request->has('photo')) {
                $filePath = uploadImage('mainCategories', $request->photo);
                MainCategory::where('id', $id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            return  redirect()->route('admin.mainCategories')->with(['success' => 'تم التعديل بنجاح']);

            }catch (\Exception $ex){
                return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
            }

        }

        public function deleteMainCategory($id){
            try {
                // return $id;


                // to check if exist or not
                $mainCategory = MainCategory::find($id);
                if(!$mainCategory){
                    return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
                }

                // vendors --------> relations in mainCategory
                $vendors = $mainCategory->vendors();
                //return $vendors

                if(isset($vendors) && $vendors -> count() > 0){
                    return redirect()->route('admin.mainCategories')->with(['error' => 'You Can Not Delete This Category']);
                }


                // return $mainCategory->photo;

                $image = Str::after( $mainCategory->photo , 'assets/');
                $image = base_path('assets/'.$image);
                unlink($image);  // delete image from folder (take app path)


                $mainCategory -> delete();
                return redirect()->route('admin.mainCategories')->with(['success' => 'Deleted Successfully']);



            }catch (\Exception $exception){
               // return  $exception;
                return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);

            }

        }


        public function changeStatus($id){

            try {
                $mainCategory = MainCategory::find($id);
                if(!$mainCategory){
                    return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
                }

                //return $mainCategory;

                $status = $mainCategory -> acive == 0 ? 1 : 0;

                $mainCategory -> update([ 'active' => $status]);
                return redirect()->route('admin.mainCategories')->with(['success' => 'Active Changed Successfully']);

            }catch (\Exception $exception){
                return redirect()->route('admin.mainCategories')->with(['error' => 'There Are Errors,Try Again']);
            }

        }


}

