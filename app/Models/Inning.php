<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inning extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'batting_team_id',
        'inning_number',
        'is_completed',
        'total_runs',
        'total_wickets',
        'total_overs',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function battingTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'batting_team_id');
    }

    public function bowlingTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'bowling_team_id');
    }

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
        ];
    }
}
