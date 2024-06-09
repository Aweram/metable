<?php

namespace Aweram\Metable\Traits;

use Aweram\Metable\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ShouldMeta
{
    public function getMetaClassAttribute(): string
    {
        return config("metable.customMetaModel") ?? Meta::class;
    }

    public function metas(): MorphMany
    {
        return $this->morphMany($this->meta_class, "metable");
    }
}
