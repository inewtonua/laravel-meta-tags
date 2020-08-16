<?php

namespace Inewtonua\LaravelMetaTags\Traits;

trait Metatagable
{
    public function metaTag()
    {
        $modelClass = config('meta-tags.model', \Inewtonua\LaravelMetaTags\Models\MetaTag::class);

      //  return $this->morphOne($modelClass, 'model');

        return $this->morphMany($modelClass, 'model')->where('locale', app()->getLocale());
    }
}