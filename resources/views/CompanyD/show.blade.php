@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group row">
                <label for="company" class="col-md-4 col-form-label">Company</label>
                <select id="company" name="company">
                    @foreach($companies as $company)
                        <option id="{{$company->id}}" name="{{$company->name}}" value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <table border='1' id='typeTable' style='border-collapse: collapse;'>
                <thead>
                <tr>
                    <th>S.no</th>
                    <th>type name</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
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

            });

        });

        function fetchRecords(id){
            $.ajax({
                url: '/company/getTypes/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    $('#typeTable tbody').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var typename = response['data'][i].name;

                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i+1) + "</td>" +
                                "<td align='center'>" + typename + "</td>" +
                                "</tr>";

                            $("#typeTable tbody").append(tr_str);
                        }
                    }else if(response['data'] != null){
                        var tr_str = "<tr>" +
                            "<td align='center'>1</td>" +
                            "<td align='center'>" + response['data'].name + "</td>" +
                            "</tr>";

                        $("#typeTable tbody").append(tr_str);
                    }else{
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                        $("#typeTable tbody").append(tr_str);
                    }

                }
            });
        }
    </script>

@endsection
