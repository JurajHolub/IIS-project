<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
