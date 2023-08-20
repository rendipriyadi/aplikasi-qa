<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'check_material';

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
        'sumber',
        'jumlah',
        'satuan_id',
        'metode',
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

    // one to one
    public function test_material()
    {
        return $this->hasOne('App\Models\Testing\TestMaterial', 'check_material_id');
    }

    // one to one
    public function trans_material()
    {
        return $this->hasOne('App\Models\Transfer\TransMaterial', 'check_material_id');
    }
}
