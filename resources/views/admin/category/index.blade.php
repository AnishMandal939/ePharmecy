@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
{{-- here container are moved to livewire component --}}
{{-- connect livewire --}}
<div>
    <livewire:admin.category.index />
</div>
@endsection