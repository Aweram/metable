<?php

namespace Aweram\Metable\Traits;

use Aweram\Metable\Facades\MetaActions;
use Aweram\Metable\Interfaces\ShouldMetaInterface;
use Aweram\Metable\Models\Meta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ShouldMeta
{
    protected static function bootShouldMeta()
    {
        static::deleting(function (ShouldMetaInterface $model) {
            MetaActions::clearByModel($model);
        });
    }

    public function getMetaClassAttribute(): string
    {
        return config("metable.customMetaModel") ?? Meta::class;
    }

    public function metas(): MorphMany
    {
        return $this->morphMany($this->meta_class, "metable");
    }
}
