<?php

namespace Aweram\Metable\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

interface MetaModelInterface
{
    public function child(): HasOne;
    public function parent(): BelongsTo;
    public function metable(): MorphTo;
}
