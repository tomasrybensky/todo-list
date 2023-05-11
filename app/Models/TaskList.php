<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const NAME = 'name';
    public const USER_ID = 'user_id';

    protected $fillable = [
        self::NAME,
        self::USER_ID,
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)
            ->orderBy(Task::IS_COMPLETED);
    }
}
