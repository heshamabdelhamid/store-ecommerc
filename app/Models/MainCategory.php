<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory,
        Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'photo'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function getActive()
    {
        return $this->is_active == 0 ? 'not active' : 'active';
    }

    public function SubCategories()
    {
        return $this->hasMany(SubCategory::class, 'main_category_id');
    }

    // public function scopeParent($query)
    // {
    //     return $query->whereNull('parent_id');
    // }

    // public function scopeChild($query)
    // {
    //     return $query->whereNotNull('parent_id');
    // }

    // public function _parent()
    // {
    //     return $this->belongsTo(self::class, 'parent_id');
    // }
}
