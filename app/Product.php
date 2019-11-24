<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'version', 'description', 'author_id', 'parts_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function parts()
    {
        return $this->hasMany('App\ProductPart')->orderBy('created_at', 'desc');
    }
}
