<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileTestTool extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'file_test_tool';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'test_tool_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function test_tool()
    {
        return $this->belongsTo('App\Models\Testing\TestTool', 'test_tool_id', 'id');
    }
}
