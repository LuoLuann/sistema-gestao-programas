@section('css')
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="/css/menu.css">
@endsection

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script> 
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> 
  </head>

@auth
  <header>
    <!-- Isso aqui é a barra de cima -->
    <nav class="navbar navbar-menu d-flex">
      <div class="container-fluid d-flex fonteheader">
        <div class="botoesdd">
          <div class="dropdown">
            <button class="btn-menu  d-flex" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" >
              <img src="{{asset("images/list-box-outline.png")}}" alt="listar" class="image-size">
              Listar
              <span class="dropdown-toggle"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark"  role="menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="{{route("programas.index")}}">Programas</a></li>
              <li><a class="dropdown-item" href="{{route("servidores.index")}}">Servidores</a></li>
              <li><a class="dropdown-item" href="{{route("alunos.index")}}">Estudantes</a></li>
              <li><a class="dropdown-item" href="{{route("orientadors.index")}}">Professores</a></li>
            </ul>
          </div>
        </div>
        <div class="botoesdd">
          <div class="dropdown">
            <button class="btn-menu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" >
              <img src="{{asset("images/folder-outline.png")}}" alt="gerenciar" class="image-size">
              Gerenciar
              <span class=" dropdown-toggle"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-dark"role="menu"  aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="{{route("edital.index")}}">Editais</a></li>
              <li><a class="dropdown-item" href="{{route("cursos.index")}}">Cursos</a></li>
              <li><a class="dropdown-item" href="{{route("disciplinas.index")}}">Disciplinas</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
  
  @endauth
