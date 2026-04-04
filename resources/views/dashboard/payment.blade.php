@include('dashboard.header')
<!-- End Sidebar -->
<div class="main-panel   bg-dark  ">
  <div class="content   bg-dark  ">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
    @if($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{$message}}</p>
    </div>
    @endif
    <div class="card text-center   bg-dark  ">
      <div class="card-header">
        <h2>.......</h2>
      </div>
      <div class="mt-2 mb-4">
        <h1 class="title1 text-light">{{$item}} Payment</h1>
      </div>
      <div class="mt-2 mb-4">
        <p class="title1 text-primary">Send <strong>${{$amount}}</strong> {{$item}} to the address below</p>
      </div>

      <div class="card-body bg-dark">
        @php
        $wallet = \App\Models\WalletDetail::where('type', $item)->first();
        @endphp

        @if($wallet)
        <input type="text" id="myInput1" class="form-control bg-dark text-dark" value="{{ $wallet->address }}" readonly>
        @else
        <p class="text-light">Wallet address not found</p>
        @endif

        <button class="btn btn-primary" type="button" id="button-addon2" onclick="copyAdr1()">Copy Address</button>
      </div>



      <!--<div class="card-body   bg-dark  ">-->
      <!--  @if($item=='Bitcoin')-->
      <!--  <input type="text" id="myInput1" class="form-control" style="color: black;" class="  bg-dark   text-light"-->
      <!--    value="bc1qj8fn3mldhnhuvxlfucteq2kgypa94jmj8800y4" readonly>-->
      <!--  @elseif($item=='USDT(Trc20)')-->

      <!--  <input type="text" id="myInput1" class="form-control" style="color: black;" class="  bg-dark   text-light"-->
      <!--    value="0xf2f3fAB8D5824BF61884D09aD0Af05AF13F3ACe2" readonly>-->
      <!--  @elseif($item=='Ethereum')-->


      <!--  <input type="text" id="myInput1" class="form-control" style="color: black;" class="  bg-dark   text-light"-->
      <!--    value="0xf2f3fAB8D5824BF61884D09aD0Af05AF13F3ACe2" readonly>-->

      <!--  @endif-->

      <!--  <button class="btn btn-primary" type="button" id="button-addon2" onclick="copyAdr1()">copy address</button>-->
      <!--</div>-->
    </div>
    <div class="card-footer text-muted">
      <h2 style="color:skyblue;">Ensure to copy the address properly to avoid payment error</h2>
    </div>

    <div class="col card   bg-dark   shadow-lg">
      <div>
        <center>

          <form action="{{ route('make.deposit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <h5 class="text-light">Upload Payment proof after payment.</h5>
              <input type="file" name="image" class="form-control col-lg-4   bg-dark   text-light" required>
            </div>
            <input type="hidden" name="amount" value="{{$amount}}">
            <input type="hidden" name="payment_method" value="{{$item}}">

            <div class="form-group">
              <input type="submit" class="btn btn-dark" value="Submit Payment">
            </div>
          </form>
        </center>

      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function copyAdr(){
        var copyText = document.getElementById("myInput");
         copyText.select();


        /* Copy the text inside the text field */
        document.execCommand("copy");
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);

        }

          function copyAdr1(){
        var copyText = document.getElementById("myInput1");
         copyText.select();


        /* Copy the text inside the text field */
        document.execCommand("copy");
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);

        }


  function copyAdr2(){
        var copyText = document.getElementById("myInput2");
         copyText.select();


        /* Copy the text inside the text field */
        document.execCommand("copy");
         copyText.setSelectionRange(0, 99999);
         navigator.clipboard.writeText(copyText.value);

        }

</script>
@include('dashboard.footer')