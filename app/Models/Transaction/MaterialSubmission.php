<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSubmission extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'material_submission';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'no_pp',
        'no_permohonan',
        'no_kontrak',
        'divisi_id',
        'vendor_id',
        'tgl_permohonan',
        'jenis_pemeriksaan',
        'jenis_pekerjaan',
        'keterangan',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function file_material_submission()
    {
        return $this->hasOne('App\Models\Transaction\FileMaterialSubmission', 'material_submission_id');
    }

    public function status_material_submission()
    {
        return $this->hasOne('App\Models\Transaction\StatusMaterialSubmission', 'material_submission_id');
    }

    public function inspection_material()
    {
        return $this->hasOne('App\Models\Inspection\InspectionMaterial', 'material_submission_id');
    }

    public function material_testing()
    {
        return $this->hasOne('App\Models\Testing\MaterialTesting', 'material_submission_id');
    }

    public function transfer_material()
    {
        return $this->hasOne('App\Models\Transfer\TransferMaterial', 'material_submission_id');
    }

    public function divisi()
    {
        return $this->belongsTo('App\Models\MasterData\Divisi', 'divisi_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\MasterData\Vendor', 'vendor_id', 'id');
    }
}
