<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusMaterialSubmission extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'status_material_submission';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_submission_id',
        'file',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function material_submission()
    {
        return $this->belongsTo('App\Models\Transaction\MaterialSubmission', 'material_submission_id', 'id');
    }
}
