@extends('app.layouts.app')
@section('content')
    <list-users-component route-user={{ route("user.index") }}></list-users-component>
@endsection
