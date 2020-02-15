@extends('layouts.app')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">
        <form action="/type/store" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Create Company</h1>
                    </div>
                    <div class="form-group row">
                        <label for="type_name" class="col-md-4 col-form-label">type name</label>

                        <input id="type_name"
                               type="text"
                               class="form-control{{ $errors->has('type_name') ? ' is-invalid' : '' }}"
                               name="type_name"
                               value="{{ old('type_name') }}"
                               autocomplete="type_name" autofocus>

                        @if ($errors->has('type_name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('type_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-md-4 col-form-label">Company</label>
                        <select id="company" name="company">
                            <option value="">--select--</option>
                        @foreach($companies as $company)
                                <option id="{{$company->id}}" name="{{$company->name}}" value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Create Company</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

