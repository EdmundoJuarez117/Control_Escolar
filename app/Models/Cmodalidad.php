<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Cmodalidad extends Model
{
    use HasFactory;

    protected $table = 'c_modalidad';

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
        select('id', 'nombre')
        ->orderBy('nombre')
        ->offset($ofset)
        ->limit($limit)->get();
        return [
            'countData' => $countData,
            'data' => $data
        ];
    }
}
