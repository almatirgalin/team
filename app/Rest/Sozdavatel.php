<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 02.08.2018
 * Time: 17:45
 */

namespace App\Rest;


use Carbon\Carbon;

/**
 * Class Sozdavatel
 *
 * @package App\Rest
 */
class Sozdavatel
{
    private $result = [];
    private $filter;
    private $lastId;
    private $query = [];
    private $name;
    private $total;
    private $page;
    private $pagesTotal;
    /*private $dateNames = [
        'DATE_CREATE', 'DATE_PUBLISH'
    ];*/

    const BATCH_URL = 'batch';
    const GET_DEAL_URL = 'crm.deal.list';
    const GET_LEAD_URL = 'crm.lead.list';
    const GET_COMPANY_URL = 'crm.company.list';
    const GET_CONTACT_URL = 'crm.contact.list';
    const GET_ONE_CONTACT_URL = 'crm.contact.get';
    const GET_ONE_COMPANY_URL = 'crm.company.get';
    const GET_ONE_LEAD_URL = 'crm.lead.get';
    const GET_ONE_DEAL_URL = 'crm.deal.get';
    const GET_POST_URL = 'log.blogpost.get';
    const GET_WORKER_URL = 'user.get';
    const GET_REQ_URL = 'crm.requisite.list';
    const GET_BANK_URL = 'crm.requisite.bankdetail.list';
    const GET_ADDRESS_URL = 'crm.address.list';
    const PAGE_COUNT = 50;

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    private function restGet($url, $data = [])
    {
        $queryData = http_build_query($data);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $queryData
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);

        return $result;
    }

    /**
     * @param $name
     * @param $url
     * @param $lastId
     */
    private function get($name, $url, $lastId)
    {
        $this->name = $name;

        $this->filter = [
            'filter' => [
                '>ID' => $lastId
            ],
            'select' => [
                'ID'
            ]
        ];

        $result = [];

        $result = $this->restGet(env('TEAM_URL') . $url, $this->filter);
        $this->total = $result['total'];

        if (!empty($result['result']) || $lastId) {
            if (!empty($result['result'])){
                foreach ($result['result'] as $resultId => $item) {
                    $this->result[$name][$item['ID']] = $item;
                }

                $this->pagesTotal = intdiv($this->total, self::PAGE_COUNT);

                $this->page = 1;
            }


            if ($name == 'post' || $name == 'worker') {
                $this->page = floor($lastId / self::PAGE_COUNT);
            }

            if ($this->total > self::PAGE_COUNT) {
                //while(($this->page * self::PAGE_COUNT + 1) < $this->total){
                    $this->buildQuery($url);
                    $this->getPack($name);
                //}
            }
        }
    }

    /**
     * @param $name
     */
    private function getPack($name)
    {
        $result = $this->restGet(env('TEAM_URL') . self::BATCH_URL,
            $this->query);
        $result = $result['result']['result'];

        foreach ($result as $items) {
            if (!empty($items)) {
                foreach ($items as $item) {
                    $this->result[$name][$item['ID']] = $item;
                }
            }
        }
    }

    /**
     * @param $url
     */
    private function buildQuery($url)
    {
        $this->query = [];
        $count = 1;
        while ($count <= 50 && $this->page <= $this->pagesTotal) {
            $this->query['cmd'][$this->name . '_' . $this->page] = $url . '?'
                .http_build_query(
                    array_merge($this->filter, [
                        'start' => $this->page * self::PAGE_COUNT
                    ])
                );
            $count++;
            $this->page++;
        }
    }

    /**
     * @param $itemName
     * @param $lastId
     *
     * @return mixed|null
     */
    public function getItemsId($itemName, $lastId) {
        $this->get($itemName,$this->getUrl($itemName), $lastId);
        $answer = [];

        if (array_key_exists($itemName, $this->result)) {
            $answer = $this->result[$itemName];
        }

        if (count($answer)) {
            $answer = array_pluck($answer, 'ID');
        }

        return $answer;
    }

    /**
     * @param $itemName
     * @param $itemId
     *
     * @return array
     */
    public function getItemData($itemName, $ids)
    {
        $url = $this->getUrl('one_' . $itemName);
        $arQuery = $this->buildGetItemDataQuery($url, $itemName, $ids);
        $data = $this->restGet(env('TEAM_URL') . self::BATCH_URL,
            $arQuery);
        $result = $data['result']['result'];

        return $result;
    }

    /**
     * @param $url
     * @param $itemName
     * @param $ids
     *
     * @return array
     */
    private function buildGetItemDataQuery($url, $itemName, $ids)
    {
        $query = [];
        $filterId = 'id';
        if ($itemName == 'post') {
            $filterId = 'POST_ID';
        }
        foreach($ids as $id) {
            $query['cmd'][$itemName . '_' . $id] = $url . '?' . $filterId . '=' . $id;
        }
        return $query;
    }

    /**
     * @param $url
     * @param $id
     *
     * @return mixed
     */
    private function getItem($url, $id)
    {
        $result = $this->restGet(env('TEAM_URL') . $url . '/?id=' . $id);
        return $result;
    }

    /**
     * @param $itemName
     *
     * @return string
     */
    private function getDataUrl($itemName)
    {
        switch ($itemName) {
            case 'contact' :
                return self::GET_ONE_CONTACT_URL;
                break;
            case 'company' :
                return self::GET_ONE_COMPANY_URL;
                break;
        }
    }

    /**
     * @param $itemName
     *
     * @return string
     */
    private function getUrl($itemName)
    {
        switch ($itemName) {
            case 'deal' :
                return self::GET_DEAL_URL;
                break;
            case 'lead' :
                return self::GET_LEAD_URL;
                break;
            case 'contact' :
                return self::GET_CONTACT_URL;
                break;
            case 'company' :
                return self::GET_COMPANY_URL;
                break;
            case 'worker' :
                return self::GET_WORKER_URL;
                break;
            case 'post' :
                return self::GET_POST_URL;
                break;
            case 'req' :
                return self::GET_REQ_URL;
                break;
            case 'bank' :
                return self::GET_BANK_URL;
                break;
            case 'address' :
                return self::GET_ADDRESS_URL;
                break;
            case 'one_worker' :
                return self::GET_WORKER_URL;
                break;
            case 'one_contact' :
                return self::GET_ONE_CONTACT_URL;
                break;
            case 'one_company' :
                return self::GET_ONE_COMPANY_URL;
                break;
            case 'one_lead' :
                return self::GET_ONE_LEAD_URL;
                break;
            case 'one_deal' :
                return self::GET_ONE_DEAL_URL;
                break;
            case 'one_post' :
                return self::GET_POST_URL;
                break;
        }
    }

}