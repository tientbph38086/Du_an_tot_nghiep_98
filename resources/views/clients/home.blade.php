@extends('layouts.client')

@section('content')
@include('clients.layout.blocks.slider')
@include('clients.layout.search')

@include('clients.room.index')
@include('clients.layout.about')
@include('clients.layout.video')
@include('clients.layout.review')
@include('clients.layout.blog')


{{-- @include('clients.promotions') --}}

@endsection
