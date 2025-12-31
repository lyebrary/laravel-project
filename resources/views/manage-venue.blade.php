@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/manage-venue.css') }}">
@endsection

@section('content')
    <livewire:manage-venue />
@endsection