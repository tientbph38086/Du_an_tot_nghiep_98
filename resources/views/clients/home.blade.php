@extends('layouts.client')

@section('content')
@include('clients.layout.blocks.slider')
@include('clients.layout.search')
@include('clients.layout.about')

@include('clients.room.index')
{{-- @include('clients.promotions') --}}

@endsection
