<?php

namespace App\Http\Controllers;

use App\Blogpost;
use App\Company;
use App\Contact;
use App\Deal;
use App\Lead;
use App\Post;
use App\Rest\Crm;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

/**
 * Class PageController
 *
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    const DEFAULT_COUNT_ON_PAGE = 15;
    //const CONTACTS_COUNT_ON_PAGE = 15;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crm = new Crm();
        /*$crm->getReqs();
        $crm->getBanks();
        $crm->getAddresses();*/
        $posts = $crm->getPosts(self::DEFAULT_COUNT_ON_PAGE);
        return view('home', compact('posts'));
    }

    /**
     * @param $postId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($postId)
    {
        $post = Post::where('post_id', '=', $postId)->with('user')->first ();
        return view('detail.post', compact('post'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deals()
    {
        $crm = new Crm();
        $deals = $crm->getDeals(self::DEFAULT_COUNT_ON_PAGE);
        return view('list.deals', compact('deals'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deal($id)
    {
        $deal = Deal::where('deal_id', '=', $id)->
        with('assignedBy', 'company', 'contact', 'createdBy')->first ();
        return view('detail.deal', compact('deal'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leads()
    {
        $crm = new Crm();
        $leads = $crm->getLeads(self::DEFAULT_COUNT_ON_PAGE);
        return view('list.leads', compact('leads'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lead($id)
    {
        $lead = Lead::where('lead_id', '=', $id)->
        with('assignedBy', 'company', 'contact', 'createdBy')->first ();
        return view('detail.lead', compact('lead'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        $crm = new Crm();
        $contacts = $crm->getContacts(self::DEFAULT_COUNT_ON_PAGE);
        return view('list.contacts', compact('contacts'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact($id)
    {
        $contact = Contact::where('contact_id', '=', $id)->
        with('assignedBy', 'company', 'createdBy')->first ();
        return view('detail.contact', compact('contact'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function companies()
    {
        $crm = new Crm();
        $companies = $crm->getCompanies(self::DEFAULT_COUNT_ON_PAGE);
        return view('list.companies', compact('companies'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function company($id)
    {
        $company = Company::where('company_id', '=', $id)->
        with('assignedBy', 'contact', 'createdBy')->first ();
        return view('detail.company', compact('company'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workers()
    {
        $crm = new Crm();
        $workers = $crm->getWorkers(self::DEFAULT_COUNT_ON_PAGE);
        $active = '';
        $fired = Input::get('fired', false);
        if (!empty($fired)) {
            $active = 'fired';
        }
        return view('list.workers', compact('workers', 'active'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function worker($id)
    {
        $worker = Worker::where('worker_id', '=', $id)->first ();
        return view('detail.worker', compact('worker'));
    }

    public function test()
    {
        $fields = [
            'blogpost_id' => 1,
            'title' => 'TITLE',
            'message' => 'DETAIL_TEXT',
            'user_id' => 1,
            'publish_date' => '2018-08-03'
        ];

        $ar = array_chunk($fields, 50);
        echo '<pre>';print_r($ar);echo '</pre>';
    }
}
