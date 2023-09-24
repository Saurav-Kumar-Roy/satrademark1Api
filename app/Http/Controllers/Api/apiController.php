<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\All_products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class apiController extends Controller
{
    public function index(){
        $products = All_products::all();
        if($products->count()>0){
            $data=[
                'status'=>200,
                'data'=>$products
            ];
            return response()->json($data,200);
        }else{
            return response()->json(['status'=>404,'message'=>'empty'],404);
        }    
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'Name'=>'required|string|max:191',
            'Price'=>'required|string|max:191',
            'Exclusive'=>'required|string|max:1',
            'Available'=>'required|string|max:1'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>422,'errors'=>$validator->messages()],422);
        }else{
            $imageName = Str::random(32).".".$request->Image->getClientOriginalExtension();

            $product = All_products::create([
                'Name'=>$request->Name,
                'Price'=>$request->Price,
                'Image'=>$imageName,
                'Exclusive'=>$request->Exclusive,
                'Available'=>$request->Available
            ]);
            if($product){
                Storage::disk('public')->put($imageName,file_get_contents($request->Image));
                return response()->json([
                    'status'=>200,
                    'message'=>"product Created."
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'messge'=>'not created. something went worng'
                ],500);
            }
        }
    }

    public function show(int $id){
        $product = All_products::find($id);
        if($product){
            return response()->json([
                'status'=>200,
                'data'=>$product
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'messge'=>'no student found'
            ],404);
        }
    }

    public function edit(Request $request,int $id){
        $validator = Validator::make($request->all(),[
            'Name'=>'required|string|max:191',
            'Price'=>'required|string|max:191',
            'Exclusive'=>'required|string|max:1',
            'Available'=>'required|string|max:1'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>422,'errors'=>$validator->messages()],422);
        }else{
            $imageName = Str::random(32).".".$request->Image->getClientOriginalExtension();
            $product = All_products::find($id);
            if($product){
                $product->update([
                    'Name'=>$request->Name,
                    'Price'=>$request->Price,
                    'Image'=>$imageName,
                    'Exclusive'=>$request->Exclusive,
                    'Available'=>$request->Available
                ]);
                Storage::disk('public')->put($imageName,file_get_contents($request->Image));
                return response()->json([
                    'status'=>200,
                    'data'=>$product,
                    'message'=>"updated successfully"
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'messge'=>'no product found'
                ],404);
            }
        }
        
    }

    public function destroy(int $id){
        $product = All_products::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'status'=>200,
                'messge'=>'Deleted student'
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'messge'=>'no student found'
            ],404);
        }
    }

}
