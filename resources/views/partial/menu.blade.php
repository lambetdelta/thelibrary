<nav id="menu"  class="navbar navbar-expand-lg  bg-primary text-white">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar" aria-controls="nav-bar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="nav-bar">
          <ul class="navbar-nav ">
            @guest
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('viewLogin') }}">Entrar</a>
                </li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-id-card"></i>{{ Auth::user()->email }}
                </a>
                <div class="dropdown-menu" aria-labelledby="profile">
                  <a class="dropdown-item" href="{{ route('viewUpdateProfile') }}">
                      Perfil
                  </a>
                  <a class="dropdown-item" href="{{ route('viewUpdatePassword') }}">
                      Contraseña
                  </a>
                  <a id="logout" class="dropdown-item cursor-pointer">
                      Salir
                  </a>
                </div>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            @endguest
          </ul>
            @auth
                <ul class="navbar-nav navbar-left">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="users-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users-cog"></i>Usuarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="users-menu">
                            <a class="dropdown-item" href="{{ route('register') }}">Nuevo Usuario</a>
                            <a class="dropdown-item" href="{{ route('list_users') }}">
                                Lista
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="users-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users-cog"></i>Miembros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="users-menu">
                            <a class="dropdown-item" href="{{ route('member_view_add') }}">Nuevo</a>
                            <a class="dropdown-item" href="{{ route('member_list') }}">
                                Lista
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="category-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users-cog"></i>Cátegorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="category-menu">
                            <a class="dropdown-item" href="{{ route('category_view_add') }}">Nueva</a>
                            <a class="dropdown-item" href="{{ route('category_list') }}">
                                Lista
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="books-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users-cog"></i>Libros
                            </a>
                            <div class="dropdown-menu" aria-labelledby="books-menu">
                                <a class="dropdown-item" href="{{ route('book_view_add') }}">Nuevo</a>
                                <a class="dropdown-item" href="{{ route('book_list') }}">
                                    Lista
                                </a>
                            </div>
                        </li>
                </ul>
            @endauth
        </div>
      </nav>
