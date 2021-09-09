<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cescalaeval;
class CescalaevalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:admin.escalaeval.index'],['only'=>'index']);
    }
    function cmp($a, $b){
        return strcmp($a->name, $b->name);
    }
    public function index(Request $request, $offset=0)
    {
        $this->seccionTitulo = 'Modalidades de la carrera';

        $resultSet = Cescalaeval::getForPagination($offset, $limit = 10);
        $escalaevals = $resultSet['data'];
        $totalData = $resultSet['countData'];

        if($request->ajax())
        {
            return [
                'escalaevals' => $escalaevals,
                'totalData' => $totalData
            ];
        }
        $data = [
            'seccion_titulo' => $this->seccionTitulo,
            'escalaevals' => $escalaevals,
            'totalData' => $totalData
        ];
        return view('escalaevals.index', $data);
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
            'nombre'=> 'required|unique:c_escalaeval,nombre',
            'calificacion_min'=> 'required|unique:c_escalaeval,calificacion_min',
            'calificacion_max'=> 'required|unique:c_escalaeval,calificacion_max',
            'fcreacion'=> 'required|unique:c_escalaeval,fcreacion',
            'fmodificacion'=> 'required|unique:c_escalaeval,fmodificacion',

        ]);
        try{
            $escalaeval = new Cescalaeval;
            $escalaeval->nombre = $request->all()['nombre'];
            $escalaeval->calificacion_min = $request->all()['calificacion_min'];
            $escalaeval->calificacion_max = $request->all()['calificacion_max'];
            $escalaeval->fcreacion = $request->all()['fcreacion'];
            $escalaeval->fmodificacion = $request->all()['fmodificacion'];
            $result = $escalaeval->save();

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
    public function show(Cescalaeval $cescalaeval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cescalaeval $cescalaeval)
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
    public function update(Request $request, Cescalaeval $escalaeva)
    {
        $result = TRUE;
        $message = "";

        try{
            $id = $request->all()['id'];
            $this->validate($request,[
                'nombre' => 'requiered|unique:c_escalaeval,nombre'.$id,
                'calificacion_min' => 'requiered|unique:c_escalaeval,calificacion_min'.$id,
                'calificacion_max' => 'requiered|unique:c_escalaeval,calificacion_max'.$id,
                'fcreacion' => 'requiered|unique:c_escalaeval,fcreacion'.$id,
                'fmodificacion' => 'requiered|unique:c_escalaeval,fmodificacion'.$id,
            ]);
            $result = $escalaeva->update($request->all());
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
    public function destroy(Cescalaeval $escalaeval)
    {
        //
    }
}
