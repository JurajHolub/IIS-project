<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title', 'priority', 'description',
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
