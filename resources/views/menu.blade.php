<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="/assets/images/avatar.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2 text-capitalize">{{ auth()->user()->name }}</span>
                  <span class="text-secondary text-small">Estudiante</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/app">
                <span class="menu-title">Cursos</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="/app/profile">
                <span class="menu-title">Configuración</span>
                <i class="mdi mdi-face-profile menu-icon"></i>
              </a>
            </li>
            
          
           
          </ul>
        </nav>