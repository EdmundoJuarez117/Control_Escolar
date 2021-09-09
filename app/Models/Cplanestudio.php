<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Cplanestudio extends Model
{
    use HasFactory;
    protected $table = 'c_planestudio';

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
        select('id', 'nombre','nombre_corto','estatus','num_creditos_total','num_creditos_min','num_creditos_max','fcreacion','fmodificacion','idcarrera')
        ->orderBy('nombre')
        ->offset($ofset)
        ->limit($limit)->get();
        return [
            'countData' => $countData,
            'data' => $data
        ];
    }
}
