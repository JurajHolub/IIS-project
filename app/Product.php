<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'version', 'description', 'author_id', 'parts_id', 'ticket_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket')->orderBy('created_at', 'desc');
    }

    public function parts()
    {
        return $this->hasMany('App\ProductPart')->orderBy('created_at', 'desc');
    }
}
