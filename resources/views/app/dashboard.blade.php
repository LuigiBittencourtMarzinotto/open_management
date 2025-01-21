@extends('app.layouts.app')

@section('content')
    <h1> 12334</h1>
    <p> Token {{ session('token') }}</p>
    <h2>*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/</h2>
    <!-- Exibindo valores dos cookies -->
    <p>Token2 (cookie): {{ request()->cookie('token2') }}</p>
    <p>Token (cookie): {{ request()->cookie('token') }}</p>
    <p>Token (cookie): {{ request()->cookie('tokewwdn') }}</p>
@endsection
