<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use RealRashid\SweetAlert\Facades\Alert;

class CatalogController extends Controller
{

	public $parameters = ["title", "year","director","poster","rented","synopsis"];

	public function getIndex()
	{
		$arrayPeliculas = Movie::all();
		return view('catalog.index', array('arrayPeliculas' => $arrayPeliculas));
	}
	public function getShow($id)
	{
		$pelicula=Movie::findOrFail($id);
		return view('catalog.show', array('id' => $id, 'pelicula'=> $pelicula));
	}
	public function getCreate()
	{
		return view('catalog.create');
	}
	public function getEdit($id)
	{
		$pelicula=Movie::findOrFail($id);
		return view('catalog.edit', array('pelicula'=> $pelicula));
	}

	public function putEdit(Request $request, $id){
		$pelicula=Movie::findOrFail($id);
		self::movie($pelicula, $request);
		toast('Película modificada con exito','success');
		return redirect()->action([CatalogController::class, 'getShow'], array('id' => $id));		
	}

	public function postCreate(Request $request){
		$pelicula = new Movie;
		self::movie($pelicula, $request);
		toast('Película agregada con exito','success');
		return redirect()->action([CatalogController::class, 'getIndex']);
	}

	public function putRent($id){
		$pelicula=Movie::findOrFail($id);
		$pelicula->rented = true;	
		$pelicula->save();
		toast('Película alquilada con exito','success');
		return redirect()->action([CatalogController::class, 'getShow'], array('id' => $id));	
	}

	public function putReturn($id){
		$pelicula=Movie::findOrFail($id);
		$pelicula->rented = false;
		$pelicula->save();	
		toast('Película devuelta con exito','success');
		return redirect()->action([CatalogController::class, 'getShow'], array('id' => $id));	
	}

	public function deleteMovie($id){
		$pelicula=Movie::findOrFail($id);
		$pelicula->delete();
		toast('Película eliminada con exito','success');
		return redirect()->action([CatalogController::class, 'getIndex']);
	}

	public function movie($pelicula, $request){

        foreach($this->parameters as $field){
			if ($field=="rented") continue;
            $pelicula->$field = $request->$field;
        }
		$pelicula->save();
	}
}
