<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Over extends Model
{
    use HasFactory;

    protected $fillable = [
        'innings_id',
        'over_number',
        'bowler_id',
        'total_runs',
        'total_wickets',
    ];

    public function inning(): BelongsTo
    {
        return $this->belongsTo(Inning::class);
    }

    public function bowler(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'bowler_id');
    }
}
