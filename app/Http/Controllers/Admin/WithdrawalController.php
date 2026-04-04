<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{


    public function manageWithdrawalsPage()
    {

        $data['withdrawals'] = User::join('withdrawals', 'users.id', '=', 'withdrawals.user_id')
            ->get(['users.email', 'users.name', 'withdrawals.*']);

        return view('admin.manage_withdrawal', $data);
    }

    // Process (approve) a pending Withdrawal
    public function processWithdrawal($id)
    {
        $Withdrawal = Withdrawal::findOrFail($id);
        if ($Withdrawal->status == 0) {
            $Withdrawal->status = 1; // Mark as processed
            $Withdrawal->save();

            // Deduct balance by approving the matching transaction
            Transaction::where('user_id', $Withdrawal->user_id)
                ->where('transaction_id', $Withdrawal->transaction_id)
                ->where('transaction_type', 'Withdrawal')
                ->where('status', 0)
                ->update(['status' => 1]);
        }

        return redirect()->back()->with('success', 'Withdrawal successfully processed.');
    }

    // Delete a Withdrawal
    public function deleteWithdrawal($id)
    {
        $Withdrawal = Withdrawal::findOrFail($id);
        $Withdrawal->delete();

        return redirect()->back()->with('success', 'Withdrawal deleted successfully.');
    }

    public function viewWithdrawal($user_id, $withdrawal_id)
    {

        $data['withdrawal_details']  = Withdrawal::findOrFail($withdrawal_id);
        $data['user_details']  = User::findOrFail($user_id);


        return view('admin.user_withdrawal', $data);
    }

    // Approve or reject from the detail page form
    public function approveWithdrawal(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $status = $request->input('status');

        if ($status == 1 && $withdrawal->status == 0) {
            // Approve: mark withdrawal and transaction as processed
            $withdrawal->status = 1;
            $withdrawal->save();

            Transaction::where('user_id', $withdrawal->user_id)
                ->where('transaction_id', $withdrawal->transaction_id)
                ->where('transaction_type', 'Withdrawal')
                ->where('status', 0)
                ->update(['status' => 1]);

            return redirect()->route('manage.withdrawals.page')->with('success', 'Withdrawal approved and balance deducted.');
        } elseif ($status == 0) {
            // Reject: mark withdrawal as declined, remove the pending transaction
            $withdrawal->status = 2;
            $withdrawal->save();

            Transaction::where('user_id', $withdrawal->user_id)
                ->where('transaction_id', $withdrawal->transaction_id)
                ->where('transaction_type', 'Withdrawal')
                ->where('status', 0)
                ->delete();

            return redirect()->route('manage.withdrawals.page')->with('success', 'Withdrawal rejected.');
        }

        return redirect()->back()->with('error', 'No action taken.');
    }
}
