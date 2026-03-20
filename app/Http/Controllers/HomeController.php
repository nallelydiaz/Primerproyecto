<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    public function __invoke(){
        return view('hello');
    }


    public function empresa(){
        $datos["nombre"]="Nallely Patricia Diaz Jimenez";
        $datos["fecha"]="2026-02-03";
        $datos["actividad"]="Desarrollo de Software";
        $datos["descripcion_about"]="Empresa dedicada al desarrollo de software a 
        la medida de sus clientes";
        $datos["texto_ejemplo"]="Aquí va la descripción del texto de ejemplo";
        
        $usuarios=new Pagina();
        $datos["listadousuarios"]=$usuarios->ObtenerListado();
        return view('empresa', $datos);

    }

    public function update(Request $request){
        $usuarios=new Pagina();
        $respuesta=$usuarios->BuscarId($request->id);
        if(!empty($respuesta)){
            $respuesta->name=$request->name;
            $respuesta->calle=$request->calle;
            $respuesta->save();
        }
        return $respuesta;
    }

    public function eliminacionLogica($id)
{
    $usuario = Pagina::find($id);

    if (!empty($usuario)) {
        $usuario->is_active = 0;
        $usuario->save();
        return response()->json([
            'success' => true,
            'mensaje' => 'Registro desactivado correctamente'
        ]);
    }

    return response()->json([
        'success' => false,
        'mensaje' => 'Registro no encontrado'
    ], 404);
}

public function eliminacionFisica($id)
{
    $usuario = Pagina::find($id);

    if (!empty($usuario)) {
        $usuario->delete();
        return response()->json([
            'success' => true,
            'mensaje' => 'Registro eliminado permanentemente'
        ]);
    }

    return response()->json([
        'success' => false,
        'mensaje' => 'Registro no encontrado'
    ], 404);
}


}
