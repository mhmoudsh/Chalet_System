<?php

namespace App\Traits;

use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

trait getSubscriptionFunctionsTrait
{

    /**
     * @return void
     */
    function  getSubscriptionData(Request $request)
    {
        $id  = $request->id;
        $subscription = Subscription::find($id);

      return response()->json(['subscription'=>$subscription]);

    }

    function  getDuration($duration){

        $date = date_create(date('Y-m-d'));
        date_add($date, date_interval_create_from_date_string($duration.' Months'));

        $data['start_at'] =date('Y-m-d');
        $data['end_at'] = date_format($date, 'Y-m-d');

        return $data ;
    }


    function  search_ajax(Request $request)
    {

        if ($request->ajax()) {

            $search_by_status = $request->search_by_status;
            $search_by_text = $request->search_by_text;


            if ($search_by_status == 0) {
                $field1 = "status";
                $value1 = -1;
                $operator1=">";
            } else {
                if ($search_by_status == 1) {
                    $field1 = "status";
                    $value1 = 1;
                    $operator1="=";
                } else {
                    $field1 = "status";
                    $value1 = 2;
                    $operator1="=";
                }

            }

            if($search_by_text!=''){

                $operator2="like";
                $value2="%{$search_by_text}%";
                $field2 = 'name';

            }else{
                //true
                $field2="id";
                $operator2=">";
                $value2=0;
            }


            $data = UserSubscription::where(function ($query) use ($field1,$operator1, $value1) {
                $query->where($field1, $operator1,$value1);



            })->when($search_by_text,function ($query) use($field2,$operator2,$value2) {

                $query->whereHas('user',function ($query) use($field2,$operator2,$value2){

                    $query->where($field2,$operator2,$value2);

                });


            })->paginate(10);


            return view('admin.usersubscription.search', ['data' => $data]);


        }
    }
}
