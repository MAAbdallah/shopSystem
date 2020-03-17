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
    <h2 align="center">Advance Ajax Product Filters in PHP</h2>
    <br />
        <input id="Code" name="Code" type="text" value="" placeholder="enter code">
        <button id="search" type = "submit" class="btn btn-warning" >Search</button><br>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <h3>Brand</h3>
                <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    @foreach($companies as $row)
                        <div class="list-group-item checkbox">
                            <label><input type="checkbox" class="common_selector brand" value="{{$row->name}}">{{$row->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row filter_data">
                @foreach($Products as $product)
                    <div class="col-sm-5 col-lg-4 col-md-4">
                        <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:550px;">
                            <a href="{{url('/product/'.$product->id)}}"><img src="{{asset('storage/'.$product->image)}}" alt="" class="img-responsive" ></a>
                            <p align="center"><strong><a href="{{url('/product/'.$product->id)}}"> {{$product->code}} </a></strong></p>
                            <h4 style="text-align:center;" class="text-danger" >{{$product->price}}</h4>
                            <p>Brand : {{$product->company}}  <br />
                            category : {{$product->type}}  <br />
                            count : {{$product->count}}  <br />
                            description :  {{$product->description}}  </p>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>

<script>
    $(document).ready(function(){

        //filter_data();

        function filter_data()
        {
            //$('.filter_data').empty();
            var action = 'fetch_data';
            var brand = get_filter('brand');
            $.ajax({
                url:"/filter",
                method:"get",
                data:{action:action, brand:brand},
                success:function(data){
                    $('.filter_data').html(data);
                }
            });
        }

        function search_data()
        {
            //$('.filter_data').empty();
            var action = 'search_data';
            var code = $('#Code').val();
            $.ajax({
                url:"/product/search",
                method:"get",
                data:{action:action,code:code},
                success:function(data){
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name)
        {
            var filter = [];
            /*if($('.'+class_name).prop("checked") === true) {
                filter.push($(this).val());
            }*/
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });
        $('#search').click(function(){
            search_data();
        });
    });
</script>

</body>
</html>
