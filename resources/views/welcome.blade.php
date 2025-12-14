@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
@endsection

@section('content')
    <livewire:welcome />
@endsection