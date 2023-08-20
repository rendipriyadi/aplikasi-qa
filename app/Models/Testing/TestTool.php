<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestTool extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'test_tool';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'material_testing_id',
        'jenis',
        'type',
        'kapasitas',
        'tahun',
        'jumlah',
        'satuan_id',
        'kondisi',
        'hasil',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function material_testing()
    {
        return $this->belongsTo('App\Models\Testing\MaterialTesting', 'material_testing_id', 'id');
    }

    // one to one
    public function file_test_tool()
    {
        return $this->hasOne('App\Models\Testing\FileTestTool', 'test_tool_id');
    }

    public function satuan()
    {
        return $this->belongsTo('App\Models\MasterData\Satuan', 'satuan_id', 'id');
    }
}
