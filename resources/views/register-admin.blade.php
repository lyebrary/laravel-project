@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/register-admin.css') }}">
@endsection

@section('content')
    <livewire:register-admin />
@endsection