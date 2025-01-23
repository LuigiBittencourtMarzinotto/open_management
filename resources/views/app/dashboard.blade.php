@extends('app.layouts.app')

@section('content')
    <card-component class="m-5 d-flex col-lg-10 shadow border-radius-card p-4 justify-content-center">
        <template v-slot:body>
            <h1 class="text-dark text-center">Bem-vindo(a)!</h1>
            <h3 class="text-secondary text-center">
                Olá, <span class="fw-bold text-dark">{{ session('nameUser') }}</span>! 
            </h3>
            <p class="mt-3 text-center text-muted">Estamos felizes por você estar aqui. </p>
        </template>
    </card-component>
@endsection