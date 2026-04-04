@include('dashboard.header')
<div class="main-panel bg-dark">
    <div class="content bg-dark">
        <div class="page-inner">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <div class="mt-2 mb-4">
                <h1 class="title1 d-inline text-light">Bank Withdrawal</h1>
            </div>

            <div class="mb-5 row">
                <div class="col-lg-8 offset-md-2">
                    <div class="p-md-4 p-2 rounded card bg-dark">
                        <div class="card-body">
                            <div class="mb-3 alert alert-success">
                                <h4 class="text-light">Your Payment Method is <strong>{{$method}}</strong></h4>
                            </div>

                            <form action="{{route('user.make.withdrawal')}}" method="post">
                                @csrf

                                <input value="Bank" type="hidden" name="mode">

                                <div class="form-group">
                                    <h5 class="text-light">Enter Amount to withdraw</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter Amount"
                                           type="number" name="amount" required>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-light">Bank Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="e.g. Access Bank"
                                           type="text" name="bank_name" required>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-light">Account Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Account Name"
                                           type="text" name="account_name" required>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-light">Account Number</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Account Number"
                                           type="text" name="account_number" required>
                                </div>

                                <div class="form-group">
                                    <h5 class="text-light">Optional Note</h5>
                                    <textarea class="form-control text-light bg-dark" rows="3"
                                              name="note" placeholder="Optional note..."></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type='submit'>Complete Request</button>
                                </div>

                                <small class="text-light">
                                    Make sure your bank details are correct. Wrong details may delay processing.
                                </small>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('dashboard.footer')
