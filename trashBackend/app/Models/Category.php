<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    use HasFactory; use SoftDeletes; use HasTimestamps; use HasUuids;

    protected $table = 'categories';

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
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
