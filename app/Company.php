<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App
 */
class Company extends Model
{

    protected $fillable
        = [
            'company_id',
            'title',
            'address',
            'address_2',
            'address_city',
            'address_region',
            'reg_address',
            'reg_address_2',
            'reg_address_city',
            'reg_address_region',
            'banking_details',
            'comments',
            'created_by',
            'assigned_by',
            'date_create',
        ];

    protected $dates = ['date_create'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assignedBy()
    {
        return ($this->hasOne('App\Worker', 'worker_id', 'assigned_by'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return ($this->hasOne('App\Worker', 'worker_id', 'created_by'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return ($this->belongsTo('App\Contact'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phone()
    {
        return ($this->belongsTo('App\Phone', 'lead_id', 'lead_id'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
        return ($this->belongsTo('App\Email', 'lead_id', 'lead_id'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function web()
    {
        return ($this->belongsTo('App\Web', 'lead_id', 'lead_id'));
    }

    /**
     * @param $value
     */
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
