<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detail;
use DB;
use Auth;

class TestController extends Controller
{
    //

    public function index(Request $request)
    {
        try{
            // return "hello peter";
            // return $request->all();

            $data = $request->all();

            $addDetail = new Detail();
            $addDetail->name = $request->name;
            $addDetail->category = $request->category;
            $addDetail->description = $request->description;
            $addDetail->save();

            return response()->json(['status' => 'Success','message' => 'Detail store successfully','data'=>$addDetail]);
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function allDetail(Request $request)
    {
        try{

            // $userId = Auth::user()->id;
            // return $userId;
            $getAll = DB::table('details')->orderBy('id', 'DESC')->get();

            return response()->json(['status' => 'Success','message' => 'Detail Fetch successfully','data'=>$getAll]);

        }catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
    public function editDetail(Request $request)
    {
        try{
            $category = $request->category;

            $UpdateDetail = Detail::where('id',50)->update(['category'=>$category]);

            return response()->json(['status' => 'Success','message' => 'Detail edited successfully','data'=>$UpdateDetail]);

        }catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }
}
