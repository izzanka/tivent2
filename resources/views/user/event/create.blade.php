@extends('layouts.app')

@section('title')
    Create New Event
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        
    </div>
    
    <form enctype="multipart/form-data" method="post" action="{{ route('events.store') }}">
        @csrf
        <div class="row">

            <div class="col-6">
                <div class="preview-img"></div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <table class="table" style="border-top : hidden">
                            <tr>
                                <td>Category</td>
                                <td>:</td>
                                <td>
                                    <select name="category[]" class="form-control selectCategory" multiple="multiple">
                                        <option value="concert">Concert</option>
                                        <option value="festival">Festival</option>
                                        <option value="game">Game</option>
                                        <option value="fashion">Fashion</option>
                                        <option value="exhibition">Exhibition</option>
                                        <option value="sport">Sport</option>
                                        <option value="education">Education</option>
                                        <option value="culture">Culture</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}">
                                    @error('name')
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
                                    <textarea name="description" id="" cols="15" rows="5" class="form-control">{{ old('name')}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                      
                            <tr>
                                <td>Location</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="location"
                                        class="form-control @error('location') is-invalid @enderror" value="{{ old('location')}}">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td>
                                    <input type="date" name="date"
                                        class="form-control @error('date') is-invalid @enderror" value="{{ old('date')}}">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Start Time</td>
                                <td>:</td>
                                <td>
                                    <input type="time" name="time"
                                        class="form-control @error('time') is-invalid @enderror" value="{{ old('time')}}">
                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                          
                            <tr>
                                <td>Images (max: 3)</td>
                                <td>:</td>
                                <td>
                                    <input type="file" accept="image/*" class="form-control" name="images[]" multiple id="images">

                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
 
                                
                            </tr>
                            <tr>    
                                <td colspan="3">
                                    <button type="submit" class="btn btn-dark btn-block">Create Event</button>
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

<script>
    $(document).ready(function() {
        $('.selectCategory').select2({
            placeholder: "Select Category",
        });
    });

    var previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                if(i === 3){
                    break;
                }
                var reader = new FileReader();
                reader.onload = function(event){
                    let html = '<img class="img-fluid mt-2 rounded mx-auto d-block" alt="*preview image" width="400" height="400">';
                    $($.parseHTML(html)).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#images').on('change', function() {
        previewImages(this, 'div.preview-img');
    });

</script>

@endsection