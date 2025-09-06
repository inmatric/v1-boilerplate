@extends('components.layouts.main-layout')
@section('title', 'Employee')
@section('content')
        <p>Selamat datang, {{ Auth::user()->username }}!</p>

@endsection