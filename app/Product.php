<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'version', 'description', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
