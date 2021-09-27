<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Analytics;
use Spatie\Analytics\Period;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startDate = Carbon::createFromDate(2017);
        $endDate = Carbon::now();
        $error = null;
        try{
        $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $toprefer = Analytics::fetchTopReferrers(Period::days(7));
        $topbrow = Analytics::fetchTopBrowsers(Period::days(7));
        $topbrowpercent = $topbrow->map(function($item) use ($topbrow){return ['percent'=>round($item['sessions']*100/$topbrow->sum('sessions'), 2), 'browser'=>$item['browser']];});
        //dd(Analytics::performQuery(Period::days(7), 'ga:users, ga:sessionsPerUser', ['metrics' => 'ga:pageviews, ga:users','dimensions' => 'ga:browser']));
        $totalvisitor = $this->getallvisitor(Period::create($startDate, $endDate));    
        }catch(\Exception $e){
            $data=collect();
            $toprefer = collect();  
            $topbrowpercent = collect();
            $totalvisitor = null;
            $error = 'Không liên kết được google analytic';
        }
        return view('csm::home', compact('data', 'toprefer', 'topbrowpercent', 'totalvisitor', 'error'));
    }
    protected function getallvisitor(Period $period): int
    {
        $response = Analytics::performQuery(
            $period,
            'ga:users',
            [
                'metrics'=> 'ga:users',
                'dimensions' => 'ga:year'
            ]
        );
        return $response->totalsForAllResults? $response->totalsForAllResults['ga:users'] : 0;
    }
    public function viewfile()
    {
        $ext = strtolower(substr(request()->fn, -3));
        return view('csm::view_picture', compact('ext'));
    }    
}