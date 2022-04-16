<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, Translatable;


    protected $with = ['translations'];

    protected $translatedAttributes = ['value'];

    protected $fillable = [
        'key',
        'is_tanslatable',
        'plain_value'
    ];

    protected $casts = [
        'is_tanslatable' => 'boolean'
    ];

    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function set($key, $value)
    {
        if ($key === 'translatable') {
            return static::setTranslatablesettings($value);
        }

        static::updateOrCreate(['key' => $key], [
            'plain_value' => is_array($value) ? json_encode($value) : $value
        ]);
    }

    public static function setTranslatablesettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            static::updateOrCreate(['key' => $key], [
                'is_tanslatable' => true,
                'value' => is_array($value) ? json_encode($value) : $value
            ]);
        }
    }
}
