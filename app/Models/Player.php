<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'date_of_birth',
        'status',
        'team_id',
    ];

    // Define the relationship with the Team model
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // Optionally, you can define methods for calculating age, etc.
}
