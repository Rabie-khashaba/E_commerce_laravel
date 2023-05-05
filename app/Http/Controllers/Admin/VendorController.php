<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

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
    public function saveVendors(Request $request){
        return $request;
    }
    public function editVendors(){

    }
    public function saveUpdateVendors(){

    }
    public function deleteVendors(){

    }
}
