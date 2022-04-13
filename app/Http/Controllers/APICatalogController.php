<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class APICatalogController extends Controller
{
    
    public $parameters = ["title", "year","director","poster","rented","synopsis"];

    public function __construct() {
        $this->middleware('auth.basic.once', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($this->parameters as $field) {
            if ($field=="rented") continue;
            if (!$request->has($field)) {
                $emptyParam[]=$field;
            }
        }
        if (!empty($emptyParam)) return json_encode(['Parametros sin completar' => $emptyParam]);
        $pelicula = new Movie;
		self::movie($pelicula, $request);
        return response()->json($pelicula);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Movie::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelicula=Movie::findOrFail($id);
        self::movie($pelicula, $request);
        return response()->json(Movie::findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula=Movie::findOrFail($id);
		$pelicula->delete();
        return response()->json( ['error' => false,
        'msg' => 'Pelicula eliminada con exito' ] );
    }

    public function putRent($id) {
        $m = Movie::findOrFail( $id );
        $m->rented = true;
        $m->save();
        return response()->json( ['error' => false,
        'msg' => 'La película se ha marcado como alquilada' ] );
    }

    public function putReturn($id) {
        $m = Movie::findOrFail( $id );
        $m->rented = false;
        $m->save();
        return response()->json( ['error' => false,
        'msg' => 'La película se ha marcado como devuelta' ] );
    }

    public function movie($pelicula, $request){

        foreach($this->parameters as $field){
            if (!empty($request->$field)) $pelicula->$field = $request->$field;
        }
		$pelicula->save();
	}
}
