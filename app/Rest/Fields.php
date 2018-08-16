<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 13.08.2018
 * Time: 22:20
 */

namespace App\Rest;

/**
 * Class Fields
 *
 * @package App\Rest
 */
class Fields
{

    const LEAD_FIELDS
        = [
            'lead_id'        => 'ID',
            'title'          => 'TITLE',
            'name'           => 'NAME',
            'last_name'      => 'LAST_NAME',
            'second_name'    => 'SECOND_NAME',
            'company_title'  => 'COMPANY_TITLE',
            'address'        => 'ADDRESS',
            'address_2'      => 'ADDRESS_2',
            'address_city'   => 'ADDRESS_CITY',
            'address_region' => 'ADDRESS_REGION',
            'opportunity'    => 'OPPORTUNITY',
            'comments'       => 'COMMENTS',
            'created_by'     => 'CREATED_BY_ID',
            'assigned_by'    => 'ASSIGNED_BY_ID',
            'company_id'     => 'COMPANY_ID',
            'contact_id'     => 'CONTACT_ID',
            'date_create'    => 'DATE_CREATE',
        ];

    const DEAL_FIELDS
        = [
            'deal_id'      => 'ID',
            'title'        => 'TITLE',
            'stage'        => 'STAGE_ID',
            'opportunity'  => 'OPPORTUNITY',
            'closed'       => 'CLOSED',
            'comments'     => 'COMMENTS',
            'created_by'   => 'CREATED_BY_ID',
            'assigned_by'  => 'ASSIGNED_BY_ID',
            'company_id'   => 'COMPANY_ID',
            'contact_id'   => 'CONTACT_ID',
            'date_create'  => 'DATE_CREATE',
        ];

    const CONTACT_FIELDS
        = [
            'contact_id'     => 'ID',
            'name'           => 'NAME',
            'last_name'      => 'LAST_NAME',
            'birth_date'     => 'BIRTHDATE',
            'second_name'    => 'SECOND_NAME',
            'address'        => 'ADDRESS',
            'address_2'      => 'ADDRESS_2',
            'address_city'   => 'ADDRESS_CITY',
            'address_region' => 'ADDRESS_REGION',
            'post'           => 'POST',
            'comments'       => 'COMMENTS',
            'created_by'     => 'CREATED_BY_ID',
            'assigned_by'    => 'ASSIGNED_BY_ID',
            'company_id'     => 'COMPANY_ID',
            'date_create'    => 'DATE_CREATE',
        ];

    const COMPANY_FIELDS
        = [
            'company_id'         => 'ID',
            'title'              => 'TITLE',
            'address'            => 'ADDRESS',
            'address_2'          => 'ADDRESS_2',
            'address_city'       => 'ADDRESS_CITY',
            'address_region'     => 'ADDRESS_REGION',
            'banking_details'    => 'BANKING_DETAILS',
            'reg_address'        => 'REG_ADDRESS',
            'reg_address_2'      => 'REG_ADDRESS_2',
            'reg_address_city'   => 'REG_ADDRESS_CITY',
            'reg_address_region' => 'REG_ADDRESS_REGION',
            'comments'           => 'COMMENTS',
            'created_by'         => 'CREATED_BY_ID',
            'assigned_by'        => 'ASSIGNED_BY_ID',
            'date_create'        => 'DATE_CREATE',
        ];

    const POST_FIELDS
        = [
            'post_id'      => 'ID',
            'title'        => 'TITLE',
            'message'      => 'DETAIL_TEXT',
            'worker_id'    => 'AUTHOR_ID',
            'date_create'  => 'DATE_PUBLISH',
        ];

    const WORKER_FIELDS
        = [
            'worker_id'   => 'ID',
            'name'        => 'NAME',
            'last_name'   => 'LAST_NAME',
            'second_name' => 'SECOND_NAME',
            'birth_date'  => 'PERSONAL_BIRTHDAY',
            'photo'       => 'PERSONAL_PHOTO',
            'position'    => 'WORK_POSITION',
            'skills'      => 'UF_SKILLS',
            'interests'   => 'UF_INTERESTS',
            'email'       => 'EMAIL',
            'phone'       => 'PERSONAL_MOBILE',
            'skype'       => 'UF_SKYPE',
            'active'      => 'ACTIVE',
        ];

    /**
     * @return array
     */
    public static function lead()
    {
        return self::LEAD_FIELDS;
    }

    /**
     * @return array
     */
    public static function deal()
    {
        return self::DEAL_FIELDS;
    }

    /**
     * @return array
     */
    public static function contact()
    {
        return self::CONTACT_FIELDS;
    }

    /**
     * @return array
     */
    public static function company()
    {
        return self::COMPANY_FIELDS;
    }

    /**
     * @return array
     */
    public static function post()
    {
        return self::POST_FIELDS;
    }

    /**
     * @return array
     */
    public static function worker()
    {
        return self::WORKER_FIELDS;
    }

}