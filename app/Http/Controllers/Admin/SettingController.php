<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:read_settings', ['only' => ['index','show']]);

    }

    public function index()
    {
         $data = Setting::first();
       return view('admin.settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            $settings = Setting::first();
            //check the not exits
            if (empty($settings)) {
                return redirect()->back()->with(['error' => 'عذراً لايمكن الوصول الى البيانات']);

            }
            $request_data['website_title'] = $request->website_title;
            $request_data['phone'] = $request->phone;
            $request_data['phone2'] = $request->phone2;
            $request_data['website_email'] = $request->website_email;
            $request_data['twitter_link'] = $request->twitter_link;
            $request_data['facebook_link'] = $request->facebook_link;
            $request_data['instagram_link'] = $request->instagram_link;
            $request_data['whatsapp_link'] = $request->whatsapp_link;
            $request_data['another_link'] = $request->another_link;
            $request_data['registration_number'] = $request->registration_number;
            $request_data['tax_number'] = $request->tax_number;
            $request_data['address'] = $request->address;
            $request_data['initial_message'] = $request->initial_message;
            $request_data['confirm_message'] = $request->confirm_message;
            $request_data['cancel_message'] = $request->cancel_message;
            $request_data['cancel_time'] = $request->cancel_time;

            if ($request->has('image')) {


                $the_old_path = $settings->getRawOriginal('website_logo');
                if (file_exists('uploads/setting' . $the_old_path) and !empty($the_old_path)) {
                    unlink('uploads/setting' . $the_old_path);
                }
                $the_file_path = uploadFile('uploads/setting', $request->image);
                $request_data['website_logo'] = $the_file_path;

            }

            $settings->update($request_data);


            session()->flash('success', 'تم تحديث البيانات بنجاح');
            return redirect()->route('settings.index');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
