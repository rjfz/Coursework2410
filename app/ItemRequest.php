<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_id', 'details', 'approval_status'
    ];
        //all the data that is used for item requests
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
