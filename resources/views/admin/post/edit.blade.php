@extends('layouts.admin')

@section('content')


<h3 class="border-bottom pb-2 mb-3">Update post</h3>
<form method="post" action="{{route('post.update', ['post' => $post->id])}}" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="mb-2">
    <label for="title" class="form-label fw-bold">Title</label>
    <input type="text" value="{{old('title', $post->title)}}" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title of the post">
    @error('title')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>


  <div class="mb-2">
    <label for="description" class="form-label fw-bold">Description</label>
    <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="description of the post">{{old('description', $post->description)}}</textarea>
    @error('description')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-2">
    <label for="region" class="form-label fw-bold">Region</label>
    <select name="region" class="form-select @error('region') is-invalid @enderror" id="region">
      <option value="0">Select Region</option>
      @foreach ($regions as $region)
      @if (old('region', $post->region_id) == $region->id)
      <option selected value="{{ $region->id }}">{{ $region->title }}</option>
      @else
      <option value="{{ $region->id }}">{{ $region->title }}</option>
      @endif
      @endforeach
    </select>
    @error('region')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-2">
    <label for="city" class="form-label fw-bold">City</label>
    <select name="city" class="form-select @error('city') is-invalid @enderror" id="city">
      <option value="0">Select City</option>
      @foreach ($cities as $city)
      @if (old('city', $post->city_id) == $city->id)
      <option selected value="{{ $city->id }}">{{ $city->title }}</option>
      @else
      <option value="{{ $city->id }}">{{ $city->title }}</option>
      @endif
      @endforeach
    </select>
    @error('city')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-2">
    <label for="village" class="form-label fw-bold">Village</label>
    <select name="village" class="form-select @error('village') is-invalid @enderror" id="village">
      <option value="0">Select Village</option>
      @foreach ($villages as $village)
      @if (old('village', $post->village_id) == $village->id)
      <option selected value="{{ $village->id }}">{{ $village->title }}</option>
      @else
      <option value="{{ $village->id }}">{{ $village->title }}</option>
      @endif
      @endforeach
    </select>
    @error('village')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-2">
    <label for="status" class="form-label fw-bold">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror" id="status">
      <option value="0">Select status</option>
      @foreach ($statuses as $key => $status)
      @if (old('status', $post->published) == $key)
      <option selected value="{{ $key }}">{{ $status }}</option>
      @else
      <option value="{{ $key }}">{{ $status }}</option>
      @endif
      @endforeach
    </select>
    @error('status')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-2">
    <label for="image" class="form-label fw-bold">Image</label>
    <input type="file" multiple name="image[]" class="form-control @error('image.*') is-invalid @enderror">
    @error('image.*')
    <div class="text-danger">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-2 d-flex justify-content-end">
    <input type="submit" value="Update" class="btn btn-primary">
  </div>

</form>


<div class="gallery w-100 d-flex">
  @foreach ($post->images as $item)
  <div class="image">
    <img class="mw-100 p-1" src="/storage/post_images/{{$item->thumbnail}}" alt="{{$item->title}}">
    <form action="{{route('image.destroy', ['image' => $item->id])}}" method="post">
      @csrf
      @method('delete')
      <button onclick="return confirm('Are you sure?')">x</button>
    </form>
  </div><!-- .image -->  
  @endforeach
</div><!-- .gallery -->

@endsection