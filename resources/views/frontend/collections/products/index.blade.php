@extends('layouts.app')
{{-- @extends('frontend.layouts.main') --}}
@section('title')
{{$category->meta_title}}
@endsection

@section('meta_keyword')
{{$category->meta_keyword}}
@endsection
@section('meta_description')
{{$category->meta_description}}
@endsection
    
@section('content')

{{-- products --}}
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">{{ $category->name}}</h4>
            </div>
            {{-- converted to livewire component --}}
            {{-- setup livewire --}}
            {{-- moving :product ="$products" from here to livewire index controller --}}
            <livewire:frontend.product.index :category="$category" />
        </div>
    </div>
</div>

@endsection