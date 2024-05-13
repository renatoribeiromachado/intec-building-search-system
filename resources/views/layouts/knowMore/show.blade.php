@extends('layouts.app_customer')

@section('content')

<div class="container bg-light p-5 rounded">
    <div class='container'>
       
        <div class='row'>
            <div class='col-md-12'>

                <h3> <i class='fa fa-exclamation'></i> Saiba mais</h3>
            
                <div class="row pt-3 pb-3">

                    <div class="col-4 col-md-5">
                        <img src="{{ url("storage/{$know->image}") }}" class="img-fluid img-thumbnail" style="width:450px"
                            alt="{{ $know->title }}">
                    </div>

                    <div class="col-8 col-md-7">
                        <p class="h6 text-dark">{{ $know->title }}</p>
                        <p class="h6 text-dark">{{ $know->description }}</p>
                    </div>

                </div>
                        
            </div>
        </div>

    </div>       
@endsection