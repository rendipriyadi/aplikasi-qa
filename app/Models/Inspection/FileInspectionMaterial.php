<?php

namespace App\Models\Inspection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileInspectionMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'file_inspection_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'inspection_material_id',
        'file_inspection',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function inspection_material()
    {
        return $this->belongsTo('App\Models\Inspection\InspectionMaterial', 'inspection_material_id', 'id');
    }
}
