<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cloudinary\Cloudinary;

class WalletController extends Controller
{
    protected $cloudinary;
    protected $uploadApi;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary();
        $this->uploadApi = $this->cloudinary->uploadApi();
    }

    // Display a listing of the wallets
    public function index()
    {
        $wallets = Wallet::all();
        return view('admin.wallets.index', compact('wallets'));
    }

    // Show the form for creating a new wallet
    public function create()
    {
        return view('admin.wallets.create');
    }

    // Store a newly created wallet
    public function store(Request $request)
    {
        $request->validate([
            'wallet_name' => 'required|string|max:255',
            'wallet_address' => 'required|string|max:255',
            'barcode' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barcodeUrl = null;
        if ($request->hasFile('barcode')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('barcode')->getRealPath(),
                [
                    'folder' => 's9fxnetwork/barcodes',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'limit'
                    ]
                ]
            );
            $barcodeUrl = $uploadResult['secure_url'];
        }

        Wallet::create([
            'wallet_name' => $request->wallet_name,
            'wallet_address' => $request->wallet_address,
            'barcode' => $barcodeUrl,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet created successfully.');
    }


    // Show the form for editing the specified wallet
    public function edit($id)
    {
        $wallet = Wallet::findOrFail($id);
        return view('admin.wallets.edit', compact('wallet'));
    }

    // Update the specified wallet
    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'wallet_name' => 'required|string|max:255',
            'wallet_address' => 'required|string|max:255',
            'barcode' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('barcode')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('barcode')->getRealPath(),
                [
                    'folder' => 's9fxnetwork/barcodes',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'limit'
                    ]
                ]
            );
            $wallet->barcode = $uploadResult['secure_url'];
        }

        $wallet->update([
            'wallet_name' => $request->wallet_name,
            'wallet_address' => $request->wallet_address,
        ]);

        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully.');
    }
    // Remove the specified wallet from storage
    public function destroy($id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Wallet Type Deleted Successfully!');
    }
}
