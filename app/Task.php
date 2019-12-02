<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'state', 'description', 'allocated_hours', 'spent_hours', 'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo('App\User', 'manager_id');
    }

    public function tickets()
    {
        return $this->belongsToMany('App\Ticket', 'ticket_task');
    }

    public function employees()
    {
        return $this->belongsToMany('App\User', 'user_task');
    }

    public function solutions()
    {
        return $this->hasMany('App\Solution')->orderBy('created_at', 'desc');
    }
}
