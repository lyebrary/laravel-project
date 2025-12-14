@extends('layouts.app')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/register-student.css') }}">
@endsection

@section('content')
    <livewire:register-student />
@endsection