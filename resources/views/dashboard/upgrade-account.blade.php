@include('dashboard.header')
<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">
            <div class="mt-2 mb-4 text-center">
                <h2 class="text-light pb-2">Account Upgrade Required</h2>
                <div class="card bg-dark shadow" style="max-width: 600px; margin: 0 auto;">
                    <div class="card-body">
                        <div class="py-4">
                            <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                            <h4 class="text-light">Your account requires an upgrade</h4>
                            <p class="text-muted">Please make a payment to any of our wallet addresses below and contact our administration team with your transaction details.</p>
                            
                            <!-- Wallet Payment Instructions -->
                            @php
                                use App\Models\WalletDetail;
                                $wallets = WalletDetail::all();
                            @endphp
                            
                            @if($wallets->count() > 0)
                                <div class="mt-4">
                                    <h5 class="text-light mb-3">Payment Wallets:</h5>
                                    <div class="wallets-container">
                                        @foreach($wallets as $wallet)
                                            <div class="wallet-detail mb-3 p-3 bg-darker rounded">
                                                @if($wallet->type === 'Bank')
                                                    <h6 class="text-info">BANK TRANSFER</h6>
                                                    <p class="mb-1"><strong>Bank:</strong> {{ $wallet->bank_name }}</p>
                                                    <p class="mb-1"><strong>Account Holder:</strong> {{ $wallet->account_holder }}</p>
                                                    <p class="mb-1"><strong>Account Number:</strong> {{ $wallet->account_number }}</p>
                                                    @if($wallet->account_type)
                                                        <p class="mb-1"><strong>Account Type:</strong> {{ $wallet->account_type }}</p>
                                                    @endif
                                                    @if($wallet->branch_name)
                                                        <p class="mb-1"><strong>Branch:</strong> {{ $wallet->branch_name }}</p>
                                                    @endif
                                                    @if($wallet->branch_code)
                                                        <p class="mb-1"><strong>Branch Code:</strong> {{ $wallet->branch_code }}</p>
                                                    @endif
                                                    <p class="mb-0"><strong>SWIFT Code:</strong> {{ $wallet->swift_code }}</p>
                                                @else
                                                    <h6 class="text-info">{{ strtoupper($wallet->type) }} ({{ $wallet->network }})</h6>
                                                    <p class="mb-1"><strong>Address:</strong> <span class="text-warning">{{ $wallet->address }}</span></p>
                                                    @if($wallet->xrp_tag)
                                                        <p class="mb-0"><strong>Destination Tag:</strong> {{ $wallet->xrp_tag }}</p>
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning mt-3">
                                    No payment wallets available. Please contact support.
                                </div>
                            @endif
                            <!-- End Wallet Instructions -->
                            
                            <div class="mt-4">
                                <a href="mailto:support@s9fxnetwork.com" class="btn btn-primary mr-3">
                                    <i class="fas fa-envelope"></i> Contact Support
                                </a>
                                
                                <a href="{{ route('user.logout') }}" class="btn btn-danger" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                
                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.footer')