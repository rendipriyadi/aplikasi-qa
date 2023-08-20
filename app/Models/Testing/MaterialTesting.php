<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialTesting extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'material_testing';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_submission_id',
        'transfer_material_id',
        'tgl_pengujian',
        'lokasi',
        'status',
        'aprv_kasi',
        'aprv_kadep',
        'keterangan',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function material_submission()
    {
        return $this->belongsTo('App\Models\Transaction\MaterialSubmission', 'material_submission_id', 'id');
    }

    public function transfer_material()
    {
        return $this->belongsTo('App\Models\Transfer\TransferMaterial', 'transfer_material_id', 'id');
    }

    // one to one
    public function test_material()
    {
        return $this->hasOne('App\Models\Testing\TestMaterial', 'material_testing_id');
    }

    // one to one
    public function test_tool()
    {
        return $this->hasOne('App\Models\Testing\TestTool', 'material_testing_id');
    }

    // one to one
    public function file_material_testing()
    {
        return $this->hasOne('App\Models\Testing\FileMaterialTesting', 'material_testing_id');
    }
}
