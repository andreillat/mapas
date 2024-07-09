<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoGps extends Model
{
    use HasFactory;

    protected $table = 'puntos_gps';

    protected $fillable = [
        'dispositivo',
        'imei',
        'tiempo',
        'placa',
        'version',
        'longitud',
        'latitud',
        'fecha_recepcion',
    ];

    protected $dates = [
        'tiempo',
        'fecha_recepcion',
    ];
    
    public $timestamps = false;
}