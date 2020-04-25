<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'path'
    ];

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
