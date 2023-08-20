<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckTool extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'check_tool';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'inspection_material_id',
        'jenis',
        'type',
        'kapasitas',
        'tahun',
        'jumlah',
        'satuan_id',
        'kondisi',
        'hasil',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function inspection_material()
    {
        return $this->belongsTo('App\Models\Inspection\InspectionMaterial', 'inspection_material_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo('App\Models\MasterData\Satuan', 'satuan_id', 'id');
    }
}
