<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BrandingSetting;
use App\Http\Controllers\Controller;
use Cloudinary\Cloudinary;

class BrandingController extends Controller
{
    protected $cloudinary;
    protected $uploadApi;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary();
        $this->uploadApi = $this->cloudinary->uploadApi();
    }

    public function index()
    {
        $branding = BrandingSetting::first();
        return view('admin.change_logo_favicon', compact('branding'));
    }

    public function update(Request $request)
    {
        $branding = BrandingSetting::firstOrNew();

        // Upload logo
        if ($request->hasFile('logo')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('logo')->getRealPath(),
                ['folder' => 's9fxnetwork/branding']
            );
            $branding->logo = $uploadResult['secure_url'];
        }

        // Upload footer logo
        if ($request->hasFile('footer_logo')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('footer_logo')->getRealPath(),
                ['folder' => 's9fxnetwork/branding']
            );
            $branding->footer_logo = $uploadResult['secure_url'];
        }

        // Upload email logo
        if ($request->hasFile('email_logo')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('email_logo')->getRealPath(),
                ['folder' => 's9fxnetwork/branding']
            );
            $branding->email_logo = $uploadResult['secure_url'];
        }

        // Upload favicon
        if ($request->hasFile('favicon')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('favicon')->getRealPath(),
                ['folder' => 's9fxnetwork/branding']
            );
            $branding->favicon = $uploadResult['secure_url'];
        }

        $branding->save();

        return redirect()->route('branding.index')->with('success', 'Branding settings updated successfully.');
    }
}
