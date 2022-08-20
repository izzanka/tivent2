@extends('layouts.app')

@section('title')
    Events
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Events</li>
                </ol>
            </nav>
        </div>

        @include('layouts.message')

        <div class="col-sm-12">
            <a href="{{ route('events.create') }}" class="btn btn-primary float-right"> Create New Event</a>
        </div>

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
                          <img src="{{ asset('storage/img/' . $image) }}" class="border border-dark" width="538" height="300">
                        </div>
                      @endforeach

                    </div>

                    @if (count($images[0]) > 1)
                      <button class="carousel-control-prev" type="button" data-target="#{{ $images[1] }}" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-target="#{{ $images[1] }}" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </button>
                    @endif

                </div>
                <div class="card-body">
                  <small class="card-title text-secondary">{{ $event->location }}</small>
                  <h4 class="card-title"><b>{{ $event->name }}</b></h4>
                  <p class="card-text">
                      <a href="{{ route('events.detail', $event) }}" class="btn btn-primary">Detail</a>
                      <a href="{{ route('events.delete', $event) }}" class="btn btn-danger float-right" onclick="return confirm('Are you sure?')">Delete</a>
                      <a href="{{ route('events.edit', $event) }}" class="btn btn-primary float-right mr-2">Edit</a>
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center mt-4">
            No Events!
        </div>       
        @endforelse
      </div>
         
      <div class="mt-4">
        {{ $events->links() }}
      </div>

</div>
@endsection