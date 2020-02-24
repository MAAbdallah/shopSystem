@extends('layouts.app')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">
        <form action="/product/store" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Create Product</h1>
                    </div>
                    <div class="form-group row">
                        <label for="code" class="col-md-4 col-form-label">Code</label>

                        <input id="code"
                               type="text"
                               class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                               name="code"
                               value="{{ old('code') }}"
                               autocomplete="code" autofocus>

                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
                        <input id="description"
                               type="text"
                               class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                               name="description"
                               value="{{ old('description') }}"
                               autocomplete="description" autofocus>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label">Price</label>
                        <input id="price"
                               type="text"
                               class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                               name="price"
                               value="{{ old('price') }}"
                               autocomplete="price" autofocus>

                        @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="count" class="col-md-4 col-form-label">Count</label>
                        <input id="count"
                               type="text"
                               class="form-control{{ $errors->has('count') ? ' is-invalid' : '' }}"
                               name="count"
                               value="{{ old('count') }}"
                               autocomplete="count" autofocus>

                        @if ($errors->has('count'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('count') }}</strong>
                        </span>
                        @endif
                    </div>

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

                        </select>
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">Product Image</label>

                        <input type="file" class="form-control-file" id="image" name="image">

                        @if ($errors->has('image'))
                            <strong>{{ $errors->first('image') }}</strong>
                        @endif
                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Create Product</button>
                    </div>

                </div>
            </div>
        </form>
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
@endsection

