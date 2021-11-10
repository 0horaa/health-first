<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">

    <title>@yield('title')</title>
  </head>
  <body class="antialiased">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
            <a class="navbar-brand" href="/">Health First</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-green nav-link active" data-bs-toggle="modal" data-bs-target="#create-users-modal">Cadastrar paciente</button>
                    </li>
                </ul>
                <form action="/" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Digite o nome..." aria-label="Search">
                    <button class="btn btn-light" type="submit">Pesquisar</button>
                </form>
            </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid" id="container-fluid">
            <div>
                @if(session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="bg-success">
         <p class="text-light">Sérgio Gabriel &copy 2021</p>
    </footer>

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
                    <input type="text" name="name" class="form-control" id="name" onkeypress="handleWithGeneralChecks();">
                    <div class="valid-feedback" id="feedback-from-name">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="social_name" class="col-form-label">Nome social (opcional):</label>
                    <input type="text" name="social_name" class="form-control" id="social_name" onkeypress="handleWithGeneralChecks();">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="col-form-label">Foto:</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" accept="image/*" onchange="handleWithGeneralChecks();">
                    <div class="valid-feedback" id="feedback-from-avatar">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="age" class="col-form-label">Idade:</label>
                    <input type="number" name="age" class="form-control" id="age" onkeypress="handleWithGeneralChecks();">
                    <div class="valid-feedback" id="feedback-from-age">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="col-form-label">Número:</label>
                    <input type="text" name="phone" class="form-control" id="phone"
                        onkeypress="handleWithGeneralChecks(); addMaskToPhone();"
                    >
                    <div class="valid-feedback" id="feedback-from-phone">Tudo certo!</div>
                </div>
                <div class="mb-3">
                    <label for="cpf" class="col-form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" maxlength="14"
                        onkeypress="addMaskToCpf();" onkeyup="handleWithGeneralChecks();"
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

    <script src="/js/validate_patients_register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
