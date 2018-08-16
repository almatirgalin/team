<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lead
 *
 * @package App
 */
class Lead extends Model
{
    //
    protected $fillable = [
        'lead_id',
        'title',
        'opportunity',
        'comments',
        'created_by',
        'assigned_by',
        'company_id',
        'contact_id',
        'date_create',
        'name',
        'last_name',
        'second_name',
        'company_title',
        'address',
        'address_2',
        'address_city',
        'address_region',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return ($this->hasOne('App\Company', 'company_id'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return ($this->hasOne('App\Contact', 'contact_id'));
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
