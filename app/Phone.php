<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Phone
 *
 * @package App
 */
class Phone extends Model
{

    protected $fillable
    = [
        'value',
        'deal_id',
        'lead_id',
        'contact_id',
        'company_id',
    ];

    public $timestamps = false;
}
