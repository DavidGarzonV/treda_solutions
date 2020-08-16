<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    /**
     * Variable con nombre de tabla del modelo
     * @var string
     */
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'fecha_apertura'
    ];

    /**
     * Set fecha_apertura format
     *
     * @param  string  $value
     * @return string
     */
    public function getFechaAperturaAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }


    public function productos(){
        return $this->hasMany('App\Http\Models\Product', "id_tienda", "id");
    }

    protected $primary = "id";
}
