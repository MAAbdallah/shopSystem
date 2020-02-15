@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-8 offset-2">
            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label">Type</label>
                <select id="type" name="type">
                    <option id="-1" value="-1">--select--</option>
                @foreach($types as $type)
                        <option id="{{$type->id}}" name="{{$type->name}}" value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <table border='1' id='companyTable' style='border-collapse: collapse;'>
                <thead>
                <tr>
                    <th>S.no</th>
                    <th>Company name</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script src="{{asset('JS/jquery-3.4.1.min.js')}}"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            // Search by companyid
            $('#type').change(function(){
                var type_id = Number($('#type').val().trim());
                if(type_id > 0){
                    fetchRecords(type_id);
                }
                else{
                    $('#companyTable tbody').empty(); // Empty <tbody>
                }
            });
        });

        function fetchRecords(id){
            $.ajax({
                url: '/type/getCompanies/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    $('#companyTable tbody').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var companyname = response['data'][i].name;

                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i+1) + "</td>" +
                                "<td align='center'>" + companyname + "</td>" +
                                "</tr>";

                            $("#companyTable tbody").append(tr_str);
                        }
                    }else if(response['data'] != null){
                        var tr_str = "<tr>" +
                            "<td align='center'>1</td>" +
                            "<td align='center'>" + response['data'].name + "</td>" +
                            "</tr>";

                        $("#companyTable tbody").append(tr_str);
                    }else{
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                        $("#companyTable tbody").append(tr_str);
                    }

                }
            });
        }
    </script>
@endsection
