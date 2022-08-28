@extends('layouts.app')
{{-- @extends('frontend.layouts.main') --}}
@section('title')
{{$product->meta_title}}
@endsection

@section('meta_keyword')
{{$product->meta_keyword}}
@endsection
@section('meta_description')
{{$product->meta_description}}
@endsection
    
@section('content')

<div>
    {{-- this refers to livewire http path --}}
    <livewire:frontend.product.view :category="$category" :product="$product" />
</div>

@endsection
