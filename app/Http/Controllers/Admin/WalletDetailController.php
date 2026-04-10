<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletDetail;
use App\Mail\SendUserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WalletDetailController extends Controller
{
    public function index()
    {
        $data['wallets'] = WalletDetail::paginate(10);
        return view('admin.wallets.index', $data);
    }

    public function create()
    {
        return view('admin.wallets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'network' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'xrp_tag' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_holder' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:255',
        ]);

        $wallet = WalletDetail::create($validated);

        // Notify support about new payment detail
        $adminName = Auth::guard('admin')->user()->name ?? 'Admin';
        $emailBody = "<p><strong>" . e($adminName) . "</strong> has added a new payment detail:</p>
            <p><strong>Type:</strong> " . e($wallet->type) . "</p>"
            . ($wallet->network ? "<p><strong>Network:</strong> " . e($wallet->network) . "</p>" : "")
            . ($wallet->address ? "<p><strong>Address:</strong> " . e($wallet->address) . "</p>" : "")
            . ($wallet->bank_name ? "<p><strong>Bank:</strong> " . e($wallet->bank_name) . "</p>" : "")
            . ($wallet->account_number ? "<p><strong>Account:</strong> " . e($wallet->account_number) . "</p>" : "");

        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($emailBody, 'New Payment Detail Added'));

        return redirect()->route('wallets.index')->with('message', 'Wallet detail created successfully.');
    }

    public function edit(WalletDetail $wallet)
    {
        return view('admin.wallets.edit', compact('wallet'));
    }

    public function update(Request $request, WalletDetail $wallet)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'network' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'xrp_tag' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_holder' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:255',
        ]);

        $wallet->update($validated);

        // Notify support about updated payment detail
        $adminName = Auth::guard('admin')->user()->name ?? 'Admin';
        $emailBody = "<p><strong>" . e($adminName) . "</strong> has updated a payment detail:</p>
            <p><strong>Type:</strong> " . e($wallet->type) . "</p>"
            . ($wallet->network ? "<p><strong>Network:</strong> " . e($wallet->network) . "</p>" : "")
            . ($wallet->address ? "<p><strong>Address:</strong> " . e($wallet->address) . "</p>" : "")
            . ($wallet->bank_name ? "<p><strong>Bank:</strong> " . e($wallet->bank_name) . "</p>" : "")
            . ($wallet->account_number ? "<p><strong>Account:</strong> " . e($wallet->account_number) . "</p>" : "");

        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($emailBody, 'Payment Detail Updated'));

        return redirect()->route('wallets.index')->with('message', 'Wallet detail updated successfully.');
    }

    public function destroy(WalletDetail $wallet)
    {
        $type = $wallet->type;
        $wallet->delete();

        // Notify support about deleted payment detail
        $adminName = Auth::guard('admin')->user()->name ?? 'Admin';
        $emailBody = "<p><strong>" . e($adminName) . "</strong> has deleted a payment detail:</p>
            <p><strong>Type:</strong> " . e($type) . "</p>";

        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($emailBody, 'Payment Detail Deleted'));

        return redirect()->route('wallets.index')->with('message', 'Wallet detail deleted successfully.');
    }
}
