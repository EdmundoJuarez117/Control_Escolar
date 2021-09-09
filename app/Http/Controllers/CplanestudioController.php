<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cplanestudio;
class CplanestudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:admin.planestudio.index'],['only'=>'index']);
    }

    function cmp($a, $b){
        return strcmp($a->name, $b->name);
    }
    public function index(Request $request, $offset=0)
    {
        $this->seccionTitulo = 'Planes de estudio';

        $resultSet = Cplanestudio::getForPagination($offset, $limit = 10);
        $planestudios = $resultSet['data'];
        $totalData = $resultSet['countData'];

        if($request->ajax())
        {
            return [
                'planestudios' => $planestudios,
                'totalData' => $totalData
            ];
        }
        $data = [
            'seccion_titulo' => $this->seccionTitulo,
            'planestudios' => $planestudios,
            'totalData' => $totalData
        ];
        return view('planestudios.index', $data);
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
            'nombre'=> 'required|unique:c_planestudio,nombre',
            'nombre_corto'=> 'required|unique:c_planestudio,nombre_corto',
            'estatus'=> 'required|unique:c_planestudio,estatus',
            'num_creditos_total'=> 'required|unique:c_planestudio,num_creditos_total',
            'num_creditos_min'=> 'required|unique:c_planestudio,num_creditos_min',
            'num_creditos_max'=> 'required|unique:c_planestudio,num_creditos_max',
            'fcreacion'=> 'required|unique:c_planestudio,fcreacion',
            'fmodificacion'=> 'required|unique:c_planestudio,fmodificacion',
            'idcarrera'=> 'required|unique:c_planestudio,idcarrera',
        ]);
        try{
            $planestudio = new Cplanestudio;
            $planestudio->nombre = $request->all()['nombre'];
            $planestudio->nombre_corto = $request->all()['nombre_corto'];
            $planestudio->estatus = $request->all()['estatus'];
            $planestudio->num_creditos_total = $request->all()['num_creditos_total'];
            $planestudio->num_creditos_min = $request->all()['num_creditos_min'];
            $planestudio->num_creditos_max = $request->all()['num_creditos_max'];
            $planestudio->fcreacion = $request->all()['fcreacion'];
            $planestudio->fmodificacion = $request->all()['fmodificacion'];
            $planestudio->idcarrera = $request->all()['idcarrera'];
            $result = $planestudio->save();

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
    public function show(Cplanestudio $cplanestudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cplanestudio $cplanestudio)
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
    public function update(Request $request, Cplanestudio $planestud)
    {
        $result = TRUE;
        $message = "";

        try{
            $id = $request->all()['id'];
            $this->validate($request,[
                'nombre' => 'requiered|unique:c_planestudio,nombre'.$id,
                'nombre_corto' => 'requiered|unique:c_planestudio,nombre_corto'.$id,
                'estatus' => 'requiered|unique:c_planestudio,estatus'.$id,
                'num_creditos_total' => 'requiered|unique:c_planestudio,num_creditos_total'.$id,
                'num_creditos_min' => 'requiered|unique:c_planestudio,num_creditos_min'.$id,
                'num_creditos_max' => 'requiered|unique:c_planestudio,num_creditos_max'.$id,
                'fcreacion' => 'requiered|unique:c_planestudio,fcreacion'.$id,
                'fmodificacion' => 'requiered|unique:c_planestudio,fmodificacion'.$id,
                'idcarrera' => 'requiered|unique:c_planestudio,idcarrera'.$id,                
            ]);
            $result = $planestud->update($request->all());
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
    public function destroy(Cplanestudio $planestudio)
    {
        //
    }
}
