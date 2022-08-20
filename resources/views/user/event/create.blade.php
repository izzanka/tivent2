@extends('layouts.app')

@section('title')
    Create New Event
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}" class="text-dark">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <form enctype="multipart/form-data" method="POST" action="{{ route('events.store') }}">
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
                                    <select name="categories[]" class="form-control selectCategory @error('categories') is-invalid @enderror" multiple="multiple">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <textarea name="description" class="form-control">{{ old('description')}}</textarea>
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
                                <td>Start Date</td>
                                <td>:</td>
                                <td>
                                    <input type="date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date')}}">
                                    @error('start_date')
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
                                    <input type="time" name="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time')}}">
                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td>Important Information</td>
                                <td>:</td>
                                <td>
                                    <textarea name="important_information" class="form-control">{{ old('important_information')}}</textarea>
                                    @error('important_information')
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
            placeholder: "select category",
        });
    });

    let previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            let filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                if(i === 3){
                    break;
                }
                let reader = new FileReader();
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