@extends('app.layouts.app')
@section('content')
<show-user-component codigo-user={{ $codigoUser }} route-verified-cep="{{ route('verified-cep') }}" route-user={{ route('user.show', [$codigoUser])  }}></show-user-component>
@endsection
