<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserReservationRequest;
use App\Http\Requests\UserReservationRequest;
use App\Models\Interval;
use App\Models\User;
use App\Models\UserReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserReservation::get();
        $users = User::get();
        return view('admin.user_reservations.index', compact('data', 'users'));
    }

    public function get_intervals_price(Request $request)
    {
        $id = $request->id;
        $interval = Interval::find($id);
        return response()->json($interval);
    }

    public function checkDateReservation(Request $request)
    {
        $search_date = $request->date;

        $reservation_exits = UserReservation::whereDate('date', $search_date)->get();

        if (count($reservation_exits) == 2) {

            return response()->json(['reservation_exits'=>$reservation_exits,'intervals'=>0,'length'=>0]);

        } else if (count($reservation_exits)==1) {

            $reservation_exits = UserReservation::whereDate('date',$search_date)->first();
            $intervals = Interval::where('id','!=',$reservation_exits->interval_id)->get();

            return response()->json(['reservation_exits'=>$reservation_exits,'intervals'=>$intervals,'length'=>1]);


        }else {
            $reservation_exits = UserReservation::whereDate('date', $search_date)->get();
            $intervals = Interval::get();
            return response()->json(['reservation_exits'=>[],'intervals'=>$intervals,'length'=>2]);

        }

    }
    public function checkDateReservationEdit(Request $request)
    {
        $search_date = $request->date;
        $user_id= $request->user_id;

        $reservation_exits = UserReservation::whereDate('date', $search_date)->where('user_id','!=',$user_id)->get();

        if (count($reservation_exits) == 2) {

            return response()->json(['reservation_exits'=>$reservation_exits,'intervals'=>0,'length'=>0]);

        } else if (count($reservation_exits)==1) {

            $reservation_exits = UserReservation::whereDate('date',$search_date)->where('user_id','!=',$user_id)->first();
            $reservation = UserReservation::whereDate('date',$search_date)->where('user_id','=',$user_id)->first();
            $intervals = Interval::where('id','!=',$reservation_exits->interval_id)->get();

            return response()->json(['reservation_exits'=>$reservation_exits,'reservation'=>$reservation,'intervals'=>$intervals,'length'=>1]);


        }else {
            $reservation_exits = UserReservation::whereDate('date', $search_date)->where('user_id','!=',$user_id)->get();
            $intervals = Interval::get();
            return response()->json(['reservation_exits'=>[],'intervals'=>$intervals,'length'=>2]);

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $intervals = Interval::get();
        return view('admin.user_reservations.create', compact('users', 'intervals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserReservationRequest $request)
    {

        try {
            DB::beginTransaction();
            if ($request->type_user == 1) {

                $user_data['name'] = $request->name;
                $user_data['phone'] = $request->phone;
                $user_data['verification_id'] = $request->verification_id;
                $user_data['address'] = $request->address;
                $user = User::create($user_data);
                $data['user_id'] = $user->id;

            } else {
                $data['user_id'] = $request->user_id;
            }

            $data['date'] = $request->date;
            $data['interval_id'] = $request->interval_id == "spacial" ? null : $request->interval_id;
            $data['start_custom_time'] = $request->start_custom_time;
            $data['end_custom_time'] = $request->end_custom_time;
            $data['basic_price'] = $request->basic_price;
            $data['manual_price'] = $request->manual_price;
            $data['amount_paid'] = $request->amount_paid;
            if ($request->manual_price == $request->amount_paid) {
                $data['status'] = 1;   //مدفوع كامل
            } elseif ($request->manual_price > $request->amount_paid && $request->amount_paid != 0) {
                $data['status'] = 2;  //مدفوع جزئي
            } else {
                $data['status'] = 3;  //لم يتم الدفع
            }

            UserReservation::create($data);

            DB::commit();
            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('user_reservations.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {


        $data = UserReservation::find($id);
        $intervals = Interval::get();

        $interval_available = UserReservation::where('date',$data->date)->count();

        return view('admin.user_reservations.edit',compact('data','intervals','interval_available'));
        }catch (\Exception $exception){

            return  redirect()->route('user_reservations.index')->with('error','لايمكن الوصول لهذه الصفحة');
        }

        }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserReservationRequest $request,$id)
    {
        try {
            DB::beginTransaction();
            $user_reservation = UserReservation::find($id);
            $data['user_id'] = $user_reservation->user_id;
            $data['date'] = $request->date;
            $data['interval_id'] = $request->interval_id == "spacial" ? null : $request->interval_id;
            $data['start_custom_time'] = $request->start_custom_time;
            $data['end_custom_time'] = $request->end_custom_time;
            $data['basic_price'] = $request->basic_price;
            $data['manual_price'] = $request->manual_price;
            $data['amount_paid'] = $request->amount_paid;
            if ($request->manual_price == $request->amount_paid) {
                $data['status'] = 1;   //مدفوع كامل
            } elseif ($request->manual_price > $request->amount_paid && $request->amount_paid != 0) {
                $data['status'] = 2;  //مدفوع جزئي
            } else {
                $data['status'] = 3;  //لم يتم الدفع
            }

            $user_reservation->update($data);

            DB::commit();
            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('user_reservations.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $user_reservation = UserReservation::find($id);
            $user_reservation->delete();

            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('user_reservations.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
