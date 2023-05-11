<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const NAME = 'name';
    public const IS_COMPLETED = 'is_completed';

    protected $fillable = [
        self::NAME,
        self::IS_COMPLETED,
    ];

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class);
    }

    public function markCompleted(): void
    {
        $this->update([
             self::IS_COMPLETED => true,
        ]);
    }
}
