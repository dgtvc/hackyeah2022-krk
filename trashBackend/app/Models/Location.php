<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTimestamps;
    use UuidTrait;

    protected $table = 'location';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function newUniqueId()
    {
        return Uuid::uuid4()->toString();
    }

    public function uniqueIds()
    {
        return ['uuid'];
    }
}
