<?php

namespace App\Models\Transfer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'transfer_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_submission_id',
        'inspection_material_id',
        'tgl_penyerahan',
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

    public function inspection_material()
    {
        return $this->belongsTo('App\Models\Inspection\InspectionMaterial', 'inspection_material_id', 'id');
    }

    // one to one
    public function trans_material()
    {
        return $this->hasOne('App\Models\Transfer\TransMaterial', 'transfer_material_id');
    }

    // one to one
    public function trans_tool()
    {
        return $this->hasOne('App\Models\Transfer\TransTool', 'transfer_material_id');
    }

    public function material_testing()
    {
        return $this->hasOne('App\Models\Testing\MaterialTesting', 'inspection_material_id');
    }

    // one to one
    public function file_transfer_material()
    {
        return $this->hasOne('App\Models\Transfer\FileTransferMaterial', 'transfer_material_id');
    }
}
