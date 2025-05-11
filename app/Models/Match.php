<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchModel extends Model
{
    use HasFactory;

    protected $table = 'matches';  // explicitly set table name if necessary
    protected $fillable = [
        'title',
        'venue',
        'match_type',
        'overs_limit',
        'start_time',
        'status',
        'created_by',
    ];

    // Define relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function teams()
    {
        return $this->hasMany(MatchTeam::class);
    }

    public function players()
    {
        return $this->hasMany(MatchPlayer::class);
    }

    public function permissions()
    {
        return $this->hasMany(MatchPermission::class);
    }

    public function liveState()
    {
        return $this->hasOne(LiveMatchState::class, 'match_id');
    }

    public function innings()
    {
        return $this->hasMany(Inning::class);
    }

    // You can add any custom methods needed for handling specific logic (like match status)
}
