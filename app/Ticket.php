<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title', 'priority', 'description', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function product_parts()
    {
        return $this->belongsToMany('App\ProductPart', 'ticket_product_parts');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'ticket_task');
    }
}
