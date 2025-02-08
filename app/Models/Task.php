<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE = 'done';

    protected $table = "tasks";
    protected $primaryKey = "id";
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            $task->status = self::STATUS_PENDING;
        });
    }
}
