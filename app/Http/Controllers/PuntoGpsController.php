<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoGps;
use Carbon\Carbon;

class PuntoGpsController extends Controller
{
    public function index()
    {
        $puntosGps = PuntoGps::all();
        return view('puntos_gps.index', compact('puntosGps'));
    }

    public function procesarTrama(){
        $filePath = storage_path('app\puntos_gps.txt');
        $fileContent = file_get_contents($filePath);
        $tramas = explode("\n", $fileContent);
        foreach ($tramas as $trama) {
            if (!empty($trama)) {
                $datos = $this->interpretarTrama($trama);
                //dd($datos);
                if ($datos) {
                    PuntoGps::create($datos);
                }
            }
        }

        $puntosGps = PuntoGps::orderBy('id', 'desc')->paginate(100);
        return view('puntos_gps.index', compact('puntosGps'));
    }

    public function interpretarTrama($trama){
        $datos = [];
        
        // trama tiene el siguiente formato: dispositivo,imei,tiempo,placa,version,longitud,latitud,fecha_recepcion
        $campos = explode(',', $trama);
        if (count($campos) === 9) {
            $dispositivo = $campos[0];
            $imei = $campos[1];
            $tiempo = $campos[2];
            $datos_placa_version = explode(';', $campos[4]);
            $placa = $datos_placa_version[0];
            $version = $datos_placa_version[1];
            $datos_long_lat = explode(';', $campos[5]);
            $longitud = substr($datos_long_lat[2], 1);
            $latitud = substr($datos_long_lat[3],1);
            $datos_fecha = explode(';', $campos[8]);
            $fecha = substr($datos_fecha[5], 3, 19);
            $datos = [
                'dispositivo' => $dispositivo,
                'imei' => $imei,
                'tiempo' => date('d-m-Y H:i:s', $tiempo)    ,
                'placa' => $placa,
                'version' => $version,
                'longitud' => floatval($longitud),
                'latitud' => floatval($latitud),
                'fecha_recepcion' => Carbon::parse($fecha),
            ];
        }

        return $datos;
    }
}
