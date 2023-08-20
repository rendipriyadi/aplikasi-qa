<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMaterialTesting extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'file_material_testing';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_testing_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function material_testing()
    {
        return $this->belongsTo('App\Models\Testing\MaterialTesting', 'material_testing_id', 'id');
    }
}
