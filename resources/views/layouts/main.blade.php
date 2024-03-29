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
                        @yield('menu-title')
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

                @error('*')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div id="alert-container">

                </div>

                @yield('content')
            </div>
        </div>
    </main>

    <footer class="bg-success">
         <p class="text-light">Sérgio Gabriel &copy 2021</p>
    </footer>

    @yield('validation-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>

        //POST - rota store
        $(function() {
            $('form[name="create-patients-form"]').submit(async function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                const { data } = await axios.post("{{ route('patients.create') }}", formData)

                $('#create-users-modal').modal('hide');
                let fetchResult = `
                        <div style="width: 100%" class="${data['color']}">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/img/avatars/${data['avatar']}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title align-items-to-center"><ion-icon name="person"></ion-icon>
                                            ${data['name']}
                                        </h5>
                                        <p class="card-text align-items-to-center"><ion-icon name="medkit"></ion-icon> Condição: ${data['status']}.</p>
                                        <p class="card-text align-items-to-center"><ion-icon name="id-card"></ion-icon> CPF: ${data['cpf']}</p>
                                        <p class="card-text align-items-to-center"><ion-icon name="today"></ion-icon> Idade: ${data['age']} anos</p>
                                        <a href="/patients/${data['id']}" class="btn btn-light">Ver mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                `;
                $('#main').prepend(fetchResult);
                $('#alert-container').innerHTML = `
                    <div class="alert alert-success" role="alert">
                        Paciente cadastrado com sucesso!
                    </div>
                `;
            });
        });

        //GET - pega dados da rota que retorna os dado
        $(function() {
            $(document).ready(async function() {
                let fetchResult = '';

                $('#spinner').removeClass('d-none')

                const { data } = await axios.get("{{ route('patients.data') }}")

                for(let i = 0; i < data.length; i++) {
                    let socialNameField = '';

                    if(data[i]['social_name']) {
                        socialNameField = `
                            (Nome social: ${data[i]['social_name']})
                        `;
                    }

                    fetchResult += `
                        <div style="width: 100%" class="${data[i]['color']}">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/img/avatars/${data[i]['avatar']}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title align-items-to-center"><ion-icon name="person"></ion-icon>
                                            ${data[i]['name']}
                                        </h5>
                                        <p class="card-text align-items-to-center"><ion-icon name="medkit"></ion-icon> Condição: ${data[i]['status']}.</p>
                                        <p class="card-text align-items-to-center"><ion-icon name="id-card"></ion-icon> CPF: ${data[i]['cpf']}</p>
                                        <p class="card-text align-items-to-center"><ion-icon name="today"></ion-icon> Idade: ${data[i]['age']} anos</p>
                                        <a href="/patients/${data[i]['id']}" class="btn btn-light">Ver mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    }
                $('#main').append(fetchResult);
                $('#spinner').addClass('d-none');
            });
        });
    </script>
</body>
</html>
