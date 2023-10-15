<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentAttachment extends Model
{
    use HasFactory;
    protected $table='parent_attachments';
    public $timestamps=true;
    protected $fillable=[
        'id',
        'file_name',
        'parent_id',
        'created_at',
        'updated_at',
    ];
}
