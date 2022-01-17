<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];


    public function get($key)
    {
        $setting = self::where(['key' => $key])->first();
        if($setting) {
            return $setting->value;
        }
        return;
    }

    use HasFactory;
}
