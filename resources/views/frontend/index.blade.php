@extends('layouts.app')
{{-- @extends('frontend.layouts.main') --}}
@section('title', 'E Pharmecy')
    
@section('content')

{{-- slider carousel --}}
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        @foreach ($sliders as $key => $sliderItem)
      <div class="carousel-item {{$key == '0' ? 'active' : ''}}" style="height: 550px;">
        @if ($sliderItem->image)
        <img src="{{asset($sliderItem->image)}}" class="d-block w-100" alt="slider" style="object-fit: cover;">
        @endif
        <div class="d-none d-md-block carousel-caption carousel_bg_custom">
            <div class="p-3 custom-carousel-content" style="max-width: 700px;">
                <h1>{!!$sliderItem->title!!}</h1>
                <p>{!!$sliderItem->description!!}</p>
                <a class="btn btn-outline-light text-primary py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
            </div>
        </div>
      </div>
      @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



@endsection



{{-- from app blade taking above --}}
