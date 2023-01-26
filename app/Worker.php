<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Worker
 *
 * @package App
 */
class Worker extends Model
{

    protected $fillable
        = [
            'worker_id',
            'name',
            'last_name',
            'second_name',
            'birth_date',
            'register_date',
            'photo',
            'position',
            'skills',
            'interests',
            'email',
            'phone',
            'skype',
            'active',
        ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contacts()
    {
        return $this->belongsTo('App\Contact');
    }

    /**
     * @param $value
     */
    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = boolval($value);
    }

    public function setBirthDateAttribute($value)
    {
        if ($value == '' || substr($value, 0, 4) <= 1970) {
            $this->attributes['birth_date'] = null;
        } else {
            $date = substr($value, 0, 10);
            $this->attributes['birth_date'] = new Carbon($date);
        }
    }
}
