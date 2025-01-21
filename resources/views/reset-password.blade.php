@extends('layouts.app')

@section('content')
    <reset-password-component id="{{ $id }}" token="{{ @csrf_token() }}" update-password="{{ route('update-password') }}" route-login="{{ route('login') }}"></reset-password-component>
@endsection
