@extends('layouts.main')

@section('title', $patient->name)

@section('content')
    <div style="width: 100%"
    class="card mb-8 bg-light"
    >
    <div class="row g-0">
    <div class="col-md-4">
        <img src="/img/avatars/{{ $patient->avatar }}" class="img-fluid rounded-start" alt="..." style="width: 20rem; height: 25rem;">
    </div>
    <div class="col-md-8 symptoms-separator">
        <div class="card-body">
            <h5 class="card-title align-items-to-center"><ion-icon name="person"></ion-icon> {{ $patient->name }}</h5>
            <p class="card-text align-items-to-center"><ion-icon name="medkit"></ion-icon> Condição: {{ $patient->status }}.</p>
            <p class="card-text align-items-to-center"><ion-icon name="id-card"></ion-icon> CPF: {{ $patient->cpf }}</p>
            <p class="card-text align-items-to-center"><ion-icon name="today"></ion-icon> Idade: {{ $patient->age }} anos</p>
            <p class="card-text align-items-to-center"><ion-icon name="people"></ion-icon> Nome social: {{ $patient->social_name }}</p>
            @if($patient->observation)
                <p class="card-text align-items-to-center">
                    Observação: {{ $patient->observation }}
                </p>
            @endif
            <div class="action-buttons">
                <button class="btn btn-primary align-items-to-center" data-bs-toggle="modal" data-bs-target="#update-users-modal"><ion-icon name="create"></ion-icon> Editar</button>
                <button class="btn btn-danger align-items-to-center"data-bs-toggle="modal" data-bs-target="#delete-users-modal"><ion-icon name="trash"></ion-icon> Deletar</button>
            </div>
        </div>
        @if($patient->symptoms)
            <div class="card-body">
                <h5 class="card-title align-items-to-center"><ion-icon name="body"></ion-icon> Sintomas</h5>
                <ul id="items-list">
                    @foreach ($patient->symptoms as $symptom)
                        <li>
                            <ion-icon name="play"></ion-icon>
                            <span>{{ $symptom }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    </div>
    </div>

    <div class="modal fade" id="update-users-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title text-light" id="exampleModalLabel">Editar suspeita de COVID-19</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/patients/update/{{ $patient->id }}" method="POST" enctype="multipart/form-data"
                    name="update-patients-form"
                    onsubmit="return handleWithGeneralChecksAtUpdate();">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="name" class="col-form-label">Nome completo:</label>
                  <input type="text" name="name" class="form-control" id="name" onkeypress="handleWithGeneralChecksAtUpdate();" value="{{ $patient->name }}">
                  <div class="valid-feedback" id="feedback-from-name">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="social_name" class="col-form-label">Nome social:</label>
                    <input type="text" name="social_name" class="form-control" id="social_name" onkeypress="handleWithGeneralChecksAtUpdate();" value="{{ $patient->social_name }}">
                    <div class="valid-feedback" id="feedback-from-social-name">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="avatar" class="col-form-label">Foto:</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" accept="image/*">
                    <div class="valid-feedback" id="feedback-from-avatar">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="age" class="col-form-label">Idade:</label>
                    <input type="number" name="age" class="form-control" id="age" onkeypress="handleWithGeneralChecksAtUpdate();" value="{{ $patient->age }}">
                    <div class="valid-feedback" id="feedback-from-age">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="col-form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" maxlength="14"
                        onkeypress="addMaskToCpfAtUpdate();" onkeyup="handleWithGeneralChecksAtUpdate();" value="{{ $patient->cpf }}"
                    >
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
                  <textarea name="observation" class="form-control" id="observation">{{ $patient->observation }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

  <div class="modal fade" id="delete-users-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deletar paciente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tem certeza de que quer excluir o perfil deste paciente?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

        <form action="/patients/{{ $patient->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary align-items-to-center">Confirmar exclusão</button>
        </form>
        </div>
      </div>
    </div>
  </div>
      <script src="/js/validate_patients_update.js"></script>
@endsection
