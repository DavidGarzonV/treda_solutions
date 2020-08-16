<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Variable con nombre de tabla del modelo
     * @var string
     */
    protected $table = 'products';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'sku',
        'descripcion',
        'valor',
        'id_tienda',
        'imagen'
    ];

    protected $primary = "id";
}
