<?php

namespace Aweram\Metable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "content",
        "property",
        "meta_id",
        "metable_id",
        "metable_type",
        "page",
        "separated",
    ];

    public function child(): HasOne
    {
        return $this->hasOne(self::class, "meta_id");
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, "meta_id");
    }

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }
}
