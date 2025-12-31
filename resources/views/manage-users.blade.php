@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/manage-users.css') }}">
@endsection

@section('content')
    <livewire:manage-users />
@endsection