<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function category()
    {
        return $this->belongsTo('App\NewsCategory')->select(['id', 'name']);
    }

    public function mainImage()
    {
        return $this->belongsTo('App\Image')->select(['id', 'name', 'title', 'alt']);
    }

    /**
     * Scope a query to only include featured news.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  String  $option
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query, $option)
    {
        if (!Empty($option)) {
            if ($option === "only") {
                return $query->where('featured', 1);
            } else if ($option === "exclude") {
                return $query->where('featured', 0);
            }
        }
        return $query;
    }

    /**
     * Scope a query to only include news with the given categories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  String  $categories
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCategories($query, $categories)
    {
        if (!Empty($categories)) {
            $categoriesArr = explode(',', $categories);
            return $query->whereIn('category_id', $categoriesArr);
        }
        return $query;
    }
}
