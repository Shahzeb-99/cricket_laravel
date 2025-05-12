<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'user_id',
        'role',
        'can_edit',
        'can_delete',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'can_edit' => 'boolean',
            'can_delete' => 'boolean',
        ];
    }
}
