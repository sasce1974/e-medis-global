<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;
use App\Field;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\TestFixture\C;

class Plan extends Model
{
    protected $plans = ['month', 'week', 'day', 'period'];
    protected $plan = 'month';
    public $startDate;
    public $endDate;

    /**
     * return selected plan
     * @param $period - can be 'month', 'week', 'day' or 'period'
     * @return string
     */
    private function selectPlan ($period){
        return in_array($period, $this->plans) ? $period : 'month';
    }


    /**
     * sets $this->startDate, $this->endDate and $this->plan, then returns array of dates
     * @param $startDate - if not set, $this->startDate will be used from the session
     * @param null $plan - can be 'month', 'week', 'day' or 'period'
     * @param null $endDate
     * @param null $go_to - can be 'next' or 'back', used to change date (day, week, month)
     *              When 'back' and 'next' are used, param startDate needs to be null
     * @return CarbonInterface[]
     */
    public function processPlan ($startDate = null, $plan = null, $endDate = null, $go_to = null, $asJSON = false)
    {
        $this->plan = $plan === null ? $this->plan = session('plan', $this->plan) : $this->selectPlan($plan);
        $go_to = ($go_to !== null) ? (in_array($go_to, array('next', 'back')) ? $go_to : null) : null;

        $this->startDate = session('startDate', date('Y-m-d'));
        //creating date object from start date
        $startDate != null ? $date = Carbon::parse($startDate) : ($this->startDate !== null ? $date = Carbon::parse($this->startDate) : $date = Carbon::now());

        //setting start and end date according to plan
        if ($this->plan === 'month') {
            $go_to === 'next' ? $date->addMonth() : null;
            $go_to === 'back' ? $date->subMonth() : null;

            $this->startDate = clone $date->firstOfMonth();
            $this->endDate = clone $date->lastOfMonth();

        } elseif ($this->plan === 'week') {
            $go_to === 'next' ? $date->addWeek() : null;
            $go_to === 'back' ? $date->subWeek() : null;
            $this->startDate = clone $date->startOfWeek();
            $this->endDate = clone $date->endOfWeek();
        } elseif ($this->plan === 'day') {
            $go_to === 'next' ? $date->addDay() : null;
            $go_to === 'back' ? $date->subDay() : null;

            $this->startDate = $this->endDate = clone $date;
        } elseif ($this->plan === 'period') {
            $this->startDate = clone $date;
            if ($endDate !== null) {
                $this->endDate = Carbon::parse($endDate);
            } else {
                $this->endDate = $this->startDate;
            }
        }
        //save startDate in a session to be used for back and next
        session(['startDate' => $this->startDate->format('Y-m-d')]);
        session(['plan' => $this->plan]);

        //we can return array of objects (dates) between start and end date
        //$dates = CarbonPeriod::create($this->startDate->format('Y-m-d'), $this->endDate->format('Y-m-d'))->toArray();

        //or we can return start and end date in array


        if($asJSON){
            //return json_encode([$this->startDate->format('Y-n-j'), $this->endDate->format('Y-n-j')], JSON_HEX_TAG);

            return json_encode($this->fields($this->startDate->format('Y-m-d'), $this->endDate->format('Y-m-d')), JSON_HEX_TAG);
        }


        return $this->fields($this->startDate, $this->endDate);
        //return [$this->startDate->format('Y-n-j'), $this->endDate->format('Y-n-j')];
    }

    /**
     * @param $start
     * @param $end
     * @return mixed - object with all the fields between start and end date
     */
    private function fields($start_date, $end_date, $clinic=null, $department=null, $employee=null){
        //TODO filter by clinic, department and employee
        //if Role is administrator, no filters (all are null)
        //Role is Manager, filter by clinic /
        //Role is dep manager, filter by department /
        //Role is employee, filter by employee

        $fields = Field::whereBetween('date', [$start_date, $end_date])->get();
        $data = array();
        $i = 0;
        foreach ($fields as $field){
            $data[$i]['id'] = $field->id;
            $data[$i]['employee_id'] = $field->employee_id;
            $data[$i]['start_time'] = $field->start_time;
            $data[$i]['end_time'] = $field->end_time;
            $data[$i]['date'] = $field->date;
            $data[$i]['therapy_id'] = $field->therapy_id;
            //$data[$i]['therapy'] = $field->therapyName;
            $data[$i]['therapist_id'] = $field->therapist_id;
            $data[$i]['therapist'] = $field->therapistName($field->therapist_id);
            $data[$i]['record_id'] = $field->record_id;
            $data[$i]['reserved'] = $field->reserved;
            $data[$i]['note'] = Str::limit($field->note, 50);
            $data[$i]['delete_request'] = $field->delete_request;

            $i++;
        }
        return $data;

    }

    public function getPeriodAttribute(){
        return $this->plan;
    }
}
