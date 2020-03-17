<!doctype html>
<html>
<head>
    <title>products</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>
<body>

<div class="container-fluid">
    <!-- Your main wrapper -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add Items</h3></div>
                <div class="panel-body">

                    <form name="add_item" id="add_item" method="post" action="/receipt/store/" enctype="multipart/form-data" class="form-inline" >
                        @csrf
                        <div class="form-group mb-3">
                            <label for="pr_form_number">PR Form Number </label>
                            <input type="text" class="form-control ml-3" name="pr_number" value=""  required>

                        </div>
                        <div class="table-responsive">
                            <table class='table table-bordered table-hover' id="tab_logic">
                                <thead>
                                <tr class='info'>
                                    <th style='width:10%;'>ITEM NO.</th>
                                    <th style='width:10%;'>Code</th>
                                    <th style='width:10%;'>Company</th>
                                    <th style='width:30%;'>DESCRIPTION</th>
                                    <th style='width:10%;'>Price PER ITEM</th>
                                    <th style='width:10%;'>Count</th>
                                    <th style='width:10%;'>Total price</th>
                                    <th style='width:10%;'>ACTION</th>
                                </tr>
                                </thead>
                                <thead>
                                <tr id="addr0">
                                    <td class="custom-tbl"><input class='form-control input-sm'style='width:100%;' type="text" value="1" id="pr_item0" name="pr_item[]" readonly required></td>
                                    <td class="custom-tbl">
                                        <select oninput="changeCode(0)" class='form-control input-sm' style='width:100%;' id="pr_code0" name="pr_code[]">
                                                <option id="-1" value="-1">--select--</option>
                                            @foreach($products as $product)
                                                <option id="{{$product->id}}" name="{{$product->id}}" value="{{$product->id}}">{{$product->code}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_comp0" name="pr_comp[]" readonly required></td>
                                    <td class="custom-tbl"><input class='form-control input-sm' style='width:100%;' type="text" id="pr_desc0" name="pr_desc[]" readonly required></td>
                                    <td><input oninput="changeCountORCost(0)" class='form-control input-sm' style='width:100%;' type="text" id="pr_cpi0"  name="pr_cpi[]"></td>
                                    <td class="custom-tbl"><input oninput="changeCountORCost(0)" class='estimated_cost form-control input-sm' id="pr_count0" style='width:100%;' type="text" name="pr_count[]"></td>
                                    <td class="custom-tbl"><input class='estimated_cost form-control input-sm' id="pr_AllP0" value="0" style='width:100%;' type="text" name="pr_AllP[]" readonly></td>
                                    <td class="custom-tbl"><button type="button" id="add" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-plus">Add</span></button></td>
                                </tr>
                                </thead>
                                <tbody id="dynamic_field">

                                <tbody>
                                <tfoot>
                                <tr class='info'>
                                    <td style='width:65%;text-align:right;padding:4px;' colspan='5'>TOTAL Price :</td>
                                    <td style='padding:0px;'>
                                        <input style='width:100%;' type='text' class='form-control input-sm' id='total_price' name='total_price' value='0' readonly required>
                                    </td>
                                </tr>
                                <tr class='info'>
                                    <td style='width:65%;text-align:right;padding:4px;' colspan='5'>TOTAL Count :</td>
                                    <td style='padding:0px;'>
                                        <input style='width:100%;' type='text' class='form-control input-sm' id='total_count' name='total_count' value='0' readonly required>
                                    </td>
                                </tr>
                                <tr class='info'>
                                    <td style='width:65%;text-align:right;padding:4px;' colspan='5'>Recipient :</td>
                                    <td style='padding:0px;'>
                                        <input style='width:100%;' type='text' class='form-control input-sm' id='Recipient' name='Recipient' value='' required>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>

<script type="text/javascript">
    function changeCode(index)
    {
        var productid = Number($("#pr_code"+index).val());

        if(productid > 0){
            fetch(productid, index);
        }
        else
        {
            document.getElementById("pr_comp"+index).value  = "";
            document.getElementById("pr_desc"+index).value  = "";
        }
    }
    function fetch(id,index){
        $.ajax({
            url: '/receipt/fetch/'+id,
            type: 'get',
            dataType: 'json',

            success: function(response){

                if(response['data'] != null){
                    var id = response['data'].id;
                    var comp = response['data'].company;
                    var desc = response['data'].description;
                    document.getElementById("pr_comp"+index).value  = comp;
                    document.getElementById("pr_desc"+index).value  = desc;
                }else{
                    document.getElementById("pr_comp"+index).value  = "";
                    document.getElementById("pr_desc"+index).value  = "";
                }
            }
        });
    }
    function changeCountORCost(index)
    {
        var count = Number($('#pr_count'+index).val());
        var price = Number($('#pr_cpi'+index).val());
        var TotalCost = calcPrice(count,price);
        document.getElementById("pr_AllP"+index).value  = TotalCost ;
        //calcAllPrice(TotalCost,"add");
        sumTheCount();
        sumTheprice();

    }
    function calcPrice(count,price) {
        return count * price ;
    }

    /*function calcAllPrice(cost,flag)
    {
        var TotalCost ;
        if(flag=="add")
        {
             TotalCost = Number(document.getElementById("total_price").value)+Number(cost);
        }
        else{
             TotalCost = Number(document.getElementById("total_price").value)-Number(cost);
        }
        document.getElementById("total_price").value = TotalCost ;
    }*/
    function sumTheprice() {
        var runningTotal = 0;
        var ourlist = document.getElementsByName("pr_AllP[]");
        for (var i = 0; i <ourlist.length; i++) {

            if (ourlist[i].value != '') {
                try {
                    runningTotal = runningTotal + parseFloat(ourlist[i].value);
                } catch (err) {
                    alert ("Value was not a float!");
                }
            }

        }
        document.getElementById('total_price').value = runningTotal;
    };
    function sumTheCount() {
        var runningTotal = 0;
        var ourlist = document.getElementsByName("pr_count[]");
        for (var i = 0; i <ourlist.length; i++) {

            if (ourlist[i].value != '') {
                try {
                    runningTotal = runningTotal + parseFloat(ourlist[i].value);
                } catch (err) {
                    alert ("Value was not a float!");
                }
            }

        }
        document.getElementById('total_count').value = runningTotal;
    };

    $(document).ready(function() {

        /*$('#pr_code0').change(function(){
            var productid = Number($('#pr_code0').val());

            if(productid > 0){
                fetch(productid);
            }
            else
            {
                document.getElementById("pr_comp0").value  = "";
                document.getElementById("pr_desc0").value  = "";
            }
        });
        $('#pr_count0').on("input",function () {
           var count = Number($('#pr_count0').val());
           var price = Number($('#pr_cpi0').val());
           document.getElementById("pr_AllP0").value  = calcPrice(count,price);
        });
        $('#pr_cpi0').on("input",function () {
           var count = Number($('#pr_count0').val());
           var price = Number($('#pr_cpi0').val());
           document.getElementById("pr_AllP0").value  = calcPrice(count,price);
        });
        function calcPrice(count,price) {
            return count * price ;
        }
        function fetch(id){
            $.ajax({
                url: '/receipt/fetch/'+id,
                type: 'get',
                dataType: 'json',

                success: function(response){

                    if(response['data'] != null){
                        var id = response['data'].id;
                        var comp = response['data'].company;
                        var desc = response['data'].description;
                        document.getElementById("pr_comp0").value  = comp;
                        document.getElementById("pr_desc0").value  = desc;
                    }else{
                        document.getElementById("pr_comp0").value  = "";
                        document.getElementById("pr_desc0").value  = "";

                    }

                }
            });
        }*/

        var i = 1;

        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td class="custom-tbl"><input class="form-control input-sm"style="width:100%;" type="text" value="'+ i +'" id="pr_item'+ i +'" name="pr_item[]" readonly required></td> <td class="custom-tbl"> '+
                '<select oninput="changeCode('+i+')" class="form-control input-sm" style="width:100%;" id="pr_code' + i + '" name="pr_code[]"> <option id="-1" value="-1">--select--</option>'+
                @foreach($products as $product)
                ' <option id="{{$product->id}}" name="{{$product->id}}" value="{{$product->id}}">{{$product->code}}</option> '+
                @endforeach
                '</select>'+
            ' </td> <td class="custom-tbl"><input class="form-control input-sm" style="width:100%;" type="text" id="pr_comp'+ i +'" name="pr_comp[]" readonly required></td> <td class="custom-tbl"><input class="form-control input-sm" style="width:100%;" type="text" id="pr_desc'+ i +'" name="pr_desc[]" readonly required></td> <td><input oninput="changeCountORCost('+i+')" class="form-control input-sm" style="width:100%;" type="text" id="pr_cpi'+ i +'"  name="pr_cpi[]"></td> <td class="custom-tbl"><input oninput="changeCountORCost('+i+')" class="estimated_cost form-control input-sm" id="pr_count'+ i +'" style="width:100%;" type="text" name="pr_count[]"></td> <td class="custom-tbl"><input class="estimated_cost form-control input-sm" value="0" id="pr_AllP'+ i +'" style="width:100%;" type="text" name="pr_AllP[]" readonly></td> <td class="custom-tbl"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm btn_remove"><span class="glyphicon glyphicon-remove">remove</span></button></td></tr>');
        });


        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");

            var cost = document.getElementById("pr_AllP"+button_id).value
            TotalCost = Number(document.getElementById("total_price").value)-Number(cost);
            document.getElementById("total_price").value = TotalCost ;

            var count = document.getElementById("pr_count"+button_id).value
            TotalCount = Number(document.getElementById("total_count").value)-Number(count);
            document.getElementById("total_count").value = TotalCount ;
            $('#row' + button_id + '').remove();
        });

        /*$('#submit').click(function(){
            $.ajax({
                url:"/receipt/store",
                method:"POST",
                data:$('#add_item').serialize(),
                type:'json',
                success:function() {
                }
            });
        });*/

    });

</script>
</body>
</html>
