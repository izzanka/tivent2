@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card" >
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('storage/img/ss1.png') }}" class="img-fluid border border-dark" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('storage/img/ss1.png') }}" class="img-fluid border border-dark" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('storage/img/ss1.png') }}" class="img-fluid border border-dark" alt="...">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </button>
                </div>
                <div class="card-body">
                <h5 class="card-title">name</h5>
                <p class="card-text">Start From </p>
                <a href="#" class="btn btn-primary">Check Ticket</a>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection