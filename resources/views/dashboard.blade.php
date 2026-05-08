{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Vista principal del Dashboard con KPIs, gráficas y filtrado dinámico.
 * @autor          Rubén Alejandro Nolasco Ruiz
 * @autorizador    Rubén Alejandro Nolasco Ruiz
 * @prueba         Diego Miguel Hernandez Fabela  
 * @mantenimiento  Ghael Garcia Manjarrez 
 * @version        1.0.0
 * @creado         11/04/2026
 * @modificado     07/05/2026
 *
 * @cambios
 * Fecha       | Autor             | Descripción
 * ------------|-------------------|------------------------------------------
 * 11/04/2026  | Rubén Alejandro   | Implementación inicial de Dashboard: KPIs, Gráficas y Filtros.
 * 11/04/2026  | Rubén Alejandro   | Estandarización de prólogo según manual GAMA-MPL-03.
 * 07/05/2026  | Claude Code       | Actualización de nav-items a módulos reales Proyecto B.
 */
--}}

@extends('layouts.app')

@section('title', 'Dashboard - GAMA Solutions')

@section('content')

      <!-- Main Content -->
      <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
          <div class="header-content"> 
            <div class="header-text">
              <h1>PROYECTO B: Plataforma SaaS</h1>
              <h1>Dashboard</h1>
              <p>Resumen general del sistema</p>
            </div>
          </div>
        </div>

        <!-- KPI Cards -->
        <div class="kpi-grid">
          <div class="kpi-card">
            <div class="kpi-icon">
              <i class="fas fa-users"></i>
            </div>
            <div class="kpi-content">
              <span class="kpi-value">1,248</span>
              <span class="kpi-label">Total Registros</span>
            </div>
          </div>
          <div class="kpi-card">
            <div class="kpi-icon">
              <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="kpi-content">
              <span class="kpi-value">347</span>
              <span class="kpi-label">Activos</span>
            </div>
          </div>
          <div class="kpi-card">
            <div class="kpi-icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <div class="kpi-content">
              <span class="kpi-value">89</span>
              <span class="kpi-label">Procesados</span>
            </div>
          </div>
          <div class="kpi-card">
            <div class="kpi-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="kpi-content">
              <span class="kpi-value">24</span>
              <span class="kpi-label">Pendientes</span>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
          <!-- Line Chart -->
          <div class="card chart-card">
            <div class="card-header">
              <h3 class="card-title">Actividad Mensual</h3>
              <div class="card-actions">
                <select class="chart-select">
                  <option>Últimos 6 meses</option>
                  <option>Último año</option>
                  <option>Todo</option>
                </select>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-placeholder">
                <div class="chart-container">
                  <div class="chart-bars">
                    <div class="chart-bar" style="height: 60%"></div>
                    <div class="chart-bar" style="height: 80%"></div>
                    <div class="chart-bar" style="height: 45%"></div>
                    <div class="chart-bar" style="height: 90%"></div>
                    <div class="chart-bar" style="height: 70%"></div>
                    <div class="chart-bar" style="height: 85%"></div>
                  </div>
                  <div class="chart-labels">
                    <span>Ene</span>
                    <span>Feb</span>
                    <span>Mar</span>
                    <span>Abr</span>
                    <span>May</span>
                    <span>Jun</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="card chart-card">
            <div class="card-header">
              <h3 class="card-title">Distribución por Módulo</h3>
            </div>
            <div class="card-body">
              <div class="pie-chart-placeholder">
                <div class="pie-chart">
                  <div class="pie-segment segment-1"></div>
                  <div class="pie-segment segment-2"></div>
                  <div class="pie-segment segment-3"></div>
                  <div class="pie-segment segment-4"></div>
                </div>
                <div class="pie-legend">
                  <div class="legend-item">
                    <span
                      class="legend-color"
                      style="background: #134474"
                    ></span>
                    <span>Facturas (35%)</span>
                  </div>
                  <div class="legend-item">
                    <span
                      class="legend-color"
                      style="background: #1e5a8a"
                    ></span>
                    <span>Reportes (28%)</span>
                  </div>
                  <div class="legend-item">
                    <span
                      class="legend-color"
                      style="background: #3f7fb5"
                    ></span>
                    <span>Usuarios (22%)</span>
                  </div>
                  <div class="legend-item">
                    <span
                      class="legend-color"
                      style="background: #7dafd8"
                    ></span>
                    <span>Otros (15%)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Table Section -->
        <div class="card table-card">
          <div class="card-header">
            <h3 class="card-title">Registros Recientes</h3>
            <div class="card-actions">
              <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input
                  type="text"
                  class="search-input"
                  placeholder="Buscar registros..."
                  id="searchInput"
                />
              </div>
              <button class="btn btn-secondary btn-sm" id="toggleFilters">
                <i class="fas fa-filter"></i>
                <span>Filtros</span>
              </button>
              <button class="btn btn-secondary btn-sm">
                <i class="fas fa-download"></i>
                <span>Exportar</span>
              </button>
            </div>
          </div>

          <!-- Filters Panel -->
          <div class="filters-panel" id="filtersPanel">
            <div class="filters-grid">
              <div class="filter-group">
                <label class="filter-label">Módulo</label>
                <select class="filter-select" id="filterModulo">
                  <option value="">Todos los módulos</option>
                  <option value="Facturas">Facturas</option>
                  <option value="Reportes">Reportes</option>
                  <option value="Usuarios">Usuarios</option>
                  <option value="Inventario">Inventario</option>
                </select>
              </div>
              <div class="filter-group">
                <label class="filter-label">Estado</label>
                <select class="filter-select" id="filterEstado">
                  <option value="">Todos los estados</option>
                  <option value="Activo">Activo</option>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Inactivo">Inactivo</option>
                </select>
              </div>
              <div class="filter-group">
                <label class="filter-label">Fecha desde</label>
                <input type="date" class="filter-input" id="filterFechaDesde" />
              </div>
              <div class="filter-group">
                <label class="filter-label">Fecha hasta</label>
                <input type="date" class="filter-input" id="filterFechaHasta" />
              </div>
            </div>
            <div class="filters-actions">
              <button class="btn btn-outline btn-sm" id="clearFilters">
                <i class="fas fa-times"></i>
                <span>Limpiar</span>
              </button>
              <button class="btn btn-primary btn-sm" id="applyFilters">
                <i class="fas fa-check"></i>
                <span>Aplicar</span>
              </button>
            </div>
          </div>

          <div class="card-body">
            <!-- Active Filters Tags -->
            <div
              class="active-filters"
              id="activeFilters"
              style="display: none"
            >
              <span class="active-filters-label">Filtros activos:</span>
              <div class="filter-tags" id="filterTags"></div>
              <button class="clear-all-filters" id="clearAllFilters">
                Limpiar todos
              </button>
            </div>

            <div class="table-container">
              <table class="dynamic-table" id="dataTable">
                <thead>
                  <tr>
                    <th class="sortable" data-column="id">
                      ID
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th class="sortable" data-column="nombre">
                      Nombre
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th class="sortable" data-column="correo">
                      Correo Electrónico
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th class="sortable" data-column="modulo">
                      Módulo
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th class="sortable" data-column="estado">
                      Estado
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th class="sortable" data-column="fecha">
                      Fecha
                      <i class="fas fa-sort sort-icon"></i>
                    </th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#001</td>
                    <td>Carlos Martínez</td>
                    <td>carlos@empresa.com</td>
                    <td>Facturas</td>
                    <td><span class="status status-active">Activo</span></td>
                    <td>12/03/2026</td>
                    <td class="action-cell">
                      <button class="action-btn" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="action-btn" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="action-btn delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>#002</td>
                    <td>María García</td>
                    <td>maria@empresa.com</td>
                    <td>Reportes</td>
                    <td>
                      <span class="status status-pending">Pendiente</span>
                    </td>
                    <td>11/03/2026</td>
                    <td class="action-cell">
                      <button class="action-btn" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="action-btn" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="action-btn delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>#003</td>
                    <td>Roberto Sánchez</td>
                    <td>roberto@empresa.com</td>
                    <td>Usuarios</td>
                    <td><span class="status status-active">Activo</span></td>
                    <td>10/03/2026</td>
                    <td class="action-cell">
                      <button class="action-btn" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="action-btn" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="action-btn delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>#004</td>
                    <td>Ana López</td>
                    <td>ana@empresa.com</td>
                    <td>Inventario</td>
                    <td>
                      <span class="status status-inactive">Inactivo</span>
                    </td>
                    <td>09/03/2026</td>
                    <td class="action-cell">
                      <button class="action-btn" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="action-btn" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="action-btn delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>#005</td>
                    <td>Pedro Ramírez</td>
                    <td>pedro@empresa.com</td>
                    <td>Facturas</td>
                    <td><span class="status status-active">Activo</span></td>
                    <td>08/03/2026</td>
                    <td class="action-cell">
                      <button class="action-btn" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="action-btn" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="action-btn delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
              <button class="page-link disabled">
                <i class="fas fa-chevron-left"></i>
              </button>
              <button class="page-link active">1</button>
              <button class="page-link">2</button>
              <button class="page-link">3</button>
              <span class="page-ellipsis">...</span>
              <button class="page-link">10</button>
              <button class="page-link">
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>

      </main>
    </div>

    <!-- Modal Example -->
    <div class="modal-overlay" id="modalOverlay">
      <div class="modal modal-md">
        <div class="modal-header">
          <div>
            <h3 class="modal-title">Confirmar Acción</h3>
            <p class="modal-subtitle">¿Está seguro de que desea continuar?</p>
          </div>
          <button class="modal-close" onclick="closeModal()">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Esta acción no se puede deshacer. Por favor, confirme que desea
            proceder.
          </p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline btn-md" onclick="closeModal()">
            Cancelar
          </button>
          <button class="btn btn-primary btn-md">Confirmar</button>
        </div>
      </div>
    </div>

    <script>
      // Modal functions
      function openModal() {
        document.getElementById("modalOverlay").classList.add("active");
      }

      function closeModal() {
        document.getElementById("modalOverlay").classList.remove("active");
      }

      // Table row selection
      document.querySelectorAll(".dynamic-table tbody tr").forEach((row) => {
        row.addEventListener("click", (e) => {
          if (!e.target.closest(".action-btn")) {
            document
              .querySelectorAll(".dynamic-table tbody tr")
              .forEach((r) => r.classList.remove("selected"));
            row.classList.toggle("selected");
          }
        });
      });

      // Nav item active state
      document.querySelectorAll(".nav-item").forEach((item) => {
        item.addEventListener("click", (e) => {
          if (!item.classList.contains("logout")) {
            document
              .querySelectorAll(".nav-item")
              .forEach((i) => i.classList.remove("active"));
            item.classList.add("active");
          }
        });
      });

      // ========== FILTERS FUNCTIONALITY ==========
      const toggleFiltersBtn = document.getElementById("toggleFilters");
      const filtersPanel = document.getElementById("filtersPanel");
      const clearFiltersBtn = document.getElementById("clearFilters");
      const applyFiltersBtn = document.getElementById("applyFilters");
      const activeFiltersDiv = document.getElementById("activeFilters");
      const filterTagsDiv = document.getElementById("filterTags");
      const clearAllFiltersBtn = document.getElementById("clearAllFilters");
      const searchInput = document.getElementById("searchInput");

      // Toggle filters panel
      toggleFiltersBtn.addEventListener("click", () => {
        filtersPanel.classList.toggle("active");
        toggleFiltersBtn.classList.toggle("active");
      });

      // Clear all filter inputs
      function clearAllFilterInputs() {
        document.getElementById("filterModulo").value = "";
        document.getElementById("filterEstado").value = "";
        document.getElementById("filterFechaDesde").value = "";
        document.getElementById("filterFechaHasta").value = "";
        searchInput.value = "";
        activeFiltersDiv.style.display = "none";
        filterTagsDiv.innerHTML = "";
        // Show all rows
        document.querySelectorAll("#dataTable tbody tr").forEach((row) => {
          row.style.display = "";
        });
      }

      clearFiltersBtn.addEventListener("click", clearAllFilterInputs);
      clearAllFiltersBtn.addEventListener("click", clearAllFilterInputs);

      // Apply filters
      applyFiltersBtn.addEventListener("click", () => {
        const modulo = document.getElementById("filterModulo").value;
        const estado = document.getElementById("filterEstado").value;
        const fechaDesde = document.getElementById("filterFechaDesde").value;
        const fechaHasta = document.getElementById("filterFechaHasta").value;
        const searchTerm = searchInput.value.toLowerCase();

        // Update active filters tags
        filterTagsDiv.innerHTML = "";
        let hasActiveFilters = false;

        if (modulo) {
          addFilterTag("Módulo: " + modulo, "modulo");
          hasActiveFilters = true;
        }
        if (estado) {
          addFilterTag("Estado: " + estado, "estado");
          hasActiveFilters = true;
        }
        if (fechaDesde) {
          addFilterTag("Desde: " + fechaDesde, "fechaDesde");
          hasActiveFilters = true;
        }
        if (fechaHasta) {
          addFilterTag("Hasta: " + fechaHasta, "fechaHasta");
          hasActiveFilters = true;
        }
        if (searchTerm) {
          addFilterTag("Búsqueda: " + searchTerm, "search");
          hasActiveFilters = true;
        }

        activeFiltersDiv.style.display = hasActiveFilters ? "flex" : "none";

        // Filter table rows
        document.querySelectorAll("#dataTable tbody tr").forEach((row) => {
          const cells = row.querySelectorAll("td");
          const rowModulo = cells[3].textContent;
          const rowEstado = cells[4].textContent.trim();
          const rowText = row.textContent.toLowerCase();

          let showRow = true;

          if (modulo && rowModulo !== modulo) showRow = false;
          if (estado && !rowEstado.includes(estado)) showRow = false;
          if (searchTerm && !rowText.includes(searchTerm)) showRow = false;

          row.style.display = showRow ? "" : "none";
        });

        // Close filters panel after applying
        filtersPanel.classList.remove("active");
        toggleFiltersBtn.classList.remove("active");
      });

      // Add filter tag
      function addFilterTag(text, type) {
        const tag = document.createElement("span");
        tag.className = "filter-tag";
        tag.innerHTML = `${text} <button class="remove-tag" data-type="${type}"><i class="fas fa-times"></i></button>`;
        filterTagsDiv.appendChild(tag);

        tag.querySelector(".remove-tag").addEventListener("click", function () {
          const filterType = this.dataset.type;
          if (filterType === "modulo")
            document.getElementById("filterModulo").value = "";
          if (filterType === "estado")
            document.getElementById("filterEstado").value = "";
          if (filterType === "fechaDesde")
            document.getElementById("filterFechaDesde").value = "";
          if (filterType === "fechaHasta")
            document.getElementById("filterFechaHasta").value = "";
          if (filterType === "search") searchInput.value = "";
          applyFiltersBtn.click();
        });
      }

      // Real-time search
      searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.toLowerCase();
        document.querySelectorAll("#dataTable tbody tr").forEach((row) => {
          const rowText = row.textContent.toLowerCase();
          row.style.display = rowText.includes(searchTerm) ? "" : "none";
        });
      });

      // ========== SORTING FUNCTIONALITY ==========
      document.querySelectorAll(".sortable").forEach((header) => {
        header.addEventListener("click", () => {
          const column = header.dataset.column;
          const table = document.getElementById("dataTable");
          const tbody = table.querySelector("tbody");
          const rows = Array.from(tbody.querySelectorAll("tr"));
          const icon = header.querySelector(".sort-icon");

          // Reset all icons
          document.querySelectorAll(".sort-icon").forEach((i) => {
            i.classList.remove("fa-sort-up", "fa-sort-down");
            i.classList.add("fa-sort");
          });

          // Determine sort direction
          const isAsc = header.classList.contains("sort-asc");
          document
            .querySelectorAll(".sortable")
            .forEach((h) => h.classList.remove("sort-asc", "sort-desc"));

          if (isAsc) {
            header.classList.add("sort-desc");
            icon.classList.remove("fa-sort");
            icon.classList.add("fa-sort-down");
          } else {
            header.classList.add("sort-asc");
            icon.classList.remove("fa-sort");
            icon.classList.add("fa-sort-up");
          }

          // Sort rows
          const columnIndex = Array.from(header.parentElement.children).indexOf(
            header,
          );
          rows.sort((a, b) => {
            const aVal = a.children[columnIndex].textContent.trim();
            const bVal = b.children[columnIndex].textContent.trim();

            if (isAsc) {
              return bVal.localeCompare(aVal);
            }
            return aVal.localeCompare(bVal);
          });

          // Re-append sorted rows
          rows.forEach((row) => tbody.appendChild(row));
        });
      });
    </script>

@endsection
