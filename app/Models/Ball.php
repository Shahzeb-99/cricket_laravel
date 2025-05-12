<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ball extends Model
{
    use HasFactory;

    protected $fillable = [
        'over_id',
        'ball_number',
        'striker_id',
        'non_striker_id',
        'bowler_id',
        'runs_scored',
        'extras',
        'is_wicket',
        'wicket_type',
        'dismissed_player_id',
    ];


    public function over(): BelongsTo
    {
        return $this->belongsTo(Over::class);
    }

    public function striker(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'striker_id');
    }

    public function nonStriker(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'non_striker_id');
    }

    public function bowler(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'bowler_id');
    }

    public function dismissedPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'dismissed_player_id');
    }

    protected function casts(): array
    {
        return [
            'extras' => 'array',
            'is_wicket' => 'boolean',
        ];
    }
}
