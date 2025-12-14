@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/login-admin.css') }}">
@endsection

@section('content')
    <livewire:login-admin />
@endsection