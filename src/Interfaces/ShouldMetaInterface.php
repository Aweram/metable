<?php

namespace Aweram\Metable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ShouldMetaInterface
{
    public function getMetaClassAttribute(): string;
    public function metas(): MorphMany;
}
