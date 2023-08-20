<?php

namespace App\Models\Transfer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransTool extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'trans_tool';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'transfer_material_id',
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

    public function transfer_material()
    {
        return $this->belongsTo('App\Models\Transfer\TransferMaterial', 'transfer_material_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo('App\Models\MasterData\Satuan', 'satuan_id', 'id');
    }
}
