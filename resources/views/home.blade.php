@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')
<div class="container">
    <div class="row">
      @forelse ($events as $event)
        <div class="col-6 mt-2">
            <div class="card">
                @php  
                  $images = convertImages($event->images);
                @endphp

                <div id="{{ $images[1] }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                      @foreach ($images[0] as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                          <img src="{{ asset('storage/img/' . $image) }}" class=" border border-dark"  width="538" height="250" >
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
                <a href="{{ route('events.show', $event) }}" style="color: white; text-decoration: none;">

                <div class="card-body text-dark">
                  <div class="row">
                    <div class="col-sm-2">
                      <b class="text-success">
                        {{ $event->getDate() }}<br>
                        {{ $event->getMonth() }}
                      </b>
                    </div>
                    <div class="col-sm-10">
                      <small class="text-secondary">{{ $event->location }}</small>
                      <h5 style="font-weight: 600;">{{ $event->name }}</h5>
                      <p class="card-text" style="font-weight: 600;"><small class="text-secondary">Start from</small> Rp @toRupiah($event->tickets->min('price'))</p>
                    </div>
                  </div>
                </div>
              </a>
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