<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTimestamps;
    use UuidTrait;

    public const RELATION_STRING = 'category_uuid';

    protected $table = 'categories';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot',
    ];

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RecycleType::class);
    }
}
