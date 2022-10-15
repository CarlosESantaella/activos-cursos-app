<nav class="navbar navbar-expand navbar-dark bg-primary-cursos">
  <div class="container-fluid">
    <a class="navbar-brand" href="/app">
      <img src="/app/assets/img/logo-cursos.png" alt="Logo" style="width: 100px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($user_global->type == 'admin'){ ?>
        <li class="nav-item">
          <a class="nav-link mt-1" aria-current="page" href="/app/dashboard">Consultas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mt-1" aria-current="page" href="/app/registro">Crear usuario</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link " href="/app/actions/auth/logout">
            <i class="fa-solid fa-right-from-bracket fa-2x"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>