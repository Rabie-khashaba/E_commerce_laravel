<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Exception;
use function PHPUnit\Framework\exactly;

class VendorController extends Controller
{
    public function index(){

       $vendors = Vendor::with("category")->selection()->paginate(PAGINATION_COUNT);
       //return $vendors;

        return view('admin.vendors.index',compact('vendors'));

    }
    public function createVendors(){

        // to get default category

//        $categories = MainCategory::active()->get();
//        $categories = collect($categories);
//        $categories = $categories->filter(function ($value , $key){
//            return $value['translation_lang'] == get_default_language();
//        });

        // or

        $categories = MainCategory::where('translation_of',0)->active()->get();

        return view('admin.vendors.create',compact('categories'));
    }
    public function saveVendors(VendorRequest $request){
        //return $request;

        try {

            $filename = '';
            if($request -> has( 'logo')){
                $filename = uploadImage('vendors' , $request -> logo);
            }


            // this happened when Edit active
            if(!$request ->has('active')){
                $request->request->add(['active' => 0]);
            }else
            {
                $request->request->add(['active' => 1]);
            }


            $vendors= Vendor::create([
                'name'=>$request -> name,
                'category_id'=> $request -> category_id ,
                'email'=> $request -> email,
                'password'=> $request -> password,
                'mobile'=> $request -> mobile,
                'address'=> $request -> address,
                'active' => $request -> active,
                'logo' => $filename
            ]);

            // once create vendor , send notification to this vendor
            Notification::send($vendors , new VendorCreated($vendors));

            return redirect()->route('admin.vendors')->with(['success' => 'Saved Successfully']);

        }catch (\Exception $ex){
            return redirect()->route('create.admin.vendors')->with(['error' => 'There Is Errors ,Try Again']);
        }
    }
    public function editVendors($id){
        try {

            $vendors = Vendor::selection()->find($id);

            //return $categories;
            //return $vendors;
            if(!$vendors){
                return redirect()->route('admin.vendors')->with(['error' => 'There Is Errors ,Try Again']);
            }
            $categories = MainCategory::where('translation_of' , 0)->active()->get();


            return view('admin.vendors.edit',compact('vendors','categories'));

        }catch (\Exception $exception){
            return redirect()->route('admin.vendors')->with(['error' => 'There Is Errors ,Try Again']);

        }
    }
    public function saveUpdateVendors($id ,VendorRequest $request){


        try {
            //return $request;
            //return $id;


            $vendors = Vendor::find($id);

            if(!$vendors){
                return redirect()->route('admin.vendors')->with(['error' => 'There Is Errors ,Try Again']);
            }

            if (!$request ->has('active')){
                $request->request->add(['active'=> 0]);
            }else{
                $request->request->add(['active'=> 1]);
            }

            DB::beginTransaction();

            if($request ->has('logo')){
                $filePath = uploadImage('vendors' , $request-> logo);
                Vendor::where('id',$id)->update([
                    'logo' => $filePath
                ]);
            }


            $data = $request->except('_token' , 'password' , 'id' , 'logo');   //data --> array

            if($request->has('password')){
                $data['password'] = $request->password;
            }
            Vendor::where('id' ,$id)->update($data);


            //or
//        Vendor::where('id' ,$id)->update([
//            'name'=>$request -> name ,
//            ''=> ,
//            ''=> ,
//            ''=> ,
//        ]);
            DB::commit();  // if all right save

            return redirect()->route('admin.vendors')->with(['success' => 'Updated Successfully']);


        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.vendors')->with(['error' => 'There Is Errors ,Try Again']);
        }
    }
    public function deleteVendors(){

    }
}
