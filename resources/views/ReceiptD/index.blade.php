<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>products</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>

<!-- Page Content -->
<div class="container">
    <br />
    <h2 align="center">All Receipts </h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="row filter_data">
                @foreach($receipts as $receipt)
                    <div class="col-sm-5 col-lg-4 col-md-4">
                        <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:170px;">
                            <p align="center"><strong> <a href="{{url('/receipt/'.$receipt->id)}}">{{$receipt->Number}}</a></strong></p>
                            <p>Total count : {{$receipt->Total_count_R}} <br />
                            Total price : {{$receipt->Total_price_R}}  <br />
                            Recipient : {{$receipt->Recipient}}  <br />
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</body>
</html>
