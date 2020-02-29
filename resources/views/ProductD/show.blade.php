@extends('layouts.app')

@section('content')
<div style="text-align: center">
    <!-- Single Service -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12 wow fadeInUp" style="display: inline-block">
            <div class="tm-service text-center">
                <!--<h5>Code: {{$Product->code}}</h5>
                <img src="{{asset("storage/".$Product->image)}}">
                <p>Price: {{$Product->price}}</p>
                <p>Count: {{$Product->count}}</p>
                <p>Description: {{$Product->description}}</p>
                <p>Company: {{$Product->company}}</p>
                <p>Type: {{$Product->type}}</p>-->
                    <table id="products" border='1' style='border-collapse: collapse;'>
                        <tr>
                            <td>Image</td>
                            <td><img src="{{asset("storage/".$Product->image)}}"></td>
                        </tr>
                        <tr>
                            <td>Code</td>
                            <td>{{$Product->code}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{$Product->description}}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>{{$Product->price}}</td>
                        </tr>
                        <tr>
                            <td>Count</td>
                            <td>{{$Product->count}}</td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td>{{$Product->company}}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>{{$Product->type}}</td>
                        </tr>
                    </table>
            </div>
    </div>
    <!--// Single Service -->
</div>


@endsection
