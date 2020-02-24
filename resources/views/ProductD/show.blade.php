@extends('layouts.app')

@section('content')
<div style="text-align: center">
    <!-- Single Service -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" style="display: inline-block">
            <div class="tm-service text-center">
                <h5>{{$Product->code}}</h5>
                <img src="{{asset("storage/".$Product->image)}}">
                <p>{{$Product->price}}</p>
                <p>{{$Product->count}}</p>
                <p>{{$Product->description}}</p>
                <p>{{$Product->company}}</p>
                <p>{{$Product->type}}</p>
            </div>
    </div>
    <!--// Single Service -->
</div>


@endsection
