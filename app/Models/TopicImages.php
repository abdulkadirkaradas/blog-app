<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TopicImages extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = "topic_images";

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
        'file_id',
        'file_name',
        'file_extension',
        'file_url',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
