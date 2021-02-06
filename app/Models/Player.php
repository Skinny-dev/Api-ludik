<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Player extends Model
{
    use HasFactory;
    protected $table = 'usuarios';



    public static function getPlayer($acepto){
        
       return self::selectRaw('partidas.idJugador, COUNT(*) AS num, usuarios.Acepto')
                ->join('partidas','usuarios.id','=','partidas.idJugador')
                ->where('usuarios.Acepto',$acepto)
                ->groupby('partidas.idJugador', 'usuarios.Acepto')
                ->orderBy('num','desc')
                ->limit(10)
                ->get();
        
    }
    public static function getRegisterDay($fecha1, $fecha2,$letra){
        
        return self::selectRaw('select count(id) as total,
                        (SELECT count(*) FROM usuarios WHERE fechaRegistro BETWEEN "'.$fecha1.'" and "'.$fecha2.'" and nombre like "'.$letra.'%") as cantidad
                        ((SELECT count(*) FROM usuarios WHERE fechaRegistro BETWEEN "'.$fecha1.'" and "'.$fecha2.'" and nombre like "'.$letra.'%") / count(id)) as porcentaje')
                    ->first();
         
     }
    public static function getDisfraz($idDisfraz){
        
        return self::selectRaw('id, nombre, idDisfraz, (SELECT SUM(partidas.puntos) from partidas where idJugador = usuarios.id) as puntaje')
                        ->join('partidas','usuarios.id','=','partidas.idJugador')
                        ->where('usuarios.idDisfraz',$idDisfraz)
                        ->groupby('partidas.idJugador','usuarios.idDisfraz','usuarios.nombre')
                        ->orderBy('puntaje','desc')
                        ->limit(10)
                        ->get();
     }

     public static function getPromedio($idJugador){

        $promedio = DB::table('partidas')
                        ->selectRaw('partidas.idJugador, sec_to_time(AVG(unix_timestamp(fechaFin) - unix_timestamp(fechaInicio))) as tiempo')
                        ->where('partidas.idJugador',$idJugador)
                        ->groupby('partidas.idJugador')
                        ->first();

        return response()->json($promedio);
     }
}
