<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'inspection_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_submission_id',
        'tgl_pemeriksaan',
        'lokasi',
        'file',
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

    // one to one
    public function check_material()
    {
        return $this->hasOne('App\Models\Inspection\CheckMaterial', 'inspection_material_id');
    }

    // one to one
    public function check_tool()
    {
        return $this->hasOne('App\Models\Inspection\CheckTool', 'inspection_material_id');
    }

    // one to one
    public function file_inspection_material()
    {
        return $this->hasOne('App\Models\Inspection\FileInspectionMaterial', 'inspection_material_id');
    }

    public function transfer_material()
    {
        return $this->hasOne('App\Models\Transfer\TransferMaterial', 'inspection_material_id');
    }
}
