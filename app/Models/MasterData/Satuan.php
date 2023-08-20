<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'satuan';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many
    public function check_material()
    {
        return $this->hasMany('App\Models\Inspection\CheckMaterial', 'satuan_id');
    }

    // one to many
    public function check_tool()
    {
        return $this->hasMany('App\Models\Inspection\CheckTool', 'satuan_id');
    }

    // one to many
    public function test_tool()
    {
        return $this->hasMany('App\Models\Testing\TestTool', 'satuan_id');
    }

    // one to many
    public function test_material()
    {
        return $this->hasMany('App\Models\Testing\TestMaterial', 'satuan_id');
    }

    // one to one
    public function trans_material()
    {
        return $this->hasOne('App\Models\Transfer\TransMaterial', 'satuan_id');
    }

    // one to one
    public function trans_tool()
    {
        return $this->hasOne('App\Models\Transfer\TransTool', 'satuan_id');
    }
}
