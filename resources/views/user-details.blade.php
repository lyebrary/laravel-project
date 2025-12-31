@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/user-details.css') }}">
@endsection

@section('content')
    <livewire:user-details :userId="$userId" />
@endsection