@extends('layouts.app')

@section('content')

    <div class="container" xmlns="http://www.w3.org/1999/html">
        <form action="/company/store" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="row">
                        <h1>Create Company</h1>
                    </div>
                    <div class="form-group row">
                        <label for="company_name" class="col-md-4 col-form-label">company name</label>

                        <input id="company_name"
                               type="text"
                               class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}"
                               name="company_name"
                               value="{{ old('company_name') }}"
                               autocomplete="company_name" autofocus>

                        @if ($errors->has('company_name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label">Type</label>

                        <select id="type" name="type">
                            @foreach($types as $type)
                                <option id="{{$type->id}}" name="{{$type->name}}" value="{{$type->id}}">{{$type->name}}</option>
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

