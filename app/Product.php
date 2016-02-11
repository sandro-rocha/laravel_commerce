<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommend'
    ];

    public function images()
    {
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function category()
    {
        return $this->belongsTo('CodeCommerce\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function getNameDescriptionAttribute()
    {
        return $this->name." - ".$this->description;
    }

    public function getTagListAttribute()
    {
        $tags = $this->tags->lists('name')->toArray();

        return implode(',', $tags);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured','=',1)->limit(3);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend','=',1)->limit(3);
    }

    public function scopeCategory($query)
    {
        return $query->where('recommend','=',1)->limit(3);
    }
    
    public function scopeProductCategory($query, $id)
    {
        return $query->whereCategoryId($id);
    }
}