<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Models\Store;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Vista de listado de tiendas
     * @return object
     **/
    public function index()
    {
        $tiendas = Store::get();
        return view('store.index', compact('tiendas'));
    }


    /**
     * Vista de creacion de tiendas
     * @return object
     **/
    public function create()
    {
        return view('store.edit');
    }

    /**
     * Guarda la creacion de una tienda
     * @return object
     **/
    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'max:255'],
            'fecha_apertura' => ['required', 'max:255', 'regex:/^([0-2][0-9]|3[0-1])(-)(0[1-9]|1[0-2])\2(\d{4})$/'],
        ];

        $messages = [
            'fecha_apertura.regex' => 'La fecha de apertura no cumple con el formato solicitado (<strong>dd-mm-YYYY</strong>)',
        ];

        $this->validate($request, $rules, $messages);
        $datos = $request->all();

        $store = new Store();
        $id = Store::max("id");
        $store->id = $id ? $id + 1 : 1;
        $store->nombre = $datos['nombre'];
        $store->fecha_apertura = date('Y-m-d', strtotime($datos['fecha_apertura']));
        $store->save();

        Session::flash('message', 'Tienda creada correctamente.');
        Session::flash('alert-class', 'alert-success');

        return Redirect::to("/store");
    }

    /**
     * Vista de edicion de tiendas
     * @return object
     **/
    public function edit($id)
    {
        $tienda = Store::find($id);
        if ($tienda) {
            return view('store.edit', compact("tienda"));
        } else {
            $msg = "La tienda no existe.";
            return view('errors', compact("msg"));
        }
    }

    /**
     * Modifica la informacion de una tienda
     * @return object
     **/
    public function update(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'max:255'],
            'fecha_apertura' => ['required', 'max:255', 'regex:/^([0-2][0-9]|3[0-1])(-)(0[1-9]|1[0-2])\2(\d{4})$/'],
        ];

        $messages = [
            'fecha_apertura.regex' => 'La fecha de apertura no cumple con el formato solicitado (<strong>dd-mm-YYYY</strong>)',
        ];

        $this->validate($request, $rules, $messages);

        $datos = $request->all();
        $store = Store::find($datos["id"]);
        $store->nombre = $datos['nombre'];
        $store->fecha_apertura = date('Y-m-d', strtotime($datos['fecha_apertura']));
        $store->save();

        Session::flash('message', 'Tienda actualizada correctamente.');
        Session::flash('alert-class', 'alert-success');

        return Redirect::to("/store");
    }

    /**
     * Permite la eliminacion de una tienda
     * @return object
     **/
    public function destroy($id)
    {
        try {
            Store::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
