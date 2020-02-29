<!doctype html>
<html>
<head>
    <title>products</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<br>

<form method="get" action="product/search">
    <input id="Code" name="Code" type="text" value="" placeholder="enter code">
    <button id="search" type = "submit" class="btn btn-warning" >Search</button><br>
</form>

<form method="get" action="filter">
    <div class="form-group row">
        <label for="company" class="col-md-4 col-form-label">Company</label>
        <select id="company" name="company">
            <option id="-1" value="-1">--select--</option>
            @foreach($companies as $company)
                <option id="{{$company->id}}" name="{{$company->name}}" value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label">Type</label>

        <select id="type" name="type">
            <option id="-1" value="-1">--select--</option>

        </select>
    </div>

    <button id="filter" type = "submit" class="btn btn-warning" >Filter</button><br>

</form>

<div id= "clear">
    <div class="container">
        <div   class="row pt-5">
            @foreach($Products as $product)
                <div class="col-4 pb-4">
                <!--<div id="img">
                    <a href="{{url('/product/'.$product->id)}}"><img src={{asset('storage/'.$product->image)}}></a>
                    </div>
                    <div id="content" class="offset-1 mt-3">
                    <p>Code: {{$product->code}}</p>
                    <p>Description: {{$product->description}}</p>
                    <p>Price: {{$product->price}}</p>
                    <p>Count: {{$product->count}}</p>
                    </div>
                     -->
                    <table id="products" border='1' style='border-collapse: collapse;'>
                        <tr>
                            <td>Image</td>
                            <td id="value"><a href="{{url('/product/'.$product->id)}}"><img src={{asset('storage/'.$product->image)}}></a></td>
                        </tr>
                        <tr>
                            <td>Code</td>
                            <td id="value">{{$product->code}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td id="value">{{$product->description}}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td id="value">{{$product->price}}</td>
                        </tr>
                        <tr>
                            <td>Count</td>
                            <td id="value">{{$product->count}}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>
<script type='text/javascript'>
    $(document).ready(function(){

        // Search by typeid
        $('#company').change(function(){
            var companyid = Number($('#company').val().trim());

            if(companyid > 0){
                fetchRecords(companyid);
            }
            else{
                $('#type').empty(); // Empty <tbody>
                var str =
                    "<option align='center' id='-1' value='-1'>" +
                    "--select--"
                    + "</option>";

                $("#type").append(str);
            }

        });

    });

    function fetchRecords(id){
        $.ajax({
            url: '/company/getTypes/'+id,
            type: 'get',
            dataType: 'json',

            success: function(response){

                var len = 0;
                $('#type').empty(); // Empty <tbody>

                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    for(var i=0; i<len; i++){
                        var id = response['data'][i].id;
                        var typename = response['data'][i].name;

                        var str =
                            "<option align='center' id="+ id+" value="+id+">" +
                            typename
                            + "</option>";

                        $("#type").append(str);
                    }
                }else if(response['data'] != null){
                    var id = response['data'][i].id;
                    var typename = response['data'][i].name;
                    var str =
                        "<option align='center' id="+ id+" value="+id+">" +
                        typename
                        + "</option>";

                    $("#type").append(str);
                }else{
                    var str = "<option align='center' id='' value='' >" + "No types ."
                        + "</option>";

                    $("#type").append(str);
                }

            }
        });
    }
</script>
<!--
<script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>

<script type='text/javascript'>

    $(document).ready(function(){
        // Search by name

        $("#search").click(function(){
            $("div").empty();
            var code = toString($('#Code').val().trim());
            fetchRecords(code);
        });

    });

    function fetchRecords(code){
        $.ajax({
            url: '/product/search/'+code,
            type: 'get',
            dataType: 'json',
            success: function(response){

                if(response['data'] != null){
                        var id = response['data'][0].id;
                        var productCode = code;
                        var productDescription = response['data'][0].description;

                        var tr_str = "<tr>" +
                            "<td align='center'>" + (1) + "</td>" +
                            "<td align='center'>" + productCode + "</td>" +
                            "<td align='center'>" + productDescription + "</td>" +
                            "</tr>";

                        $("#products tbody").append(tr_str);
                }
                else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4'>No record found.</td>" +
                        "</tr>";

                    $("#products tbody").append(tr_str);
                }

            }
        });
    }
</script>
-->

</body>
</html>
