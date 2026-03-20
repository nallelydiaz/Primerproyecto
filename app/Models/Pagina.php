<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Pagina extends Model
{
    protected $table='paginas';
//creamos un atributo mediante cast para el guardado y la obtencion de los datos

    protected function casts():array{ //casts- cuando llame a alguna consuklta y asiganrle un formato, es como el get,se pide el arreglo y el formato que yo quiera
        return [ 
            'created_at'=>'datetime:d-m-Y',
            'is_active'=>'boolean'
        ];

    }

    protected function name():Attribute{
        return Attribute::make(
            set: function($value){//Mutador- todo proceso antes de guardarlo en la BS
               return strtolower($value);
            },
            get:function($value){//Accesor- ya guardado que formato le voy a dar para que lo lea el usuario
                return ucfirst($value);

            }
        );
    }


   /* public function ObtenerListado(){
        $listadousuarios=Pagina::all();
        return $listadousuarios;
    }*/
//Con ese cambio, cuando la eliminación lógica ponga is_active = 0, al recargar la página ese registro ya no aparecerá en la tabla porque el query solo trae los que tienen is_active = 1.
       public function ObtenerListado(){
        $listadousuarios=Pagina::where('is_active', 1)->get();
        return $listadousuarios;
    } 

    public function BuscarId($id){
        $registro=Pagina::find($id);
        return $registro;
    }   

    
}