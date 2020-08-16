<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use App\Http\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Listado de productos por tienda
     * @return object
     **/
    public function index($idTienda)
    {
        $tienda = Store::find($idTienda);
        $productos = Product::where("id_tienda", $idTienda)->get();
        return view('product.index', compact('productos', 'tienda'));
    }

    /**
     * Vista de creacion de producto
     * @return object
     **/
    public function create($idTienda)
    {
        return view('product.edit', compact("idTienda"));
    }


    /**
     * Valida los datos de un producto
     * @param Request $request Datos de la peticion
     * @param Collection $product Objeto del producto
     * @return Factory 
     **/
    private function validateProduct($request, $product = NULL, $imagenRequired = NULL)
    {
        $rules = [
            'nombre' => ['required', 'max:255'],
            'sku' => ['required', 'max:255', is_null($product) ? 'unique:products,sku' : Rule::unique('products', 'sku')->ignore($product->id)],
            'descripcion' => ['required', 'max:255'],
            'valor' => ['required', 'min:0', 'numeric'],
            'imagen' => ['file', 'mimes:jpg,jpeg,png'],
            'id_tienda' => ['required']
        ];

        if (($imagenRequired != NULL && $imagenRequired === true) || $imagenRequired === NULL) {
            $rules["imagen"][] = "required";
        }

        $messages = [
            'sku.unique' => "El SKU del producto ya est&aacute; registrado.",
            "imagen.mimes" => "Debe seleccionar un archivo de tipo imagen con los formatos (jpg, jpeg, png)"
        ];

        return $this->validate($request, $rules, $messages);
    }

    /**
     * Vista de creacion de producto
     * @return object
     **/
    public function store(Request $request)
    {
        $datos = $request->all();

        $this->validateProduct($request);

        $imagen = $request->imagen;
        $filename = "product_" . time() . "." . $imagen->getClientOriginalExtension();

        $path = $imagen->storeAs(
            'public',
            $filename
        );

        $product = new Product();
        $id = Product::max("id");
        $product->id = $id ? $id + 1 : 1;
        $product->nombre = $datos["nombre"];
        $product->sku = $datos["sku"];
        $product->descripcion = $datos["descripcion"];
        $product->valor = $datos["valor"];
        $product->id_tienda = $datos["id_tienda"];
        $product->imagen = $filename;
        $product->save();

        Session::flash('message', 'Producto creado correctamente.');
        Session::flash('alert-class', 'alert-success');

        return Redirect::to("/product/" . $datos["id_tienda"]);
    }


    /**
     * Vista de edicion de un producto
     * @return object
     **/
    public function update($id)
    {
        $producto = Product::find($id);
        $idTienda = $producto->id_tienda;
        return view('product.edit', compact("idTienda", "producto"));
    }

    public function edit(Request $request)
    {
        $datos = $request->all();
        $product = Product::find($datos["id"]);

        $imagenRequired = false;
        if (isset($datos["imagenCambiada"])) {
            $imagenRequired = true;
        }

        $this->validateProduct($request, $product, $imagenRequired);

        if ($imagenRequired) {

            if (file_exists(public_path('storage/' . $product->imagen))) {
                unlink(public_path('storage/' . $product->imagen));
            }

            $imagen = $request->imagen;
            $filename = "product_" . time() . "." . $imagen->getClientOriginalExtension();

            $path = $imagen->storeAs(
                'public',
                $filename
            );
        }

        $product->nombre = $datos["nombre"];
        $product->sku = $datos["sku"];
        $product->descripcion = $datos["descripcion"];
        $product->valor = $datos["valor"];
        if ($imagenRequired) $product->imagen = $filename;
        $product->save();

        Session::flash('message', 'Producto actualizado correctamente.');
        Session::flash('alert-class', 'alert-success');

        return Redirect::to("/product/" . $datos["id_tienda"]);
    }

    /**
     * Permite la eliminacion de un producto
     * @return object
     **/
    public function destroy($id)
    {
        try {
            $producto = Product::find($id);

            if (file_exists(public_path('storage/' . $producto->imagen))) {
                unlink(public_path('storage/' . $producto->imagen));
            }
            Product::destroy($id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
