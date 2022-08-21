@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="row">
      @forelse ($events as $event)
        <div class="col-6 mt-4">
            <div class="card">

              @php
                $arrayImages = json_decode($event->images);
                $stringImages = implode($images);
                $idImages = preg_replace('/[^a-zA-Z]/', '', $stringImages);
              @endphp

                <div id="{{ $idImages }}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                      @for ($i = 1; i < count($arrayImages); $i++)
                          <li data-target="{{ $idImages }}" data-slide-to="{{ $i }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                      @endfor
                    
                    </ol>

                    <div class="carousel-inner">

                      @foreach ($arrayImages as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                          <img src="{{ asset('storage/img/' . $image) }}" class="img-fluid border border-dark">
                        </div>
                      @endforeach

                    </div>

                    @if (count($arrayImages) > 1)
                      <button class="carousel-control-prev" type="button" data-target="{{ $idImages }}" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-target="{{ $idImages }}" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </button>
                    @endif

                </div>
                <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="card-text">Start From </p>
                <a href="{{ route('events.show', $event) }}" class="btn btn-primary">Check Ticket</a>
                </div>
            </div>
        </div>
      @empty
      <div class="col-12 text-center">
          No Events
      </div>       
      @endforelse
    </div>
   
</div>
@endsection