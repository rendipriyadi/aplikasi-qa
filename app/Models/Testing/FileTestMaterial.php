<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileTestMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'file_test_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'test_material_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function test_material()
    {
        return $this->belongsTo('App\Models\Testing\TestMaterial', 'test_material_id', 'id');
    }
}
