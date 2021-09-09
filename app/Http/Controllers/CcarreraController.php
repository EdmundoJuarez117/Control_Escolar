<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ccarrera;

class CcarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:admin.carrera.index'],['only'=>'index']);
    }

    function cmp($a, $b){
        return strcmp($a->name, $b->name);
    }
    public function index(Request $request, $offset=0)
    {
        $this->seccionTitulo = 'Carreras';

        $resultSet = Ccarrera::getForPagination($offset, $limit = 10);
        $carreras = $resultSet['data'];
        $totalData = $resultSet['countData'];

        if($request->ajax())
        {
            return [
                'carreras' => $carreras,
                'totalData' => $totalData
            ];
        }
        $data = [
            'seccion_titulo' => $this->seccionTitulo,
            'carreras' => $carreras,
            'totalData' => $totalData
        ];
        return view('carreras.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create function";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'=> 'required|unique:c_carrera,nombre',
            'nombre_corto'=> 'required|unique:c_carrera,nombre_corto',
            'estatus'=> 'required|unique:c_carrera,estatus',
            'fcreacion'=> 'required|unique:c_carrera,fcreacion',
            'fmodificacion'=> 'required|unique:c_carrera,fmodificacion',
            'idmodalidad'=> 'required|unique:c_carrera,idmodalidad',
        ]);
        try{
            $carrera = new Ccarrera;
            $carrera->nombre = $request->all()['nombre'];
            $carrera->nombre_corto = $request->all()['nombre_corto'];
            $carrera->estatus = $request->all()['estatus'];
            $carrera->fcreacion = $request->all()['fcreacion'];
            $carrera->fmodificacion = $request->all()['fmodificacion'];
            $carrera->idmodalidad = $request->all()['idmodalidad'];
            $result = $carrera->save();

            return response()->json([
                'result' => $result,
                'message' => '',
            ]);
        }catch (\Illuminate\Database\QueryException $exception){
            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1062){
                //houston, we have a duplicate entry problem
            }
            return response()->json([
                'result' => FALSE,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ccarrera $ccarrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ccarrera $ccarrera)
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
    public function update(Request $request, Ccarrera $carrer)
    {
        $result = TRUE;
        $message = "";

        try{
            $id = $request->all()['id'];
            $this->validate($request,[
                'nombre' => 'requiered|unique:c_carrera,nombre'.$id,
                'nombre_corto' => 'requiered|unique:c_carrera,nombre_corto'.$id,
                'estatus' => 'requiered|unique:c_carrera,estatus'.$id,
                'fcreacion' => 'requiered|unique:c_carrera,fcreacion'.$id,
                'fmodificacion' => 'requiered|unique:c_carrera,fmodificacion'.$id,
                'idmodalidad' => 'requiered|unique:c_carrera,idmodalidad'.$id,
            ]);
            $result = $carrer->update($request->all());
            $message = ($result)?"":"Reintente por Favor";
        }catch(\Illuminate\Database\QueryException $exception){
            $result = FALSE;
            $message = $exception->getMessage();
        }
        return response()->json([
            'result' => $result,
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ccarrera $carrera)
    {
        //
    }
}
