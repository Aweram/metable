<?php

namespace Aweram\Metable\Observers;

use Aweram\Metable\Models\Meta;
use Illuminate\Database\Eloquent\Model;

class MetaObserver
{
    public function created(Model $meta): void
    {
        if (
            in_array($meta->name, config("metable.ogMetas")) &&
            empty($meta->property) &&
            empty($meta->separated)
        ) {
            $data = $meta->toArray();
            $data["property"] = "og:{$meta->name}";
            $data["meta_id"] = $meta->id;
            $metaModel = config("metable.customMetaModel") ?? Meta::class;
            $metaModel::create($data);
        }
        // TODO: forget cache
    }

    public function updated(Model $meta): void
    {
        $child = $meta->child;
        if (! empty($child) && empty($child->separated)) {
            /**
             * @var Model $child
             */
            $data = $meta->toArray();
            $data["meta_id"] = $meta->id;
            $data["property"] = $child->property;
            $child->update($data);
        }
        // TODO: forget cache
    }

    public function deleted(Model $meta)
    {
        $child = $meta->child;
        if (! empty($child)) $child->delete();
        // TODO: forget cache
    }
}
