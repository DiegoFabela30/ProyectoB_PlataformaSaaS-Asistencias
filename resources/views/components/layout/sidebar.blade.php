{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion     Vista de Sidebar y Toggle móvil
 * @autor           Rubén Alejandro Nolasco Ruiz
 * @autorizador     Rubén Alejandro Nolasco Ruiz
 * @prueba          Diego Miguel Hernandez Fabela  
 * @mantenimiento   Ghael Garcia Manjarrez 
 * @version       0.1.0
 * @creado        11/04/2026
 * @modificado    07/05/2026
 *
 * @cambios
 * Fecha       | Autor             | Descripción
 * ------------|-------------------|------------------------------------------
 * 03/04/2026  | Rubén Alejandro   | Implementación inicial de Sidebar y Toggle móvil.
 * 11/04/2026  | Rubén Alejandro   | Ajuste de estructura de prólogo según manual GAMA-MPL-03.
 * 07/05/2026  | Claude Code       | Actualización de nav-items a módulos reales Proyecto B.
 */
--}}     
     
     
     <!-- Mobile Menu Toggle -->
      <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </button>

      <!-- Sidebar Overlay -->
      <div class="sidebar-overlay" id="sidebarOverlay"></div>

      <!-- Sidebar -->
      <aside class="sidebar" id="sidebar">
        <!-- Brand Header -->
        <div class="sidebar-brand">
          <div class="logo-icon">
            <img src="{{ asset('img/gama-logo.png') }}" alt="G.A.M.A Solutions">
          </div>
        </div>

        <!-- User Info -->
        <div class="sidebar-user">
          <div class="user-avatar">US</div>
          <div class="user-info">
            <span class="user-name">Usuario name</span>
            <span class="user-role">Administrador</span>
          </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
          <!-- Principal -->
          <div class="nav-section">
            <span class="nav-label">Principal</span>
            <a href="{{ route('dashboard') }}" class="nav-item active" data-tooltip="Dashboard">
              <i class="fas fa-home nav-icon"></i>
              <span class="nav-text">Dashboard</span>
            </a>
          </div>

          <!-- Módulos -->
          <div class="nav-section">
            <span class="nav-label">Módulos</span>
            <a href="{{ Route::has('instituciones.index') ? route('instituciones.index') : '#' }}" class="nav-item" data-tooltip="Instituciones">
              <i class="fas fa-building nav-icon"></i>
              <span class="nav-text">Instituciones</span>
            </a>
            
            <a href="{{ Route::has('membresias.index') ? route('membresias.index') : '#' }}" class="nav-item" data-tooltip="Membresías">
              <i class="fas fa-id-card nav-icon"></i>
              <span class="nav-text">Membresías</span>
            </a>
            
            <a href="{{ Route::has('aulas.index') ? route('aulas.index') : '#' }}" class="nav-item" data-tooltip="Aulas">
              <i class="fas fa-chalkboard nav-icon"></i>
              <span class="nav-text">Aulas</span>
            </a>
            <a href="{{ Route::has('asistencias.docente') ? route('asistencias.docente') : '#' }}" class="nav-item" data-tooltip="Asistencias">
              <i class="fas fa-clipboard-check nav-icon"></i>
              <span class="nav-text">Asistencias</span>
            </a>
            <a href="{{ Route::has('asistencias.alumno') ? route('asistencias.alumno') : '#' }}" class="nav-item" data-tooltip="Mi Asistencia">
              <i class="fas fa-user-check nav-icon"></i>
              <span class="nav-text">Mi Asistencia</span>
            </a>
            
            <a href="{{ Route::has('justificantes.index') ? route('justificantes.index') : '#' }}" class="nav-item" data-tooltip="Justificantes">
              <i class="fas fa-file-alt nav-icon"></i>
              <span class="nav-text">Justificantes</span>
            </a>
            <a href="{{ Route::has('reportes.index') ? route('reportes.index') : '#' }}" class="nav-item" data-tooltip="Reportes">
              <i class="fas fa-chart-bar nav-icon"></i>
              <span class="nav-text">Reportes</span>
            </a>
            
            <a href="{{ Route::has('ciclo.cierre') ? route('ciclo.cierre') : '#' }}" class="nav-item" data-tooltip="Cierre de Ciclo">
              <i class="fas fa-lock nav-icon"></i>
              <span class="nav-text">Cierre de Ciclo</span>
            </a>
            
            
            <a href="{{ Route::has('admin.edicion') ? route('admin.edicion') : '#' }}" class="nav-item" data-tooltip="Edición Admin">
              <i class="fas fa-user-edit nav-icon"></i>
              <span class="nav-text">Edición Admin</span>
            </a>
            
          </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
          <a href="#" class="nav-item" data-tooltip="Mi Perfil">
            <i class="fas fa-user-circle nav-icon"></i>
            <span class="nav-text">Mi Perfil</span>
          </a>
          <a
            href="{{ route('login') }}"
            class="nav-item logout"
            data-tooltip="Cerrar sesión"
          >
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Cerrar sesión</span>
          </a>
        </div>
      </aside>

      <script>
        // Mobile menu toggle
        const sidebar = document.getElementById("sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");
        const mobileMenuToggle = document.getElementById("mobileMenuToggle");

        mobileMenuToggle.addEventListener("click", () => {
          sidebar.classList.toggle("active");
          sidebarOverlay.classList.toggle("active");
          mobileMenuToggle.classList.toggle("active");
        });

        sidebarOverlay.addEventListener("click", () => {
          sidebar.classList.remove("active");
          sidebarOverlay.classList.remove("active");
          mobileMenuToggle.classList.remove("active");
        });
      </script>