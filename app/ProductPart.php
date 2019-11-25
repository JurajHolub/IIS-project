<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPart extends Model
{
    protected $fillable = [
        'title', 'description', 'author_id', 'product_id', 'version'
    ];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function ticket()
    {
        return $this->belongsToMany('App\Ticket', 'ticket_product_parts');
    }
}
