<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTimestamps;
    use UuidTrait;

    public const RELATION_STRING = 'location_uuid';

    protected $table = 'location';

    protected $cast = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    protected $fillable = [
        'title',
        'address',
        'description',
        'lat',
        'lng',
        RecycleType::RELATION_STRING,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function recycleType(): BelongsTo
    {
        return $this->belongsTo(RecycleType::class);
    }
}
