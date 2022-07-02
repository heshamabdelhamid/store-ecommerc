<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'is_active'
    ];

    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getActive()
    {
        return $this->is_active == 0 ? 'not active' : 'active';
    }
}
