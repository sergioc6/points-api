<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Point extends Model
{
    protected $table = 'points';

    protected $fillable = [
        'description',
        'x_axis',
        'y_axis'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public static function getNearbyPoints($id, $limit = 15)
    {
        return DB::select('
                SELECT p2.*,
                       (
                           sqrt(power(p1.x_axis - p2.x_axis, 2) + power(p1.y_axis - p2.y_axis, 2))
                       ) AS distance
                FROM points p1,
                     points p2
                WHERE p1.id <> p2.id
                  AND p1.id = :id
                ORDER BY distance ASC
                LIMIT :limit
         ', [
            'id' => $id,
            'limit' => $limit
        ]);
    }
}
