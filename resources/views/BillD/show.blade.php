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

    <div class="container-fluid">
        <!-- Your main wrapper -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Bill</h3></div>
                    <div class="panel-body">
                        <form name="add_item" id="add_item" class="form-inline" >

                        <div class="form-group mb-3 m-lg-2">
                                <label for="pr_form_number">PR Form Number </label>
                                <input type="text" class="form-control ml-3" name="pr_number" value="{{$bill->Number}}" readonly>
                            </div>
                            <div class="form-group mb-3 m-lg-2">
                                <label for="pr_form_number">customer: </label>
                                <input type="text" class="form-control ml-3" name="customer" value="{{$bill->customer}}" readonly>
                            </div>
                            <div class="table-responsive">
                                <table class='table table-bordered table-hover' id="tab_logic">
                                    <thead>
                                    <tr class='info'>
                                        <th style='width:10%;'>ITEM NO.</th>
                                        <th style='width:10%;'>Code</th>
                                        <th style='width:30%;'>DESCRIPTION</th>
                                        <th style='width:10%;'>Price PER ITEM</th>
                                        <th style='width:10%;'>Count</th>
                                        <th style='width:10%;'>Total price</th>
                                    </tr>
                                    </thead>

                                    <tbody id="dynamic_field">
                                    @php
                                    $i=1;
                                    @endphp
                                        @foreach($merged as $product)
                                            <tr id="addr0">
                                                <td class="custom-tbl">
                                                    <input class='form-control input-sm'style='width:100%;' type="text" value="{{$i++}}" id="pr_item0" name="pr_item[]" readonly >
                                                </td>
                                                <td class="custom-tbl">
                                                    <input value="{{$product->code}}" class='form-control input-sm' style='width:100%;' id="pr_code0" name="pr_code[]" readonly>
                                                </td>
                                                <td class="custom-tbl">
                                                    <input value="{{$product->description}} {{$product->company}} {{$product->type}}" class='form-control input-sm' style='width:100%;' type="text" id="pr_desc0" name="pr_desc[]" readonly >
                                                </td>
                                                <td>
                                                    <input value="{{$product->price_PB}}" class='form-control input-sm' style='width:100%;' type="text" id="pr_cpi0"  name="pr_cpi[]" readonly>
                                                </td>
                                                <td class="custom-tbl">
                                                    <input value="{{$product->count_PB}}" class='estimated_cost form-control input-sm' id="pr_count0" style='width:100%;' type="text" name="pr_count[]" readonly>
                                                </td>
                                                <td class="custom-tbl">
                                                    <input value="{{$product->Total_price_PB}}" class='estimated_cost form-control input-sm' id="pr_AllP0"  style='width:100%;' type="text" name="pr_AllP[]" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <tbody>
                                    <tfoot>
                                    <tr class='info'>
                                        <td style='width:65%;text-align:right;padding:4px;' colspan='5'>TOTAL Price :</td>
                                        <td style='padding:0px;'>
                                            <input style='width:100%;' type='text' class='form-control input-sm' id='total_price' name='total_price' value='{{$bill->Total_price_B}}' readonly >
                                        </td>
                                    </tr>
                                    <tr class='info'>
                                        <td style='width:65%;text-align:right;padding:4px;' colspan='5'>TOTAL Count :</td>
                                        <td style='padding:0px;'>
                                            <input style='width:100%;' type='text' class='form-control input-sm' id='total_count' name='total_count' value='{{$bill->Total_count_B}}' readonly >
                                        </td>
                                    </tr>
                                    <tr class='info'>
                                        <td style='width:65%;text-align:right;padding:4px;' colspan='5'>salesman :</td>
                                        <td style='padding:0px;'>
                                            <input style='width:100%;' type='text' class='form-control input-sm' id='salesman' name='salesman' value='{{$bill->salesman}}' readonly>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
