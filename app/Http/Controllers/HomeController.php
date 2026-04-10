<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Trade;
use App\Models\Profit;
use App\Models\Wallet;
use App\Models\Deposit;
use App\Models\Document;
use App\Models\Earnings;
use App\Models\Referral;
use App\Models\Transfer;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\TradingPlan;
use App\Models\Transaction;
use App\Models\TradeHistory;
use App\Models\WalletDetail;
use Illuminate\Http\Request;
use App\Models\AccountBalance;
use App\Models\AccountDetails;
use App\Models\InvestmentPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendUserEmail;
use Cloudinary\Cloudinary;

class HomeController extends Controller
{
    protected $cloudinary;
    protected $uploadApi;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->cloudinary = new Cloudinary();
        $this->uploadApi = $this->cloudinary->uploadApi();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['credit_withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Withdrawal')->where('transaction', 'credit')->sum('credit');
        $data['debit_withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Withdrawal')->where('transaction', 'debit')->sum('debit');
        $data['withdrawal_balance'] = $data['debit_withdrawal'];

        $data['credit_deposit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Deposit')->where('transaction', 'credit')->sum('credit');
        $data['debit_deposit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Deposit')->where('transaction', 'debit')->sum('debit');
        $data['deposit_balance'] = $data['credit_deposit'] - $data['debit_deposit'];

        $data['credit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Profit')->where('transaction', 'credit')->sum('credit');
        $data['debit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Profit')->where('transaction', 'debit')->sum('debit');
        $data['profit_balance'] = $data['credit_profit'] - $data['debit_profit'];

        $data['credit_earning'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Earning')->where('transaction', 'credit')->sum('credit');
        $data['debit_earning'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Earning')->where('transaction', 'debit')->sum('debit');
        $data['earning_balance'] = $data['credit_earning'] - $data['debit_earning'];





        $data['credit_Investment'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Investment')->where('transaction', 'credit')->sum('credit');
        $data['debit_Investment'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Investment')->where('transaction', 'debit')->sum('debit');
        $data['Investment_balance'] = $data['credit_Investment'] - $data['debit_Investment'];

        $data['credit_referral'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Referral')->where('transaction', 'credit')->sum('credit');
        $data['debit_referral'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Referral')->where('transaction', 'debit')->sum('debit');
        $data['referral_balance'] = $data['credit_referral'] - $data['debit_referral'];


        $data['credit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'credit')->sum('credit');
        $data['debit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'debit')->sum('debit');
        $data['total_balance'] = $data['credit_balance'] - $data['debit_balance'];

        return view('dashboard.home', $data);
    }


    public function referral()
    {
        $referrals = auth()->user()->referrals()->with('parent')->get();

        return view('referrals.index', compact('referrals'));
    }

    public function supportEmail(Request $request)
    {
        $data = "
            <p><strong>Name:</strong> " . e($request->name) . "</p>
            <p><strong>Email:</strong> " . e($request->email) . "</p>
            <p><strong>Message:</strong></p>
            <p>" . e($request->message) . "</p>
        ";

        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($data, 'New Support Message'));

        return back()->with('status', 'Email Successfully sent');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == '0') {


                $data['credit_withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Withdrawal')->where('transaction', 'credit')->sum('credit');
                $data['debit_withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Withdrawal')->where('transaction', 'debit')->sum('debit');
                $data['withdrawal_balance'] = $data['debit_withdrawal'];

                $data['credit_deposit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Deposit')->where('transaction', 'credit')->sum('credit');
                $data['debit_deposit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Deposit')->where('transaction', 'debit')->sum('debit');
                $data['deposit_balance'] = $data['credit_deposit'] - $data['debit_deposit'];

                $data['credit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Profit')->where('transaction', 'credit')->sum('credit');
                $data['debit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Profit')->where('transaction', 'debit')->sum('debit');
                $data['profit_balance'] = $data['credit_profit'] - $data['debit_profit'];

                $data['credit_earning'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Earning')->where('transaction', 'credit')->sum('credit');
                $data['debit_earning'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Earning')->where('transaction', 'debit')->sum('debit');
                $data['earning_balance'] = $data['credit_earning'] - $data['debit_earning'];





                $data['credit_Investment'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Investment')->where('transaction', 'credit')->sum('credit');
                $data['debit_Investment'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Investment')->where('transaction', 'debit')->sum('debit');
                $data['Investment_balance'] = $data['credit_Investment'] - $data['debit_Investment'];

                $data['credit_referral'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Referral')->where('transaction', 'credit')->sum('credit');
                $data['debit_referral'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction_type', 'Referral')->where('transaction', 'debit')->sum('debit');
                $data['referral_balance'] = $data['credit_referral'] - $data['debit_referral'];


                $data['credit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'credit')->sum('credit');
                $data['debit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'debit')->sum('debit');
                $data['total_balance'] = $data['credit_balance'] - $data['debit_balance'];

                return view('dashboard.dashboard', $data);
            } else {
                $users    = User::where('user_type', '0')->get();
                $user_transactions = Transaction::orderBy('id', 'desc')->get();
                return view('manager.home', compact('users', 'user_transactions'));
            }
        } else {
            return redirect()->back();
        }
    }
    public function userDeposit()
    {

        return view('dashboard.deposit');
    }
    public function assetBalance()
    {

        return view('dashboard.asset-balance');
    }
    public function supportTicket()
    {

        return view('dashboard.support');
    }



    public function Earning()
    {
        $data['earning'] =  Earnings::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('dashboard.earnings');
    }

    public function buyPlan()
    {
        // Fetch all investment plans from the database
        $data['plans'] = InvestmentPlan::all();
        return view('dashboard.buy-plan', $data);
    }

    public function  investmentHistory()
    {


        $data['investment'] =  Investment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('dashboard.investment_history', $data);
    }

    public function  makeInvestment()
    {


        $data['investment'] =  Investment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('dashboard.investmentHistory', $data);
    }


    public function referUser()
    {
        // $data['referrals'] =  Referral::where('referrer_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        // return view('dashboard.referuser', $data);
        return view('dashboard.referuser');
    }

    public function Settings()
    {

        return view('dashboard.settings');
    }


    public function accountSettings()
    {

        return view('dashboard.account-settings');
    }

    public function withdrawals()
    {

        return view('dashboard.withdrawals');
    }


    public function getWithdrawal(Request $request)
    {
        $data['credit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'credit')->sum('credit');
        $data['debit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'debit')->sum('debit');
        $data['total_balance'] = $data['credit_balance'] - $data['debit_balance'];

        $method = $request->input('method');
        $data['method'] = $method;

        if ($data['total_balance'] <= 0) {
            return back()->with('error', 'Your Balance Is Insufficient');
        }

        // Go to the correct form page
        if ($method == 'Bank') {
            return view('dashboard.withdraw-bank', $data);
        }

        return view('dashboard.withdraw-funds', $data);
    }


    public function makeWithdrawal(Request $request)
    {
        $transaction_id = rand(76503737, 12344994);

        // mode comes from both forms
        $method = $request->input('mode');

        // Validate based on method
        if ($method === 'Bank') {
            $request->validate([
                'amount' => 'required|numeric|min:1',
                'mode' => 'required|string',
                'bank_name' => 'required|string|max:255',
                'account_name' => 'required|string|max:255',
                'account_number' => 'required|string|max:50',
                'note' => 'nullable|string|max:1000',
            ]);
        } else {
            $request->validate([
                'amount' => 'required|numeric|min:1',
                'mode' => 'required|string',
                'wallet_address' => 'required|string|max:255',
            ]);
        }

        // Balance check
        $credit = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'credit')->sum('credit');
        $debit  = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'debit')->sum('debit');
        $total  = $credit - $debit;

        $amount = (float) $request->input('amount');

        if ($total <= 0 || $total < $amount) {
            return redirect('withdrawals')->with('error', 'Your Balance Is Insufficient');
        }

        // Build "wallet_address" / payout details
        if ($method === 'Bank') {
            $bankDetails = "BANK: " . $request->bank_name
                . " | ACC NAME: " . $request->account_name
                . " | ACC NO: " . $request->account_number;

            if (!empty($request->note)) {
                $bankDetails .= " | NOTE: " . $request->note;
            }

            $payoutDetails = $bankDetails;
        } else {
            $payoutDetails = $request->wallet_address;
        }

        // Save Withdrawal
        $with = new Withdrawal;
        $with->user_id = Auth::user()->id;
        $with->transaction_id = $transaction_id;
        $with->amount = $amount;
        $with->status = 0;
        $with->withdrawal_method = $method;
        $with->wallet_address = $payoutDetails;
        $with->save();

        // Save Transaction (pending)
        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->transaction_id = $transaction_id;
        $transaction->transaction_type = "Withdrawal";
        $transaction->transaction = "debit";
        $transaction->credit = 0;
        $transaction->debit = $amount;
        $transaction->status = 0;
        $transaction->save();

        // Notifications (optional)
        $full_name = Auth::user()->name;
        $email = Auth::user()->email;

        $adminMsg = "<p>" . e($full_name) . " (" . e($email) . ") just made a " . e($method) . " withdrawal of $" . e($amount) . "</p><p>Details: " . e($payoutDetails) . "</p>";
        $userMsg = "<p>Your $" . e($amount) . " " . e($method) . " withdrawal is under review, please wait for approval from the administrator.</p>";

        Mail::to($email)->send(new SendUserEmail($userMsg, 'Withdrawal Request Received'));
        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($adminMsg, 'New Withdrawal Request'));

        return redirect('/user/withdrawals')->with('status', 'Withdrawal Successful, Please wait for approval');
    }





    public function depositHistory()
    {

        $data['deposit'] =  Deposit::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('dashboard.deposit_history', $data);
    }
    public function accountHistory()
    {

        $data['deposit'] =  Deposit::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $data['withdrawal'] =  Withdrawal::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $data['earning'] =  Earnings::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('dashboard.accounthistory', $data);
    }

    public function getDeposit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_selection' => 'required|string',
            'payment_address' => 'required|string',
        ]);

        // Retrieve validated input data
        $amount = $validatedData['amount'];
        $paymentMethod = $validatedData['payment_method_selection'];
        $paymentAddress = $validatedData['payment_address'];

        // Prepare data to pass to the payment view
        $data = [
            'amount' => $amount,
            'address' => $paymentAddress,
            'item' => $paymentMethod,
        ];

        // Retrieve the authenticated user
        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('status', 'User not authenticated.');
        }
        $data['payments'] = WalletDetail::all();

        // Handle different payment methods
        if ($paymentMethod === 'Bank') {
            return back()->with('status', 'Bank Deposit is not available at the moment, please contact live support.');
        } else {
            return view('dashboard.payment', $data);
        }
    }




    public function makeDeposit(Request $request)
    {

        // 1. **Validate Incoming Request Data**
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. **Generate a Unique Transaction ID**
        // It's better to use a unique identifier to prevent collisions
        $transaction_id = strtoupper(uniqid('TXN')); // Example: TXN5F2E5C1B8D3A4

        // 3. **Create a New Deposit Record**
        $deposit = new Deposit();
        $deposit->user_id = Auth::id(); // Shortcut for Auth::user()->id
        $deposit->transaction_id = $transaction_id;
        $deposit->amount = $validatedData['amount'];
        $deposit->payment_method = $validatedData['payment_method'];

        // **Clarify 'wallet_id' Assignment**
        // Assuming 'wallet_id' should correspond to a specific wallet related to the payment method
        // For example, each payment method might have a predefined wallet ID
        // If 'payment_method' is a string, you might need to map it to a wallet ID
        // Here's an example mapping; adjust according to your application's logic
        $paymentMethodToWallet = [
            'Bank' => 'BANK123456',
            'Bitcoin' => 'BTCWALLET78910',
            'Ethereum' => 'ETHWALLET111213',
            'USDT(Trc20)' => 'USDTWALLET141516',
        ];

        $deposit->wallet_id = $paymentMethodToWallet[$validatedData['payment_method']] ?? null;

        // **Handle Image Upload (If Provided) - Upload to Cloudinary**
        if ($request->hasFile('image')) {
            $uploadResult = $this->uploadApi->upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 's9fxnetwork/deposits',
                    'transformation' => [
                        'width' => 800,
                        'height' => 600,
                        'crop' => 'limit'
                    ]
                ]
            );
            $deposit->image = $uploadResult['secure_url'];
        }

        // **Save the Deposit Record**
        $deposit->save();

        // 4. **Create a New Transaction Record**
        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->transaction_id = $transaction_id;
        $transaction->transaction_type = "Deposit";
        $transaction->transaction = "credit";
        $transaction->credit = $validatedData['amount'];
        $transaction->debit = 0;
        $transaction->status = 0; // Assuming '0' means pending or under review
        $transaction->save();

        // 5. **Prepare Data for Email Notifications**
        $user = Auth::user();
        $full_name = $user->name;
        $email = $user->email;
        $payment_method = $validatedData['payment_method'];
        $amount = $validatedData['amount'];

        $adminNotification = "<p>" . e($full_name) . " (" . e($email) . ") has made a " . e($payment_method) . " deposit of $" . e($amount) . ".</p>";
        $userNotification = "<p>Your $" . e($amount) . " " . e($payment_method) . " deposit is under review. Please wait for approval from the administrator.</p>";

        // 6. **Send Email Notifications**
        Mail::to($email)->send(new SendUserEmail($userNotification, 'Deposit Request Received'));
        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($adminNotification, 'New Deposit Request'));

        // 7. **Redirect Back with Success Message**
        return redirect()->route('user.deposit')->with('status', 'Deposit created successfully and is under review.');
    }










    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function buyPlans(Request $request)
    {



        $data['credit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'credit')->sum('credit');
        $data['debit_balance'] = Transaction::where('user_id', Auth::user()->id)->where('status', '1')->where('transaction', 'debit')->sum('debit');
        $data['total_balance'] = $data['credit_balance'] - $data['debit_balance'];

        $plan_amount = $request->input('amount');

        if ($data['total_balance'] <= '0') {
            return back()->with('status', 'Your Balance Is Insufficient');
        }

        if ($data['total_balance'] < $plan_amount) {
            return back()->with('status', 'Your Balance Is Insufficient');
        }



        $transaction_id = rand(76503737, 12344994);

        $buy = new Investment;
        $buy->user_id = Auth::user()->id;
        $buy->email = Auth::user()->email;
        $buy->transaction_id = $transaction_id;
        $buy->amount = $request['amount'];
        $buy->plan_name = $request['plan_name'];
        $buy->plan_percentage = $request['plan_percent'];
        $buy->plan_duration = $request['plan_duration'];
        $plan_amount = $request->input('amount');
        $plan_duration = $request->input('plan_duration');
        $plan_name = $request->input('plan_name');
        $plan_percentage = $request->input('plan_percentage');
        $plan_percent = $request->input('plan_percent');
        $buy->status = '0';
        $startDate = date('Y-m-d');
        $buy->plan_start =  $startDate;


        $endDate = date('Y-m-d H:i:s', strtotime($startDate . '+ 24 hours'));
        $buy->plan_end = $endDate;

        $data = "You have successfully purchased contract " . $plan_name . " $" . $plan_amount . " @ " . $plan_percentage . " interest daily 
        with an estimate daily interest of " . $plan_percentage . " starting from " . $startDate . " to " . $endDate . ".";

        $buy->save();


        $transaction = new Transaction;
        $transaction->user_id = Auth::user()->id;
        $transaction->transaction_id = $transaction_id;
        $transaction->transaction_type = "Investment";
        $transaction->transaction = "debit";
        $transaction->credit = "0";
        $transaction->debit = $request['amount'];
        $transaction->status = 1;
        $transaction->save();

        $email = Auth::user()->email;
        $full_name = Auth::user()->name;

        $userMsg = "<p>You have successfully purchased the <strong>" . e($plan_name) . "</strong> plan for <strong>$" . e($plan_amount) . "</strong> at " . e($plan_percentage) . " interest daily, starting from " . e($startDate) . " to " . e($endDate) . ".</p>";
        $adminMsg = "<p>" . e($full_name) . " (" . e($email) . ") has purchased the <strong>" . e($plan_name) . "</strong> plan for <strong>$" . e($plan_amount) . "</strong>.</p>";

        Mail::to($email)->send(new SendUserEmail($userMsg, 'Investment Plan Purchased'));
        Mail::to('support@s9fxnetwork.com')->send(new SendUserEmail($adminMsg, 'New Investment Purchase'));

        return back()->with('status', 'Plan Has Been Purchased Successfully');
    }












    public function verifyAccount()
    {
        $data['kycStatus'] = User::where('id', Auth::user()->id)->get();
        $data['kyc'] = User::where('id', Auth::user()->id)->get();
        return view('dashboard.verify-account', $data)->with('status', 'Documents updated successfully, please wait for approval');
    }
    public function adminLogin()
    {
        return view('admin.login');
    }

    public function uploadKyc(Request $request)
    {
        $request->validate([
            'card' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'pass' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $kyc =  Auth::user();
        $kyc->kyc_status = 0;

        // Upload ID card to Cloudinary
        $cardResult = $this->uploadApi->upload(
            $request->file('card')->getRealPath(),
            [
                'folder' => 's9fxnetwork/kyc',
                'transformation' => [
                    'width' => 800,
                    'height' => 600,
                    'crop' => 'limit'
                ]
            ]
        );
        $kyc->card = $cardResult['secure_url'];

        // Upload passport/selfie to Cloudinary
        $passResult = $this->uploadApi->upload(
            $request->file('pass')->getRealPath(),
            [
                'folder' => 's9fxnetwork/kyc',
                'transformation' => [
                    'width' => 800,
                    'height' => 600,
                    'crop' => 'limit'
                ]
            ]
        );
        $kyc->pass = $passResult['secure_url'];

        $kyc->save();
        return redirect('user/ver-account')->with('status', 'Document updated successfully, please wait for approval');
    }








    public function perform()
    {
        Session::flush();
        Auth::guard('web')->logout();
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
