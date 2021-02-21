<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Compra;

use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller
{

    public function create (Request $request){


        $compra=new Compra;

        $compra->user_id= Auth::user()->id;
        $compra->desc=$request->desc;
        $compra->status=0;

        $compra->save();
        $compra->user;

        return response()->json([

            'success' => true,
            'message' => 'compra añadida',
            'compra' =>$compra
        ]);

    }


    public function update(Request $request){



        $compra= Compra::find($request->id);
        // chequear si el usuario esta editando su propia compra

        if (Auth::user()->id != $request->id){

            return response()->json([

                'success'=>false,
                'message'=>'acceso no autorizado'
            ]);
        }

        $compra->desc= $request->desc;
        $compra->status= $request->status;
        $compra->update();
        return response()->json([

            'success' => true,
            'message' => 'item de compra editado'
     ]);

    }



    public function delete(Request $request){


        $compra= Compra::find($request->id);
        // chequear si el usuario esta editando su propia compra

        if (Auth::user()->id != $request->id){

            return response()->json([

                'success'=>false,
                'message'=>'acceso no autorizado'
            ]);
        }


        $compra->delete();

        return response()->json([

            'success' => true,
            'message' => 'item de compra eliminado'
     ]);

    }

    public function compras(){


        $compras= Compra::orderBy('id', 'desc')->get();

        foreach($compras as $buy)

        {
            //consigue el usuario de las compras
            $buy->user;

        }


        return response()->json([

            'success' => true,
            'compras' => $compras

     ]);



    }



}
