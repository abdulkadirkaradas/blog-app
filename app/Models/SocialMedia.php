<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SocialMedia extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = "socialmedia";

    protected $keyType = "string";
    public $incrementing = false;
    public $primaryKey = "id";

    public static function boot() {
        parent::boot();
        static::creating(function($model) {
            $model->id = (string)Str::uuid();
        });
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'url',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
