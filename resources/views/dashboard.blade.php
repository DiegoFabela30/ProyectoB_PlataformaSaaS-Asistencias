{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Vista principal del Dashboard — Resumen de asistencias,
 *                 KPIs del sistema, actividad reciente y accesos rápidos.
 *                 Proyecto B: Control de Asistencias.
 * @autor          Rubén Alejandro Nolasco Ruiz
 * @autorizador    Rubén Alejandro Nolasco Ruiz
 * @prueba         Diego Miguel Hernandez Fabela
 * @mantenimiento  Ghael Garcia Manjarrez
 * @version        1.1.0
 * @creado         11/04/2026
 * @modificado     07/05/2026
 *
 * @cambios
 * Fecha       | Autor             | Descripción
 * ------------|-------------------|------------------------------------------
 * 11/04/2026  | Rubén Alejandro   | Implementación inicial de Dashboard: KPIs, Gráficas y Filtros.
 * 11/04/2026  | Rubén Alejandro   | Estandarización de prólogo según manual GAMA-MPL-03.
 * 07/05/2026  | Claude Code       | Actualización de nav-items a módulos reales Proyecto B.
 * 07/05/2026  | Claude Web        | Adaptación completa al dominio de Control de Asistencias.
 */
--}}

@extends('layouts.app')

@section('title', 'Dashboard - GAMA Solutions')

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Dashboard</h1>
                <p>PROYECTO B: Control de Asistencias &nbsp;·&nbsp; Resumen general del sistema</p>
            </div>
        </div>
        <div class="header-actions">
            <span class="header-date">
                <i class="fas fa-calendar-alt"></i>
                <span id="fechaHoy"></span>
            </span>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="fas fa-chalkboard"></i>
            </div>
            <div class="kpi-content">
                <span class="kpi-value">24</span>
                <span class="kpi-label">Aulas activas</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="kpi-content">
                <span class="kpi-value">84%</span>
                <span class="kpi-label">Asistencia promedio</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="kpi-content">
                <span class="kpi-value">12</span>
                <span class="kpi-label">Alumnos en riesgo</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--orange">
            <div class="kpi-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="kpi-content">
                <span class="kpi-value">7</span>
                <span class="kpi-label">Justificantes pendientes</span>
            </div>
        </div>
    </div>

    {{-- ===================== CHARTS GRID ===================== --}}
    <div class="charts-grid">

        {{-- Asistencia mensual --}}
        <div class="card chart-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar"></i>
                    Asistencia mensual (%)
                </h3>
                <div class="card-actions">
                    <select class="chart-select">
                        <option>Últimos 6 meses</option>
                        <option>Último año</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-placeholder">
                    <div class="chart-container">
                        <div class="chart-bars">
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">81%</span>
                                <div class="chart-bar" style="height:81%"></div>
                            </div>
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">78%</span>
                                <div class="chart-bar chart-bar--warning" style="height:78%"></div>
                            </div>
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">85%</span>
                                <div class="chart-bar" style="height:85%"></div>
                            </div>
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">90%</span>
                                <div class="chart-bar chart-bar--ok" style="height:90%"></div>
                            </div>
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">83%</span>
                                <div class="chart-bar" style="height:83%"></div>
                            </div>
                            <div class="chart-bar-wrapper">
                                <span class="chart-bar-pct">84%</span>
                                <div class="chart-bar" style="height:84%"></div>
                            </div>
                        </div>
                        <div class="chart-meta-line" title="Meta mínima 80%"></div>
                        <div class="chart-labels">
                            <span>Dic</span>
                            <span>Ene</span>
                            <span>Feb</span>
                            <span>Mar</span>
                            <span>Abr</span>
                            <span>May</span>
                        </div>
                    </div>
                </div>
                <div class="chart-leyenda">
                    <span class="leyenda-item"><span class="dot dot-blue"></span>Asistencia</span>
                    <span class="leyenda-item"><span class="dot dot-warning"></span>Por debajo de meta</span>
                    <span class="leyenda-item leyenda-meta"><span class="dot dot-meta"></span>Meta 80%</span>
                </div>
            </div>
        </div>

        {{-- Distribución A/F/J --}}
        <div class="card chart-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Distribución A / F / J (global)
                </h3>
            </div>
            <div class="card-body">
                <div class="pie-chart-placeholder">
                    <div class="pie-donut">
                        <svg viewBox="0 0 120 120" class="donut-svg">
                            <circle class="donut-ring" cx="60" cy="60" r="45"/>
                            <circle class="donut-seg seg-a" cx="60" cy="60" r="45"
                                stroke-dasharray="212 283" stroke-dashoffset="0"/>
                            <circle class="donut-seg seg-f" cx="60" cy="60" r="45"
                                stroke-dasharray="57 283" stroke-dashoffset="-212"/>
                            <circle class="donut-seg seg-j" cx="60" cy="60" r="45"
                                stroke-dasharray="14 283" stroke-dashoffset="-269"/>
                        </svg>
                        <div class="donut-centro">
                            <span class="donut-pct">75%</span>
                            <span class="donut-sub">asist.</span>
                        </div>
                    </div>
                    <div class="pie-legend">
                        <div class="legend-item">
                            <span class="legend-color" style="background:#28A745"></span>
                            <span>Asistencias (75%)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#DC3545"></span>
                            <span>Faltas (20%)</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#F28B2C"></span>
                            <span>Justificantes (5%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== PANEL: ACCESOS RÁPIDOS + ALERTAS ===================== --}}
    <div class="panel-grid">

        {{-- Accesos rápidos --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Accesos rápidos
                </h3>
            </div>
            <div class="card-body accesos-body">
                <a href="#" class="acceso-btn">
                    <div class="acceso-icon"><i class="fas fa-key"></i></div>
                    <div class="acceso-text">
                        <span class="acceso-nombre">Nueva sesión</span>
                        <span class="acceso-desc">Generar clave de asistencia</span>
                    </div>
                    <i class="fas fa-chevron-right acceso-arrow"></i>
                </a>
                <a href="#" class="acceso-btn">
                    <div class="acceso-icon acceso-icon--b"><i class="fas fa-file-alt"></i></div>
                    <div class="acceso-text">
                        <span class="acceso-nombre">Justificantes</span>
                        <span class="acceso-desc">7 pendientes de dictaminar</span>
                    </div>
                    <i class="fas fa-chevron-right acceso-arrow"></i>
                </a>
                <a href="#" class="acceso-btn">
                    <div class="acceso-icon acceso-icon--c"><i class="fas fa-chart-bar"></i></div>
                    <div class="acceso-text">
                        <span class="acceso-nombre">Reportes</span>
                        <span class="acceso-desc">Generar y exportar matrices</span>
                    </div>
                    <i class="fas fa-chevron-right acceso-arrow"></i>
                </a>
                <a href="#" class="acceso-btn">
                    <div class="acceso-icon acceso-icon--d"><i class="fas fa-plus"></i></div>
                    <div class="acceso-text">
                        <span class="acceso-nombre">Nueva aula</span>
                        <span class="acceso-desc">Crear y generar código</span>
                    </div>
                    <i class="fas fa-chevron-right acceso-arrow"></i>
                </a>
            </div>
        </div>

        {{-- Alertas del sistema --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bell"></i>
                    Alertas del sistema
                </h3>
                <span class="badge-num-header">4</span>
            </div>
            <div class="card-body alertas-body">
                <div class="alerta alerta--danger">
                    <div class="alerta-icon"><i class="fas fa-user-times"></i></div>
                    <div class="alerta-content">
                        <span class="alerta-titulo">Ana López — Asistencia crítica</span>
                        <span class="alerta-desc">55% — Por debajo del mínimo requerido (80%)</span>
                    </div>
                    <span class="alerta-aula">MAT-A</span>
                </div>
                <div class="alerta alerta--danger">
                    <div class="alerta-icon"><i class="fas fa-user-times"></i></div>
                    <div class="alerta-content">
                        <span class="alerta-titulo">Roberto Sánchez — En riesgo</span>
                        <span class="alerta-desc">72% — 2 faltas más y reprueba por inasistencia</span>
                    </div>
                    <span class="alerta-aula">MAT-A</span>
                </div>
                <div class="alerta alerta--warning">
                    <div class="alerta-icon"><i class="fas fa-hourglass-half"></i></div>
                    <div class="alerta-content">
                        <span class="alerta-titulo">3 justificantes sin dictaminar</span>
                        <span class="alerta-desc">Llevan más de 5 días sin resolución</span>
                    </div>
                    <span class="alerta-aula">Global</span>
                </div>
                <div class="alerta alerta--info">
                    <div class="alerta-icon"><i class="fas fa-id-card"></i></div>
                    <div class="alerta-content">
                        <span class="alerta-titulo">Membresía por vencer</span>
                        <span class="alerta-desc">CECyTE Plantel 5 — vence en 15 días</span>
                    </div>
                    <span class="alerta-aula">Admin</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== TABLA: ACTIVIDAD RECIENTE ===================== --}}
    <div class="card table-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-history"></i>
                Actividad reciente
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input"
                        placeholder="Buscar alumno o aula..."
                        id="searchInput">
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

        {{-- Filters Panel --}}
        <div class="filters-panel" id="filtersPanel">
            <div class="filters-grid">
                <div class="filter-group">
                    <label class="filter-label">Aula</label>
                    <select class="filter-select" id="filterModulo">
                        <option value="">Todas las aulas</option>
                        <option value="Matemáticas">Matemáticas — Grupo A</option>
                        <option value="Historia">Historia — Grupo B</option>
                        <option value="Física">Física — Grupo C</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Estado</label>
                    <select class="filter-select" id="filterEstado">
                        <option value="">Todos</option>
                        <option value="Asistencia">Asistencia</option>
                        <option value="Falta">Falta</option>
                        <option value="Justificante">Justificante</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fecha desde</label>
                    <input type="date" class="filter-input" id="filterFechaDesde">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fecha hasta</label>
                    <input type="date" class="filter-input" id="filterFechaHasta">
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
            {{-- Active Filters Tags --}}
            <div class="active-filters" id="activeFilters" style="display:none">
                <span class="active-filters-label">Filtros activos:</span>
                <div class="filter-tags" id="filterTags"></div>
                <button class="clear-all-filters" id="clearAllFilters">Limpiar todos</button>
            </div>

            <div class="table-container">
                <table class="dynamic-table" id="dataTable">
                    <thead>
                        <tr>
                            <th class="sortable" data-column="alumno">
                                Alumno <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-column="aula">
                                Aula <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-column="sesion">
                                Sesión <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-column="estado">
                                Estado <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-column="asistencia">
                                % Asistencia <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-column="fecha">
                                Fecha <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">CM</div>
                                    <span>Carlos Martínez</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>S18</td>
                            <td><span class="status status-active">Asistencia</span></td>
                            <td><span class="pct-ok">88%</span></td>
                            <td>05/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">MG</div>
                                    <span>María García</span>
                                </div>
                            </td>
                            <td>Historia — Grupo B</td>
                            <td>S16</td>
                            <td><span class="status status-active">Asistencia</span></td>
                            <td><span class="pct-ok">92%</span></td>
                            <td>05/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">RS</div>
                                    <span>Roberto Sánchez</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>S18</td>
                            <td><span class="status status-pending">Falta</span></td>
                            <td><span class="pct-warning">72%</span></td>
                            <td>05/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">AL</div>
                                    <span>Ana López</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>S18</td>
                            <td><span class="status status-inactive">Falta</span></td>
                            <td><span class="pct-danger">55%</span></td>
                            <td>05/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">LT</div>
                                    <span>Laura Torres</span>
                                </div>
                            </td>
                            <td>Física — Grupo C</td>
                            <td>S14</td>
                            <td><span class="status status-justified">Justificante</span></td>
                            <td><span class="pct-warning">78%</span></td>
                            <td>02/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">PR</div>
                                    <span>Pedro Ramírez</span>
                                </div>
                            </td>
                            <td>Historia — Grupo B</td>
                            <td>S16</td>
                            <td><span class="status status-active">Asistencia</span></td>
                            <td><span class="pct-ok">85%</span></td>
                            <td>05/05/2026</td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination">
                <button class="page-link disabled"><i class="fas fa-chevron-left"></i></button>
                <button class="page-link active">1</button>
                <button class="page-link">2</button>
                <button class="page-link">3</button>
                <span class="page-ellipsis">...</span>
                <button class="page-link">10</button>
                <button class="page-link"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL ===================== --}}
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
            <p>Esta acción no se puede deshacer. Por favor confirme que desea proceder.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="closeModal()">Cancelar</button>
            <button class="btn btn-primary btn-md">Confirmar</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== FECHA HOY ====================
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('fechaHoy').textContent =
        new Date().toLocaleDateString('es-MX', opciones);

    // ==================== MODAL ====================
    function openModal() { document.getElementById('modalOverlay').classList.add('active'); }
    function closeModal() { document.getElementById('modalOverlay').classList.remove('active'); }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

    // ==================== FILTERS ====================
    const toggleFiltersBtn  = document.getElementById('toggleFilters');
    const filtersPanel      = document.getElementById('filtersPanel');
    const clearFiltersBtn   = document.getElementById('clearFilters');
    const applyFiltersBtn   = document.getElementById('applyFilters');
    const activeFiltersDiv  = document.getElementById('activeFilters');
    const filterTagsDiv     = document.getElementById('filterTags');
    const clearAllFiltersBtn = document.getElementById('clearAllFilters');
    const searchInput       = document.getElementById('searchInput');

    toggleFiltersBtn.addEventListener('click', () => {
        filtersPanel.classList.toggle('active');
        toggleFiltersBtn.classList.toggle('active');
    });

    function clearAllFilterInputs() {
        document.getElementById('filterModulo').value    = '';
        document.getElementById('filterEstado').value    = '';
        document.getElementById('filterFechaDesde').value = '';
        document.getElementById('filterFechaHasta').value = '';
        searchInput.value = '';
        activeFiltersDiv.style.display = 'none';
        filterTagsDiv.innerHTML = '';
        document.querySelectorAll('#dataTable tbody tr').forEach(r => r.style.display = '');
    }

    clearFiltersBtn.addEventListener('click', clearAllFilterInputs);
    clearAllFiltersBtn.addEventListener('click', clearAllFilterInputs);

    applyFiltersBtn.addEventListener('click', () => {
        const modulo     = document.getElementById('filterModulo').value;
        const estado     = document.getElementById('filterEstado').value;
        const fechaDesde = document.getElementById('filterFechaDesde').value;
        const fechaHasta = document.getElementById('filterFechaHasta').value;
        const searchTerm = searchInput.value.toLowerCase();

        filterTagsDiv.innerHTML = '';
        let hasActive = false;

        if (modulo)     { addFilterTag('Aula: ' + modulo, 'modulo');         hasActive = true; }
        if (estado)     { addFilterTag('Estado: ' + estado, 'estado');        hasActive = true; }
        if (fechaDesde) { addFilterTag('Desde: ' + fechaDesde, 'fechaDesde'); hasActive = true; }
        if (fechaHasta) { addFilterTag('Hasta: ' + fechaHasta, 'fechaHasta'); hasActive = true; }
        if (searchTerm) { addFilterTag('Búsqueda: ' + searchTerm, 'search');  hasActive = true; }

        activeFiltersDiv.style.display = hasActive ? 'flex' : 'none';

        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
            const cells    = row.querySelectorAll('td');
            const rowAula  = cells[1].textContent;
            const rowEst   = cells[3].textContent.trim();
            const rowText  = row.textContent.toLowerCase();
            let show = true;
            if (modulo     && !rowAula.includes(modulo))   show = false;
            if (estado     && !rowEst.includes(estado))    show = false;
            if (searchTerm && !rowText.includes(searchTerm)) show = false;
            row.style.display = show ? '' : 'none';
        });

        filtersPanel.classList.remove('active');
        toggleFiltersBtn.classList.remove('active');
    });

    function addFilterTag(text, type) {
        const tag = document.createElement('span');
        tag.className = 'filter-tag';
        tag.innerHTML = `${text} <button class="remove-tag" data-type="${type}"><i class="fas fa-times"></i></button>`;
        filterTagsDiv.appendChild(tag);
        tag.querySelector('.remove-tag').addEventListener('click', function () {
            const t = this.dataset.type;
            if (t === 'modulo')     document.getElementById('filterModulo').value    = '';
            if (t === 'estado')     document.getElementById('filterEstado').value    = '';
            if (t === 'fechaDesde') document.getElementById('filterFechaDesde').value = '';
            if (t === 'fechaHasta') document.getElementById('filterFechaHasta').value = '';
            if (t === 'search')     searchInput.value = '';
            applyFiltersBtn.click();
        });
    }

    searchInput.addEventListener('input', () => {
        const t = searchInput.value.toLowerCase();
        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(t) ? '' : 'none';
        });
    });

    // ==================== SORTING ====================
    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', () => {
            const tbody = document.querySelector('#dataTable tbody');
            const rows  = Array.from(tbody.querySelectorAll('tr'));
            const icon  = header.querySelector('.sort-icon');
            const isAsc = header.classList.contains('sort-asc');

            document.querySelectorAll('.sort-icon').forEach(i => {
                i.classList.remove('fa-sort-up', 'fa-sort-down'); i.classList.add('fa-sort');
            });
            document.querySelectorAll('.sortable').forEach(h => h.classList.remove('sort-asc', 'sort-desc'));

            if (isAsc) {
                header.classList.add('sort-desc');
                icon.classList.replace('fa-sort', 'fa-sort-down');
            } else {
                header.classList.add('sort-asc');
                icon.classList.replace('fa-sort', 'fa-sort-up');
            }

            const idx = Array.from(header.parentElement.children).indexOf(header);
            rows.sort((a, b) => {
                const av = a.children[idx].textContent.trim();
                const bv = b.children[idx].textContent.trim();
                return isAsc ? bv.localeCompare(av) : av.localeCompare(bv);
            });
            rows.forEach(r => tbody.appendChild(r));
        });
    });
</script>
@endpush

@endsection