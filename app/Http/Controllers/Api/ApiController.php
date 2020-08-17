<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use App\Http\Models\Store;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Listado de productos por tienda
     * @return object
     **/
    public function products(Request $request)
    {
        $data = $request->all();
        if (!isset($data["store_id"])) {
            return response()->json(['error' => "Debe enviar el store_id"]);
        }

        $tienda = Store::find($data["store_id"]);
        if (is_null($tienda)) {
            return response()->json(['error' => "La tienda no existe"]);
        }

        $products = Product::where("id_tienda", $data["store_id"])->get()->toArray();

        $productos = [];
        foreach ($products as $producto) {
            $path = public_path('storage/'.$producto['imagen']);
            if (file_exists($path)) {
                $image = base64_encode(file_get_contents($path));
            }else{
                $image = "";
            }
            $producto["imagen"] = $image;
            $producto["imagen"] = $image;
            $productos[] = $producto;
        }
        $products = [];
        return response()->json(['products' => $productos]);
    }
}
