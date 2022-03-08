<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{

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
		return redirect()->action([CatalogController::class, 'getShow'], array('id' => $id));		
	}

	public function postCreate(Request $request){
		$pelicula = new Movie;
		self::movie($pelicula, $request);
		return redirect()->action([CatalogController::class, 'getIndex']);
	}

	public function movie($pelicula, $request){

		$pelicula->title = $request->title;
		$pelicula->year = $request->year;
		$pelicula->director = $request->director;
		$pelicula->poster = $request->poster;
		$pelicula->rented = false;
		$pelicula->synopsis = $request->synopsis; 
		$pelicula->save();
	}
}
