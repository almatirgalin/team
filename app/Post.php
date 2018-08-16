<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package App
 */
class Post extends Model
{
    protected $fillable = [
        'worker_id',
        'title',
        'message',
        'date_create',
        'post_id'
    ];

    protected $dates = ['date_create'];

    public $timestamps = false;

    public function user()
    {
        return ($this->hasOne('App\Worker', 'worker_id', 'worker_id'));
    }

    public function setDateCreateAttribute($value)
    {
        if ($value == '') {
            $this->attributes['date_create'] = null;
        } else {
            $date = substr($value, 0, 10);
            $this->attributes['date_create'] = new Carbon($date);
        }
    }
}
