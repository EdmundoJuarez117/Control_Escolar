<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Ccarrera extends Model
{
    use HasFactory;
    public $table = "c_carrera";
    const CREATED_AT = "fcreacion";
    const UPDATED_AT = "fmodificacion";

    protected $fillable = [
        'id',
        'nombre',
        'fcreacion',
        'fmodificacion'
    ];
  

    public static function getForPagination($ofset, $limit)
    {
        $countData = self::count();

        $data = self::
        select('id', 'nombre','nombre_corto','estatus','fcreacion','fmodificacion','idmodalidad')
        ->orderBy('nombre')
        ->offset($ofset)
        ->limit($limit)->get();
        return [
            'countData' => $countData,
            'data' => $data
        ];
    }
}
