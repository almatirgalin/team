<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 04.08.2018
 * Time: 21:46
 */

namespace App\Rest;

use App\Blogpost;
use App\Company;
use App\Deal;
use App\Lead;
use App\Contact;
use App\Phone;
use App\Post;
use App\Rest\Sozdavatel;
use App\Worker;
use Illuminate\Support\Facades\Input;

/**
 * Class Crm
 *
 * @package App\Rest
 */
class Crm
{
    private $dataNames = [
        'PHONE' => 'App\Phone',
        'WEB'   => 'App\Web',
        'EMAIL' => 'App\Email',
    ];

    private $itemsHasData = [
        'deal', 'lead', 'contact', 'company'
    ];
    /**
     * @param $countOnPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDeals($countOnPage)
    {
        if (!session('deals_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Сохранить полученные записи в таблице
            $this->getItems('App\Deal', 'deal_id', 'deal', Fields::deal());
            session(['deals_loaded' => true]);
        }

        //Получить последние записи с пагинацией, с привязанными ответственным, компанией и контактом
        $viewDeals = Deal::select(['*'])->with('assignedBy', 'company', 'contact', 'createdBy')
            ->orderBy('deal_id', 'desc')->paginate($countOnPage);

        return $viewDeals;
    }

    /**
     * @param $countOnPage
     *
     * @return mixed
     */
    public function getLeads($countOnPage)
    {
        if (!session('leads_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Сохранить полученные записи в таблице
            $this->getItems('App\Lead', 'lead_id', 'lead', Fields::lead());
            session(['leads_loaded' => true]);
        }

        //Получить последние записи с пагинацией, с привязанными ответственным, компанией и контактом
        $viewLeads = Lead::select(['*'])->with('assignedBy', 'company', 'contact', 'createdBy')
            ->orderBy('lead_id', 'desc')->paginate($countOnPage);

        return $viewLeads;
    }

    /**
     * @param $countOnPage
     *
     * @return mixed
     */
    public function getContacts($countOnPage)
    {
        if (!session('contacts_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Сохранить полученные записи в таблице
            $this->getItems('App\Contact', 'contact_id', 'contact', Fields::contact());
            session(['contacts_loaded' => true]);
        }

        //Получить последние записи с пагинацией, с привязанными ответственным и контактом
        $viewContacts = Contact::select(['*'])->with('assignedBy', 'company', 'createdBy')
            ->orderBy('contact_id', 'desc')->paginate($countOnPage);

        return $viewContacts;
    }

    /**
     * @param $countOnPage
     *
     * @return mixed
     */
    public function getCompanies($countOnPage)
    {
        if (!session('companies_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Сохранить полученные записи в таблице
            $this->getItems('App\Company', 'company_id', 'company', Fields::company());
            session(['companies_loaded' => true]);
        }

        //Получить последние записи с пагинацией, с привязанными ответственным и контактом
        $viewCompanies = Company::select(['*'])->with('assignedBy', 'contact')
            ->orderBy('company_id', 'desc')->paginate($countOnPage);

        return $viewCompanies;
    }

    /**
     * @param $countOnPage
     *
     * @return mixed
     */
    public function getPosts($countOnPage)
    {
        if (!session('posts_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '2500M');

            //Сохранить полученные записи в таблице
            $this->getItems('App\Post', 'post_id', 'post', Fields::post());
            session(['posts_loaded' => true]);
        }

        //Получить последние записи с пагинацией
        $viewPosts = Post::select(['*'])->with('user')->orderBy('post_id', 'desc')
            ->paginate($countOnPage);

        return $viewPosts;
    }

    /**
     * @param $countOnPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWorkers($countOnPage)
    {
        if (!session('workers_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '2500M');

            //Получить записи
            $this->getItems('App\Worker', 'worker_id', 'worker', Fields::worker());
            session(['workers_loaded' => true]);
        }

        $fired = Input::get('fired', false);
        //Получить последние записи с пагинацией
        $viewWorkers = Worker::select(['*'])->where(
            'active',
            '=',
            !boolval($fired)
        )->orderBy('worker_id', 'desc')->paginate($countOnPage);

        return $viewWorkers;
    }

    public function getReqs()
    {
        if (!session('reqs_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Соотношение полей в таблице и на портале
            $fields = [
                'req_id' => 'ID',
                'entity_type_id' => 'ENTITY_TYPE_ID',
                'entity_id' => 'ENTITY_ID',
                'created_by' => 'CREATED_BY_ID',
                'created_date' => 'DATE_CREATE',
                'modify_date' => 'DATE_MODIFY',
                'name' => 'NAME',
                'active' => 'ACTIVE',
                'rq_name' => 'RQ_NAME',
                'rq_first_name' => 'RQ_FIRST_NAME',
                'rq_last_name' => 'RQ_LAST_NAME',
                'rq_company_name' => 'RQ_COMPANY_NAME',
                'rq_company_full_name' => 'RQ_COMPANY_FULL_NAME',
                'rq_director' => 'RQ_DIRECTOR',
                'rq_accountant' => 'RQ_ACCOUNTANT',
                'rq_contact' => 'RQ_CONTACT',
                'rq_email' => 'RQ_EMAIL',
                'rq_phone' => 'RQ_PHONE',
                'rq_ident_doc' => 'RQ_IDENT_DOC',
                'rq_ident_doc_ser' => 'RQ_IDENT_DOC_SER',
                'rq_ident_doc_num' => 'RQ_IDENT_DOC_NUM',
                'rq_ident_doc_date' => 'RQ_IDENT_DOC_DATE',
                'rq_ident_doc_issued_by' => 'RQ_IDENT_DOC_ISSUED_BY',
                'rq_ident_doc_dep_code' => 'RQ_IDENT_DOC_DEP_CODE',
                'rq_inn' => 'RQ_INN',
                'rq_kpp' => 'RQ_KPP',
                'rq_ogrn' => 'RQ_OGRN',
                'rq_ogrnip' => 'RQ_OGRNIP',
                'rq_okpo' => 'RQ_OKPO',
                'rq_oktmo' => 'RQ_OKTMO',
                'rq_okved' => 'RQ_OKVED'
            ];

            //Сохранить полученные записи в таблице
            $this->saveItems('App\Req', 'req_id', 'req', $fields);
            session(['reqs_loaded' => true]);
        }
    }

    public function getBanks()
    {
        if (!session('banks_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Соотношение полей в таблице и на портале
            $fields = [
                'bank_id' => 'ID',
                'entity_type_id' => 'ENTITY_TYPE_ID',
                'entity_id' => 'ENTITY_ID',
                'date_create' => 'DATE_CREATE',
                'date_modify' => 'DATE_MODIFY',
                'created_by_id' => 'CREATED_BY_ID',
                'name' => 'NAME',
                'active' => 'ACTIVE',
                'rq_bank_name' => 'RQ_BANK_NAME',
                'rq_bank_addr' => 'RQ_BANK_ADDR',
                'rq_bik' => 'RQ_BIK',
                'rq_mfo' => 'RQ_MFO',
                'rq_acc_name' => 'RQ_ACC_NAME',
                'rq_acc_num' => 'RQ_ACC_NUM',
                'rq_acc_currency' => 'RQ_ACC_CURRENCY',
                'rq_cor_acc_num' => 'RQ_COR_ACC_NUM',
                'rq_iban' => 'RQ_IBAN',
                'rq_swift' => 'RQ_SWIFT',
                'rq_bic' => 'RQ_BIC',
                'comments' => 'COMMENTS',
            ];

            //Сохранить полученные записи в таблице
            $this->saveItems('App\Bank', 'bank_id', 'bank', $fields);
            session(['banks_loaded' => true]);
        }
    }

    public function getAddresses()
    {
        if (!session('addresses_loaded')) {
            //Установить PHP ini
            $this->setIni(0, '4000M');

            //Соотношение полей в таблице и на портале
            $fields = [
                'type_id' => 'TYPE_ID',
                'entity_type_id' => 'ENTITY_TYPE_ID',
                'entity_id' => 'ENTITY_ID',
                'address_1' => 'ADDRESS_1',
                'address_2' => 'ADDRESS_2',
                'city' => 'CITY',
                'postal_code' => 'POSTAL_CODE',
                'region' => 'REGION',
                'province' => 'PROVINCE',
            ];

            //Сохранить полученные записи в таблице
            $this->saveItems('App\Address', 'id', 'address', $fields);
            session(['addresses_loaded' => true]);
        }
    }

    /**
     * @param $class
     * @param $idName
     * @param $itemName
     * @param $fields
     */
    private function getItems($class, $idName, $itemName, $fields)
    {
        //Получить ИД последней записи
        $lastId = $this->getLastId($class, $idName);

        $portal = new Sozdavatel();
        //Получить все ИД записи с портала, начиная с ИД последней записи
        $itemsId = $portal->getItemsId($itemName, $lastId);

        $arId = array_chunk($itemsId, 50);

        foreach ($arId as $ids) {
            $itemsData = $portal->getItemData($itemName, $ids);

            foreach ($itemsData as $data) {
                if (in_array($itemName, $this->itemsHasData)) {
                    $item = $data;
                } else {
                    $item = $data[0];
                }

                if (in_array($itemName, $this->itemsHasData)) {
                    foreach ($this->dataNames as $dataName => $className) {
                        if (array_key_exists($dataName, $item)) {
                            if (!empty($item[$dataName])) {
                                foreach ($item[$dataName] as $data) {
                                    $arData = [
                                        $idName => $item['ID'],
                                        'value' => $data['VALUE']
                                    ];
                                    $className::updateOrCreate(
                                        ['value' => $data['VALUE']],
                                        $arData);
                                }
                            }
                        }
                    }
                }

                $itemToSave = [];

                foreach ($fields as $fieldName => $fieldValue) {
                    if (array_key_exists($fieldValue, $item)) {
                        $itemToSave[$fieldName] = $item[$fieldValue];
                    }
                }

                $itemDb = $class::firstOrNew(
                    [$idName => $itemToSave[$idName]],
                    $itemToSave
                );
                if ($itemDb) {
                    $itemDb->save();
                }
            }
        }
    }

    /**
     * @param $class
     * @param $idName
     * @param $itemName
     * @param $fields
     */
    private function saveItems($class, $idName, $itemName, $fields)
    {
        //Получить ИД последней записи
        $lastId = $this->getLastId($class, $idName);

        $portal = new Sozdavatel();
        //Получить все записи с портала, начиная с ИД последней записи
        $items = $portal->getItems($itemName, $lastId);

        $arToSave = [];

        if ($items) {
            foreach ($items as $item) {
                $itemToSave = [];
                //Строим массив для сохранения
                foreach ($fields as $fieldName => $fieldValue) {
                    if (array_key_exists($fieldValue, $item)) {
                        $itemToSave[$fieldName] = $item[$fieldValue];
                    }
                }

                $arToSave[] = $itemToSave;
            }
            //Разбиваем массив на подмассивы
            $chunkedArToSave = array_chunk($arToSave, 200);

            foreach ($chunkedArToSave as $toSave) {
                foreach ($toSave as $arSave) {
                    $itemDb = $class::firstOrNew(
                        [$idName => $arSave[$idName]],
                        $arSave
                    );
                    if ($itemDb) {
                        $itemDb->save();
                    }
                }
            }
            if ($itemName == 'contact') {
                $this->getContactsData($arToSave);
            }
            if ($itemName == 'company') {
                $this->getCompaniesData($arToSave);
            }
        }
    }

    /**
     * @param $arToSave
     */
    private function getContactsData($arToSave)
    {
        $portal = new Sozdavatel();

        foreach ($arToSave as $item) {
            $itemData = $portal->getItemData('contact', $item['contact_id']);
            Contact::where('contact_id', '=', $item['contact_id'])->update($itemData);
        }
    }

    /**
     * @param $arToSave
     */
    private function getCompaniesData($arToSave)
    {
        $portal = new Sozdavatel();

        foreach ($arToSave as $item) {
            $itemData = $portal->getItemData('company', $item['company_id']);
            Company::where('company_id', '=', $item['company_id'])->update($itemData);
        }
    }

    /**
     * @param $time
     * @param $memory
     */
    private function setIni($time, $memory)
    {
        set_time_limit($time);
        ini_set('memory_limit', $memory);
    }

    /**
     * @param $class
     * @param $idName
     *
     * @return int
     */
    private function getLastId($class, $idName) {
        $lastItem = $class::select([$idName])->orderBy(
            $idName,
            'desc'
        )->first();
        return ($lastItem ? $lastItem->{$idName} : 0);
    }

}