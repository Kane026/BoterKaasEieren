<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';

    protected $fillable = [
        'player_x_id',
        'player_o_id',
        'status',
        'winner_id',
        'current_turn',
        'started_at',
        'finished_at',
    ];

    public function playerX()
    {
        return $this->belongsTo(User::class, 'player_x_id');
    }

    public function playerO()
    {
        return $this->belongsTo(User::class, 'player_o_id');
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

        public function rounds()
    {
        return $this->hasMany(Round::class);
    }

}