<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cmodalidad;

class CmodalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:admin.modalidad.index'],['only'=>'index']);
    }

    function cmp($a, $b){
        return strcmp($a->name, $b->name);
    }

    public function index(Request $request, $offset=0)
    {
        $this->seccionTitulo = 'Modalidades';

        $resultSet = Cmodalidad::getForPagination($offset, $limit = 10);
        $modalidades = $resultSet['data'];
        $totalData = $resultSet['countData'];

        if($request->ajax())
        {
            return [
                'modalidades' => $modalidades,
                'totalData' => $totalData
            ];
        }
        $data = [
            'seccion_titulo' => $this->seccionTitulo,
            'modalidades' => $modalidades,
            'totalData' => $totalData
        ];
        return view('modalidades.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre'=> 'required|unique:c_modalidad,nombre',
        ]);
        try{
            $modalidad = new Cmodalidad;
            $modalidad->nombre = $request->all()['nombre'];
            $result = $modalidad->save();

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
    public function show(Cmodalidad $cmodalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cmodalidad $cmodalidad)
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
    public function update(Request $request, Cmodalidad $modalidade)
    {
        $result = TRUE;
        $message = "";

        try{
            $id = $request->all()['id'];
            $this->validate($request,[
                'nombre' => 'requiered|unique:c_modalidad,nombre'.$id,
            ]);
            $result = $modalidade->update($request->all());
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
    public function destroy(Cmodalidad $modalidad)
    {
        //
    }
}
