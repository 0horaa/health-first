@extends('layouts.main')

@section('title', 'Home')

@section('validation-scripts')
    <script src="/js/validate_patients_register.js"></script>
@endsection

@section('menu-title')
    <button class="btn btn-green nav-link active" data-bs-toggle="modal" data-bs-target="#create-users-modal">Cadastrar paciente</button>
@endsection

@section('content')
    <div class="modal fade" id="create-users-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
            <h5 class="modal-title text-light" id="exampleModalLabel">Verificar suspeita de COVID-19</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/patients" method="POST"
                    enctype="multipart/form-data"
                    name="create-patients-form"
                    id="create-patients-form"
                    onsubmit="return handleWithGeneralChecks();">
                @csrf
                <div class="mb-3">
                    <label for="name" class="col-form-label">Nome completo:</label>
                    <input type="text" name="name" class="form-control" id="name"
                    onkeypress="handleWithGeneralChecks();"
                    onkeyup="handleWithGeneralChecks();"
                    >
                    <div class="valid-feedback" id="feedback-from-name">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="social_name" class="col-form-label">Nome social (opcional):</label>
                    <input type="text" name="social_name" class="form-control" id="social_name" onkeypress="handleWithGeneralChecks();">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="col-form-label">Foto:</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" accept=".png,.jpg,.jpeg" onchange="handleWithGeneralChecks();">
                    <div class="valid-feedback" id="feedback-from-avatar">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="age" class="col-form-label">Idade:</label>
                    <input type="number" name="age" class="form-control" id="age"
                    onkeypress="handleWithGeneralChecks();"
                    onkeyup="handleWithGeneralChecks();"
                    >
                    <div class="valid-feedback" id="feedback-from-age">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="col-form-label">Número:</label>
                    <input type="text" name="phone" class="form-control" id="phone" maxlength="15"
                        onkeypress="handleWithGeneralChecks(); addMaskToPhoneOnPress();"
                        onkeyup="handleWithGeneralChecks(); addMaskToPhoneOnUp();"
                    >
                    <span class="text-secondary" style="cursor: pointer;" onclick="cleanPhoneField();">Limpar</span>
                    <div class="valid-feedback" id="feedback-from-phone">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="col-form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" maxlength="14"
                        onkeypress="handleWithGeneralChecks(); addMaskToCpf();"
                        onkeyup="handleWithGeneralChecks(); addMaskToCpf();"
                    >
                    <span class="text-secondary" style="cursor: pointer;" onclick="cleanCPFField();">Limpar</span>
                    <div class="valid-feedback" id="feedback-from-cpf">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Sintomas apresentados:</label>
                    <div class="checkbox-container">
                        <div class="separator-of-checkbox">
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Febre" id="febre">
                                <label class="form-check-label" for="febre">Febre</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Coriza" id="coriza">
                                <label class="form-check-label" for="coriza">Coriza</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Nariz entupido" id="nariz-entupido">
                                <label class="form-check-label" for="nariz-entupido">Nariz entupido</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Cansaço" id="cansaco">
                                <label class="form-check-label" for="cansaco">Cansaço</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Tosse" id="tosse">
                                <label class="form-check-label" for="tosse">Tosse</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Dor de cabeça" id="dor-de-cabeca">
                                <label class="form-check-label" for="dor-de-cabeca">Dor de cabeça</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Dores no corpo" id="dores-no-corpo">
                                <label class="form-check-label" for="dores-no-corpo">Dores no corpo</label>
                            </div>
                        </div>

                        <div class="separator-of-checkbox">
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Mal estar geral" id="mal-estar-geral">
                                <label class="form-check-label" for="mal-estar-geral">Mal estar geral</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Dor de garganta" id="dor-de-garganta">
                                <label class="form-check-label" for="dor-de-garganta">Dor de garganta</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Dificuldade de respirar" id="dificuldade-de-respirar">
                                <label class="form-check-label" for="dificuldade-de-respirar">Dificuldade de respirar</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Falta de paladar" id="falta-de-paladar">
                                <label class="form-check-label" for="falta-de-paladar">Falta de paladar</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Falta de olfato" id="falta-de-olfato">
                                <label class="form-check-label" for="falta-de-olfato">Falta de olfato</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Dificuldade de locomoção" id="dificuldade-de-locomocao">
                                <label class="form-check-label" for="dificuldade-de-locomocao">Dificuldade de locomoção</label>
                            </div>
                            <div class="form-check">
                                <input name="symptoms[]" class="form-check-input" type="checkbox" value="Diarréia" id="diarreia">
                                <label class="form-check-label" for="diarreia">Diarréia</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                <label for="observation" class="col-form-label">Observações (opcional):</label>
                <textarea name="observation" class="form-control" id="observation"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" id="btn-add">Cadastrar</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    @if($search)
        <h3 class="title-message">Buscando por: {{ $search }}</h3>
    @else
        <h3 class="title-message">Todos os pacientes</h3>
    @endif
    @foreach($patients as $patient)
        <div style="width: 100%"
            class="
                @if($patient->status == "Sintomas insuficientes" || $patient->status ==  "Nenhum sintoma foi informado")
                    card mb-3 text-white bg-success
                @elseif($patient->status == "Potencial infectado")
                    card mb-3 text-white bg-warning
                @else
                    card mb-3 text-white bg-danger
                @endif
            ">
            <div class="row g-0">
            <div class="col-md-4">
                <img src="/img/avatars/{{ $patient->avatar }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title align-items-to-center"><ion-icon name="person"></ion-icon>
                        {{ $patient->getRawOriginal('name')}}
                        @if($patient->social_name)
                            (Nome social: {{ $patient->social_name }})
                        @endif
                    </h5>
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
