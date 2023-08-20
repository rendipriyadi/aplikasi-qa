<?php

namespace App\Models\Transfer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileTransferMaterial extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table
    public $table = 'file_transfer_material';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable
    protected $fillable = [
        'transfer_material_id',
        'file',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transfer_material()
    {
        return $this->belongsTo('App\Models\Transfer\TransferMaterial', 'transfer_material_id', 'id');
    }
}
