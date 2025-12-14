@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/manage-logs.css') }}">
@endsection

@section('content')
    <livewire:manage-logs />
@endsection