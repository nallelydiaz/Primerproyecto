<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrincipalController;
use App\Models\Pagina;

/*Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');*/

Route::get('/hello',HomeController::class);
Route::get('post/mensaje',[PostController::class, 'Mensaje']);
Route::get('post/about/{param?}/{name?}',[PostController::class, 'About']);
Route::get('/empresa',[HomeController::class,'empresa'])->name('empresa');


//Definimos el método a utilizar
Route::get('nuevoregistro', function(){
    $pagina=new Pagina;
    $pagina->name='CARLOS';
    $pagina->email='maria4@gmail.com';
    $pagina->email_verified_at=date('Y-m-d');
    $pagina->password='123456';
    $pagina->avatar='user.png';
    $pagina->telefono='99999';
    $pagina->calle='89';
    $pagina->save();
    return $pagina;
});

Route::get('buscarpaginaid',function(){
    $post=Pagina::find(1);
    return $post;
});

Route::get('buscarxname',function(){
    $post=Pagina::where('name','carlos')->first();
    return $post;
});

//Para recuperar mas de un registro
Route::get('obtenertodos',function(){
    $post=Pagina::all();
    return $post;
});

//Definimos el método para cambiar un registro
Route::get('updatename',function(){
    $post=Pagina::where('name','Nallely')->first();
    $post->email='agongoraescalante123@gmail.com';
    $post->save();
    return $post;
});

//Definimos un metodo para obtener una lista conforme a un criterio determinado
//para obetener mas de un registro
Route::get('filter',function(){
    $post=Pagina::where('calle','like','%123%')->orderBy("id","desc")->get();
    return $post;
});

//Para especificar unicamente los campos que quiera
Route::get('trescampos',function(){
    $post=Pagina::select('name','email','telefono')->get();
    return $post;
});

//Conforme a una seleccion solamente traerme 2 registros
Route::get('filtroxnumreg',function(){
    $post=Pagina::select("name","email")->orderBy("name")->take(2)->get();
    return $post;
});

//para eliminar un determinado registro
Route::get('eliminar_registro',function(){
    $post=Pagina::find(1);
    $post->delete();
    return "Eliminado";
});

//obtener la fecha conforme a un formato
Route::get('Obtenerfechaformato',function(){
    $post=Pagina::select("name","email","created_at")->find(3);
    return $post;
});

//obtener el valor de is_active
Route::get('Obtenerestatus',function(){
    $post=Pagina::find(1);
    dd($post->is_active);
});

// el siguiente metodo se debe de llamar mediante a un metodo de tipo request (por ejemplo, utilizando AJAX o Postman)
Route::put('/actualizar-dato/{id}',[HomeController::class,'update'])->name('dato.update');

// metodos para las eliminaciones logicas(recargo y ya no me debe de salir en la tabla) y fisica(me elimina registro de la base de)
// Eliminación lógica: cambia is_active de 1 a 0
Route::post('/eliminacion-logica/{id}', [HomeController::class, 'eliminacionLogica'])->name('dato.eliminacion.logica');

// Eliminación física: borra el registro de la BD
Route::post('/eliminacion-fisica/{id}', [HomeController::class, 'eliminacionFisica'])->name('dato.eliminacion.fisica');




Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact',function () {
    $nombre= "Nallely Diaz Jimenez";
    return view('contact',['nombre'=>$nombre,'carrera'=>'Doctor en Sistemas Computacionales']);
})->name('contact');

