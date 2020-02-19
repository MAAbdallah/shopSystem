<!doctype html>
<html>
<head>
    <title>products</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row pt-5">
    @foreach($Products as $product)
            <div class="col-4 pb-4">
                <div>
                    <img src={{asset('storage/'.$product->image)}}>
                </div>
                <div class="offset-1 mt-3">
                    <p>{{$product->code}}</p>
                    <p>{{$product->description}}</p>
                    <p>{{$product->price}}</p>
                    <p>{{$product->type}}</p>
                    <p>{{$product->company}}</p>
                </div>
            </div>
    @endforeach
    </div>

</div>
</body>
</html>
