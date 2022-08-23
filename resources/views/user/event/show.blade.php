@extends('layouts.app')

@section('title')
Detail Event
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Events</a></li>
                    <li class="breadcrumb-item text-dark">{{ $event->name }}</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        @include('layouts.message')

        @php
            $images = convertImages($event->images);
        @endphp

        <div class="col-6 mt-2">
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
        </div>
        <div class="col-6">
            <small class="text-secondary">{{ $event->location }}</small><br>
               <h4> <b>{{ $event->name }}</b></h4>
                @foreach ($categories as $category)
                    <span class="badge badge-pill badge-info">{{ $category }}</span>
                @endforeach
            <hr>
            <small class="text-secondary">About this event</small>
            <p>
                {{ $event->description }}
            </p>
        </div>
       
        <div class="col-12 mt-2">
            <hr>
            <div class="row">
                
                <div class="col-6">
                    <b>Location</b>
                </div>
                <div class="col-5">
                    <p>
                        {{ $event->location }}
                    </p>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-6">
                    <b>Important Information</b>
                </div>
                <div class="col-6">
                    <p>
                        {{ $event->important_information ? $event->important_information : '-'}}
                    </p>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-6">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <b>Event Started On</b><br>
                            {{ $event->getStartDate() }}
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    @foreach($event->tickets as $ticket)
                        <div class="card mb-2 border-secondary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <b>{{ $ticket->type }}</b><br>
                                        <p>
                                            {{ $ticket->description }}
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <div style="border-left: 1px solid black; height: 100%">
                                            <form id="destroyTicket-form{{ $ticket->type }}" action="{{ route('tickets.destroy', ['event' => $event, 'ticket' => $ticket]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                              </form>
                                            <div class="float-right">
                                                <h5><b>Rp @toRupiah($ticket->price)</b></h5>
                                                @can('eventCrud',$event)
                                                    <a href="{{ route('tickets.destroy', ['event' => $event, 'ticket' => $ticket]) }}" onclick="confirm('Are you sure?');event.preventDefault();
                                                document.getElementById('destroyTicket-form{{ $ticket->type }}').submit();" class="btn btn-sm btn-outline-danger float-right">Delete</a>
                                                    <a href="{{ route('tickets.edit',['event' => $event, 'ticket' => $ticket]) }}" class="btn btn-sm btn-outline-primary float-right mr-2"> Edit</a>
                                                @else
                                                    <a href="" class="btn btn-sm btn-outline-success mt-2 float-right"> Select Ticket</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @can('eventCrud', $event)
                        <div class="text-center">
                            <a href="{{ route('tickets.create', $event) }}"> Create New Ticket</a>
                        </div>
                    @endcan
                </div>
            </div>
            <hr>
        </div>

   
    </div>
</div>
@endsection