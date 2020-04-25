<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'date_reported', 'date_found', 'description', 'route_lost_on', 'found_location', 'reported_by', 'approval_state'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_reported' => 'datetime',
        'date_found' => 'datetime'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images() {
        return $this->hasMany('App\Image');
    }

}
