@extends('layouts.layout')
@section('title')
Sign Up
@endsection
@section('form')
    <h1 class='row justify-content-center'>Sign Up</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                        @endforeach
                    </ul>
            </div>
    @endif
    <div class="divbody">
        <Register/>
    </div>
    <script src="js/app.js"></script>
@endsection