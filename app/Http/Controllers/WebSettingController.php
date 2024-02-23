<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class WebSettingController extends Controller
{

    public function contactInfo()
    {
        $setting = DB::table('web_settings')->where('key', 'contactInfo')->first();
        if (count((array)$setting)) {
            $data['contact'] = json_decode($setting->data);
        } else {
            $data['contact'] = [];
        }
        return view('backend.setting.create', $data);
    }

    public function contactInfoProcess(Request $request)
    {
        $request->validate([
            'number1'  => 'required',
            'whatsapp' => 'nullable',
            'email1'   => 'required',
            'address'  => 'required',
        ]);

        $info['number1']    = $request->number1;
        $info['number2']    = $request->number2;
        $info['whatsapp'] = $request->whatsapp;
        $info['email1'] = $request->email1;
        $info['email2'] = $request->email2;
        $info['contact_us_queries_email'] = $request->contact_us_queries_email;
        $info['address'] = $request->address;
        $info['desc'] = $request->desc;
        $contactInfo = DB::table('web_settings')->where('key', 'contactInfo')->first();

        if (!$contactInfo) {
            $webSetting = new WebSetting();
            $webSetting->key = 'contactInfo';
            $webSetting->data = json_encode($info);

            if ($webSetting->save()) {
                $data['type']    = "success";
                $data['message'] = "Setting Added Successfuly!.";
                $data['icon']    = 'mdi-check-all';
            } else {
                $data['type']    = "danger";
                $data['message'] = "Failed to Add Setting, please try again.";
                $data['icon']    = 'mdi-block-helper';
            }

            //return redirect()->route('contactInfo')->with($data);
        } else {
            $setting = WebSetting::where('key', 'contactInfo')->update([
                'data' => json_encode($info)
            ]);

            if ($setting) {
                $data['type'] = "success";
                $data['message'] = "Contact Us Setting Updated Successfuly!.";
                $data['icon'] = 'mdi-check-all';
            } else {
                $data['type'] = "danger";
                $data['message'] = "Failed to Update Setting, please try again.";
                $data['icon'] = 'mdi-block-helper';
            }
        }
        $data['page_title'] = "Web Setting";
        $data['section']    = "Setting";
        return redirect()->route('websetting')->with($data);
    }


    public function webLogos()
    {
        $setting = DB::table('web_settings')->where('key', 'contactInfo')->first();
        if (count((array)$setting)) {
            $data['contact'] = json_decode($setting->data);
        } else {
            $data['contact'] = [];
        }

        $data['page_title'] = 'Web Settings';
        $data['section'] = 'All Setting';

        return view('backend.setting.create', $data);
    }



    public function webLogosProcess(Request $request)
    {
        if ($request->update_header_logo) {
            return $this->addOrUpdateLogos('logo', $request->image_name, $request);
        } elseif ($request->update_fav_logo) {
            return $this->addOrUpdateLogos('favicon', $request->image_name, $request);
        } elseif ($request->update_footer_logo) {
            return $this->addOrUpdateLogos('footer', $request->image_name, $request);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }




    public function addOrUpdateLogos($getInput, $imageName, $request)
    {

        $request->validate([
            $getInput => 'required|mimes:jpeg,jpg,png,ico,gif|max:1024'
        ], [$getInput . '.required' => 'Please upload valid image for ' . $getInput]);

        $logo = DB::table('web_settings')->where('key', $getInput)->first();
        $image = $request->file($getInput);


        if (isset($imageName)) {
            $imageName = Str::slug(Str::replace('.', ' ', $imageName)) . '.' . $image->getClientOriginalExtension();
        } else {
            $imageName = $image->getClientOriginalName();
        }

        if (!$logo) {

            $webSetting = new WebSetting();
            $webSetting->key = $getInput;
            $webSetting->addedBy = Auth::id();

            if ($image->move('assets/frontend/images/logos/', $imageName)) {

                $webSetting->data = json_encode([$getInput => $imageName]);

                if ($webSetting->save()) {
                    $data['type'] = "success";
                    $data['message'] = Str::ucfirst($getInput) . " Added Successfuly!.";
                    $data['icon'] = 'mdi-check-all';
                } else {
                    $data['type'] = "danger";
                    $data['message'] = "Failed to Add " . Str::ucfirst($getInput) . ", please try again.";
                    $data['icon'] = 'mdi-block-helper';
                }

                return redirect()->route('websetting')->with($data);
            } else {
                $data['type'] = "danger";
                $data['message'] = "Failed to upload image, please try again.";
                $data['icon'] = 'mdi-block-helper';

                return redirect()->route('websetting')->with($data);
            }
        } else {

            if ($image->move('assets/frontend/images/logos/', $imageName)) {

                $setting = WebSetting::where('key', $getInput)->update([
                    'data' => json_encode([$getInput => $imageName])
                ]);

                if ($setting) {
                    $data['type'] = "success";
                    $data['message'] = Str::ucfirst($getInput) . " Updated Successfuly!.";
                    $data['icon'] = 'mdi-check-all';
                    return redirect()->route('websetting')->with($data);
                } else {
                    $data['type'] = "danger";
                    $data['message'] = "Failed to Update " . Str::ucfirst($getInput) . ", please try again.";
                    $data['icon'] = 'mdi-block-helper';
                }
            } else {
                $data['type'] = "danger";
                $data['message'] = "Failed to upload image, please try again.";
                $data['icon'] = 'mdi-block-helper';

                return redirect()->route('websetting')->with($data);
            }
        }
    }

    public function classLocationProcess(Request $request){
        $location = WebSetting::where('key', 'classLocation')->first();

        $webSetting = new WebSetting();
        $webSetting->key = 'classLocation';
        $webSetting->data = json_encode($request->all());
        
        if (!$location ? $webSetting->save() : WebSetting::where('key', 'classLocation')->update(['data' => json_encode($request->all())])) {
            $data['type'] = "success";
            $data['message'] = $location ? "Location Setting Updated Successfully!." : "Location saved Successfully!.";
            $data['icon'] = 'mdi-check-all';
        } else {
            $data['type'] = "danger";
            $data['message'] = $location ? "Failed to Update Setting, please try again." : "Failed to Add Location, please try again.";
            $data['icon'] = 'mdi-block-helper';
        }
        
        $data['page_title'] = "Web Setting";
        $data['section'] = "Setting";
        

            return redirect()->route('websetting')->with($data);


    }

}
