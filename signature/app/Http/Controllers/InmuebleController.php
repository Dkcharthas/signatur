<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
         return Inmueble::all();
    }else{
        return view('home');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inmueble = new Inmueble();
        $inmueble->nombre = $request->nombre;
        $inmueble->ubicacion = $request->ubicacion;
        $inmueble->balcon = $request->balcon;
        $inmueble->estacionamiento = $request->estacionamiento;
        $inmueble->lavado = $request->lavado;
        $inmueble->nhabitacion = $request->nhabitacion;
        $inmueble->nbaño = $request->nbaño;
        $inmueble->ncama = $request->ncama;
        $inmueble->area = $request->area;
        $inmueble->estado = $request->estado;
        $inmueble->precio = $request->precio;
        // $exploded = explode(',', $request->imagen);
        // $decoded = base64_decode($exploded[1]);

        // if (str_contains($exploded[0], 'jpeg')){
        //     $extension = 'jpg';
        // }
        // else{
        //     $extension = 'png';
        // }

        // $fileName = str_random().'.'.$extension;

        // $path = public_path().'/'.$fileName;

        // file_put_contents($path, $decoded);

        // $inmueble->imagen = $fileName;

        $inmueble->save();

        return $inmueble;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $inmueble = Inmueble::find($id);
        $inmueble->nombre = $request->nombre;
        $inmueble->ubicacion = $request->ubicacion;
        $inmueble->balcon = $request->balcon;
        $inmueble->estacionamiento = $request->estacionamiento;
        $inmueble->lavado = $request->lavado;
        $inmueble->nhabitacion = $request->nhabitacion;
        $inmueble->nbaño = $request->nbaño;
        $inmueble->ncama = $request->ncama;
        $inmueble->area = $request->area;
        $inmueble->estado = $request->estado;
        $inmueble->precio = $request->precio;

        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }
        else{
            $extension = 'png';
        }

        $fileName = str_random().'.'.$extension;

        $path = public_path().'/'.$fileName;

        file_put_contents($path, $decoded);

        $inmueble->imagen = $fileName;

        $inmueble->save();

        return $inmueble;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inmueble = Inmueble::find($id);
        $inmueble->delete();
    }
}
