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
                $images = convertImages($event->images);
              @endphp

                <div id="{{ $images[1] }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                      @foreach ($images[0] as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                          <img src="{{ asset('storage/img/' . $image) }}" class="img-fluid border border-dark">
                        </div>
                      @endforeach

                    </div>

                    @if (count($images[0]) > 1)
                      <button class="carousel-control-prev" type="button" data-target="{{ $images[1] }}" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-target="{{ $images[1] }}" data-slide="next">
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