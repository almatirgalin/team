<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 *
 * @package App
 */
class Email extends Model
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
