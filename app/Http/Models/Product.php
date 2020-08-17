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

    
    /**
     * The attributes that are hidden for consult
     *
     * @var array
     */
    protected $hidden = [
        "created_at", "updated_at"
    ];

    protected $primary = "id";
}
