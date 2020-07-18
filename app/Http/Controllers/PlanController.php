<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
{


    /**
     * @param null $period
     * @param null $start_date
     * @param null $end_date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function planPeriod($period = null, $start_date = null, $end_date = null)
    {
        if(strtotime($start_date) === false) $start_date = null;
        if(strtotime($end_date) === false) $end_date = null;

        $plan = new Plan();
        $dates = $plan->processPlan($start_date, $period, $end_date, null, true);
        $period = $plan->period;
        $start_date = json_encode($plan->startDate->format('Y-m-d'));

        return view('plan.index', compact('dates', 'period', 'start_date'));
    }

    /**
     * @param $next - can be "next" or "back"
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nextBack($next){
        $plan = new Plan();
        in_array($next, array('next', 'back')) ? : $next = null;
        $dates = $plan->processPlan(null, null, null, $next, true);
        $period = $plan->period;
        $start_date = json_encode($plan->startDate->format('Y-m-d'));
        return view('plan.index', compact('dates', 'period', 'start_date'));
    }

}
