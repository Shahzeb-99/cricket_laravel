<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveMatchState extends Model
{
    use HasFactory;

    protected $table = 'live_match_state';
    public $timestamps = false;
    protected $primaryKey = 'match_id';
    public $incrementing = false;

    protected $fillable = [
        'match_id',
        'current_innings',
        'striker_id',
        'non_striker_id',
        'bowler_id',
        'current_over',
        'current_ball',
        'total_runs',
        'total_wickets',
        'overs_completed',
        'last_updated',
    ];


    protected $casts = [
        'last_updated' => 'datetime',
    ];
    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function innings(): BelongsTo
    {
        return $this->belongsTo(Inning::class, 'current_innings');
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
}
