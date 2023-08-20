<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'test_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'check_material_id',
        'material_testing_id',
        'metode',
        'jumlah',
        'satuan_id',
        'hasil',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function check_material()
    {
        return $this->belongsTo('App\Models\Inspection\CheckMaterial', 'check_material_id', 'id');
    }

    public function material_testing()
    {
        return $this->belongsTo('App\Models\Testing\MaterialTesting', 'material_testing_id', 'id');
    }
    // one to one
    public function file_test_material()
    {
        return $this->hasOne('App\Models\Testing\FileTestMaterial', 'test_material_id');
    }

    public function satuan()
    {
        return $this->belongsTo('App\Models\MasterData\Satuan', 'satuan_id', 'id');
    }
}
