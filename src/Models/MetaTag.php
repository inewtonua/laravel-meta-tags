<?php

namespace Inewtonua\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'model_id', 'model_type'
    ];

    public function metatagable()
    {
        return $this->morphTo('metatagable', 'model_type', 'model_id');
    }

    public function scopeByType($query, string $type = null)
    {
        return $query->where('model_type', config("meta-tags.types.$type.model"));
    }
    
    public function scopeByPath($query, string $path = '/')
    {
        return $query->where('path', $path);
    }

//    public function byLocale(string $locale = null) {
//        $this->firstWhere('locale', $locale ?? app()->getLocale());
//    }

    public function scopePath($query)
    {
        return $query->whereNotNull('path');
    }
    public function scopeModel($query)
    {
        return $query->whereNull('path');
    }

    public static function types(){
        return self::whereNotNull('model_type')->select('model_type')->distinct()->get()->pluck('model_type')->toArray();
    }

}
