<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecycleType extends Model
{
    use HasFactory;
    use UuidTrait;

    public const RELATION_STRING = 'recycle_type_uuid';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
