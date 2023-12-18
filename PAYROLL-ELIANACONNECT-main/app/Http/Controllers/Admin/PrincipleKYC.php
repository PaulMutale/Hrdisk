<?php

namespace App\Http\Controllers\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Admin;
use DB;
use App\Http\Controllers\Controller;
use Auth;

class PrincipleKYC extends Controller
{
    
    
    private $module = "admin.KYC.";

    public function index()
    {
        $admin = Auth()->user();
        return View($this->module.'profile', [
            'user'=>$admin,
            'form_url'=>route($this->module."update")
        ]);
    }

    public function update(Request $request)
    {
        // Attachments (NRC, PASSPORT, PACRA)
        if ($request->hasFile('company_pacra')) {
            $company_pacra = $request->file('company_pacra')->store('PACRA_CERTIFICATES');
        }
        if (!($request->hasFile('company_pacra'))) {
            $company_pacra = "Null";
        }

        if ($request->hasFile('principle_nrc')) {
            $principle_nrc = $request->file('principle_nrc')->store('PACRA_CERTIFICATES');
        }
        if (!($request->hasFile('principle_nrc'))) {
            $principle_nrc = "Null";
        }

        if ($request->hasFile('principle_passport_photo')) {
            $principle_passport_photo = $request->file('principle_passport_photo')->store('PACRA_CERTIFICATES');
        }
        if (!($request->hasFile('principle_passport_photo'))) {
            $principle_passport_photo = "Null";
        }

        /*
        $folderPath = public_path('files/');

        $image = explode(";base64,", $request->signed);

        $image_type = explode("image/", $image[0]);

        $image_type_png = $image_type[1];

        $image_base64 = base64_decode($image[1]);

        $image_path = 'borrower_photo_signature/'.uniqid() . '.'.$image_type_png;
        
        'principle_signature' => $image_path,

        */


        $data = [
            'principle_name' => $request->principle_name,
            'principle_email' => $request->principle_email,
            'principle_city' => $request->principle_city,
            'principle_province' => $request->principle_province,
            'company_pacra' => $company_pacra,
            'principle_nrc' => $principle_nrc,
            'principle_passport_photo' => $principle_passport_photo,          
            'kyc_status' => 1,
        ];
Admin::find(auth()->id())->update($data);
Alert::toast('Thank you!, we have recieved your form', 'success'); 
return Redirect()->route('admin.dashboard');
    }
}
