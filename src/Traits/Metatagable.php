<?php

namespace Inewtonua\LaravelMetaTags\Traits;

trait Metatagable
{
    public function metaTag()
    {
        $modelClass = config('meta-tags.model', \Inewtonua\LaravelMetaTags\Models\MetaTag::class);

        if(config('meta-tags.multilingual', true)) {
            return $this->morphMany($modelClass, 'model')->where('locale', app()->getLocale());
        } else {
            return $this->morphOne($modelClass, 'model');
        }

    }
}