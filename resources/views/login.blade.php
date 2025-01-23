@extends('layouts.app')

@section('content')
    <home-component token="{{ @csrf_token() }}" route-dashboard="{{ route('dashboard.index') }}"
        route-login="{{ route('loginApi.store') }}" route-register="{{ route('register-user') }}"
        route-code-verification-email="{{ route('code-verification-email') }}" 
        route-verified-email="{{ route('verified-email') }}"
        route-verified-cep="{{ route('verified-cep') }}"
        route-forgetten-password="{{ route('forgetten-password') }}"></home-component>
@endsection
