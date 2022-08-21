@extends('layouts.app')

@section('title')
    Create ticket
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Events</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.detail',$event) }}" class="text-dark">{{ $event->name }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-dark">Tickets</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <form method="POST" action="{{ route('tickets.update') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6">
                @php
                    $images = convertImages($event->images);
                @endphp

                <div class="currentImage">
                    @foreach ($images[0] as $image)
                        <img src="{{ asset('storage/img/' . $image) }}" class="img-fluid mt-2 rounded mx-auto d-block" alt="*preview image" width="400" height="400">
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <table class="table" style="border-top : hidden">
                            <tr>
                                <td>Type</td>
                                <td>:</td>
                                <td>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror" >
                                        <option value="">Select Type</option>
                                        <option value="Reguler" @if ($types[0]) disabled @endif>Reguler</option>
                                        <option value="One-Day Pass" @if ($types[1]) disabled @endif>One-Day Pass</option>
                                        <option value="Multi-Day Pass" @if ($types[2]) disabled @endif>Multi-Day Pass</option>
                                        <option value="VIP" @if ($types[3]) disabled @endif>VIP</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td>
                                    <textarea name="description" class="form-control" maxlength="125">{{ old('description')}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>


                            <tr>
                                <td>Price</td>
                                <td>:</td>
                                <td>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Rp." min="0" value="{{ old('price') }}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Qty</td>
                                <td>:</td>
                                <td>
                                    <input type="number" name="qty"
                                        class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty')}}" min="1">
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                        
                            <tr>    
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block">Create Ticket</button>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
                        
            </div>
        </div>
    
    </div>
</div>
@endsection