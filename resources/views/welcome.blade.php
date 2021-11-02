@extends('layouts.main')

@section('title', 'Home')

@section('content')
    @if($search)
        <h3 class="title-message">Buscando por: {{ $search }}</h3>
    @else
        <h3 class="title-message">Todos os pacientes</h3>
    @endif
    @foreach($patients as $patient)
        <div style="width: 100%"
            class="<?php
                if($patient->status == "Sintomas insuficientes" || $patient->status == "Nenhum sintoma foi informado") {
                    echo "card mb-3 text-white bg-success";
                } else if($patient->status == "Potencial infectado") {
                    echo "card mb-3 text-white bg-warning";
                } else {
                    echo "card mb-3 text-white bg-danger";
                }
            ?>"
        >
            <div class="row g-0">
            <div class="col-md-4">
                <img src="/img/avatars/{{ $patient->avatar }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title align-items-to-center"><ion-icon name="person"></ion-icon> {{ $patient->name }}</h5>
                    <p class="card-text align-items-to-center"><ion-icon name="medkit"></ion-icon> Condição: {{ $patient->status }}.</p>
                    <p class="card-text align-items-to-center"><ion-icon name="id-card"></ion-icon> CPF: {{ $patient->cpf }}</p>
                    <p class="card-text align-items-to-center"><ion-icon name="today"></ion-icon> Idade: {{ $patient->age }} anos</p>
                    <a href="/patients/{{ $patient->id }}" class="btn btn-light">Ver mais</a>
                </div>
            </div>
            </div>
        </div>
    @endforeach
    @if(count($patients) === 0 && $search)
        <h3 class="align-items-to-center title-message"><ion-icon name="sad" size="large"></ion-icon> Nenhum resultado foi encontrado para a pesquisa: {{ $search }}</h3>
    @elseif(count($patients) === 0)
    <h3 class="align-items-to-center title-message"><ion-icon name="sad" size="large"></ion-icon> Você ainda não cadastrou nenhum paciente...</h3>
    @endif
@endsection
