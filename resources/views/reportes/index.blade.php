{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Reportes Analíticos — Matriz A/F/J por aula,
 *                 exportación y envío por correo (RF-10).
 * @autor          Rubén Alejandro Nolasco Ruiz
 * @autorizador    Rubén Alejandro Nolasco Ruiz
 * @prueba         Diego Miguel Hernandez Fabela
 * @mantenimiento  Ghael Garcia Manjarrez
 * @version        1.0.0
 * @creado         07/05/2026
 * @modificado     07/05/2026
 *
 * @cambios
 * Fecha       | Autor             | Descripción
 * ------------|-------------------|------------------------------------------
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Reportes (RF-10).
 */
--}}

@extends('layouts.app')

@section('title', 'Reportes - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reportes.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Reportes Analíticos</h1>
                <p>Matriz de asistencias por aula, alumno y periodo</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline btn-md" onclick="abrirModal('modalEnviar')">
                    <i class="fas fa-envelope"></i>
                    Enviar por correo
                </button>
                <button class="btn btn-primary btn-md" onclick="exportar()">
                    <i class="fas fa-download"></i>
                    Exportar reporte
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== FILTROS ===================== --}}
    <div class="card card--filtros">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i>
                Filtros del reporte
            </h3>
            <button class="btn-link" id="btnLimpiar" onclick="limpiarFiltros()">
                <i class="fas fa-times"></i> Limpiar
            </button>
        </div>
        <div class="card-body">
            <div class="filtros-grid">
                <div class="form-group">
                    <label class="form-label">Aula</label>
                    <select class="form-input" id="filtroAula">
                        <option value="">Todas las aulas</option>
                        <option value="1">Matemáticas — Grupo A</option>
                        <option value="2">Historia — Grupo B</option>
                        <option value="3">Física — Grupo C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Periodo desde</label>
                    <input type="date" class="form-input" id="filtroDesde" value="2026-04-01">
                </div>
                <div class="form-group">
                    <label class="form-label">Periodo hasta</label>
                    <input type="date" class="form-input" id="filtroHasta" value="2026-05-07">
                </div>
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select class="form-input" id="filtroEstado">
                        <option value="">Todos</option>
                        <option value="riesgo">En riesgo (&lt; 80%)</option>
                        <option value="aprobado">Aprobados (≥ 80%)</option>
                    </select>
                </div>
            </div>
            <div class="filtros-acciones">
                <button class="btn btn-primary btn-md" onclick="generarReporte()">
                    <i class="fas fa-chart-bar"></i>
                    Generar reporte
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-users"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">25</span>
                <span class="kpi-label">Total alumnos</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-chart-line"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">84%</span>
                <span class="kpi-label">Asistencia promedio</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">4</span>
                <span class="kpi-label">Alumnos en riesgo</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">18</span>
                <span class="kpi-label">Sesiones en periodo</span>
            </div>
        </div>
    </div>

    {{-- ===================== GRÁFICA + RESUMEN ===================== --}}
    <div class="charts-grid">

        {{-- Barras por alumno --}}
        <div class="card chart-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar"></i>
                    % Asistencia por alumno
                </h3>
            </div>
            <div class="card-body">
                <div class="bar-chart">
                    <div class="bar-item">
                        <span class="bar-name">Carlos M.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-ok" style="width:88%"></div>
                            <span class="bar-label-pct">88%</span>
                        </div>
                    </div>
                    <div class="bar-item">
                        <span class="bar-name">María G.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-ok" style="width:92%"></div>
                            <span class="bar-label-pct">92%</span>
                        </div>
                    </div>
                    <div class="bar-item">
                        <span class="bar-name">Roberto S.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-warning" style="width:72%"></div>
                            <span class="bar-label-pct">72%</span>
                        </div>
                    </div>
                    <div class="bar-item">
                        <span class="bar-name">Ana L.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-danger" style="width:55%"></div>
                            <span class="bar-label-pct">55%</span>
                        </div>
                    </div>
                    <div class="bar-item">
                        <span class="bar-name">Pedro R.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-ok" style="width:85%"></div>
                            <span class="bar-label-pct">85%</span>
                        </div>
                    </div>
                    <div class="bar-item">
                        <span class="bar-name">Laura T.</span>
                        <div class="bar-track">
                            <div class="bar-fill bar-warning" style="width:78%"></div>
                            <span class="bar-label-pct">78%</span>
                        </div>
                    </div>
                </div>
                <div class="chart-leyenda">
                    <span class="leyenda-item"><span class="dot dot-ok"></span>≥ 80% aprobado</span>
                    <span class="leyenda-item"><span class="dot dot-warning"></span>70–79% en riesgo</span>
                    <span class="leyenda-item"><span class="dot dot-danger"></span>&lt; 70% crítico</span>
                    <span class="leyenda-item leyenda-meta"><span class="dot dot-meta"></span>Meta 80%</span>
                </div>
            </div>
        </div>

        {{-- Distribución A/F/J --}}
        <div class="card chart-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    Distribución A / F / J
                </h3>
            </div>
            <div class="card-body">
                <div class="donut-wrapper">
                    <div class="donut">
                        <svg viewBox="0 0 120 120" class="donut-svg">
                            <circle class="donut-ring" cx="60" cy="60" r="45"/>
                            {{-- A: 75% --}}
                            <circle class="donut-seg seg-a" cx="60" cy="60" r="45"
                                stroke-dasharray="212 283"
                                stroke-dashoffset="0"/>
                            {{-- F: 15% --}}
                            <circle class="donut-seg seg-f" cx="60" cy="60" r="45"
                                stroke-dasharray="42 283"
                                stroke-dashoffset="-212"/>
                            {{-- J: 10% --}}
                            <circle class="donut-seg seg-j" cx="60" cy="60" r="45"
                                stroke-dasharray="28 283"
                                stroke-dashoffset="-254"/>
                        </svg>
                        <div class="donut-centro">
                            <span class="donut-pct">84%</span>
                            <span class="donut-sub">promedio</span>
                        </div>
                    </div>
                    <div class="donut-leyenda">
                        <div class="donut-leyenda-item">
                            <span class="dl-dot dl-dot--a"></span>
                            <span class="dl-label">Asistencias</span>
                            <span class="dl-val">75%</span>
                        </div>
                        <div class="donut-leyenda-item">
                            <span class="dl-dot dl-dot--f"></span>
                            <span class="dl-label">Faltas</span>
                            <span class="dl-val">15%</span>
                        </div>
                        <div class="donut-leyenda-item">
                            <span class="dl-dot dl-dot--j"></span>
                            <span class="dl-label">Justificantes</span>
                            <span class="dl-val">10%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== MATRIZ A/F/J ===================== --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-table"></i>
                Matriz de Asistencias — Matemáticas Grupo A
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar alumno..." id="buscarMatriz">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tabla-matriz-wrapper">
                <table class="tabla-matriz" id="tablaMatriz">
                    <thead>
                        <tr>
                            <th class="col-alumno">Alumno</th>
                            <th class="col-sesion" title="07/04/2026">S1</th>
                            <th class="col-sesion" title="09/04/2026">S2</th>
                            <th class="col-sesion" title="14/04/2026">S3</th>
                            <th class="col-sesion" title="16/04/2026">S4</th>
                            <th class="col-sesion" title="21/04/2026">S5</th>
                            <th class="col-sesion" title="23/04/2026">S6</th>
                            <th class="col-sesion" title="28/04/2026">S7</th>
                            <th class="col-sesion" title="30/04/2026">S8</th>
                            <th class="col-sesion" title="05/05/2026">S9</th>
                            <th class="col-total">Total A</th>
                            <th class="col-total">% Asist.</th>
                            <th class="col-estado">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">CM</div>
                                    <span>Carlos Martínez</span>
                                </div>
                            </td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-j">J</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td class="col-total">7</td>
                            <td class="col-total pct-ok">88%</td>
                            <td><span class="status status-ok">Aprobado</span></td>
                        </tr>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">MG</div>
                                    <span>María García</span>
                                </div>
                            </td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td class="col-total">8</td>
                            <td class="col-total pct-ok">92%</td>
                            <td><span class="status status-ok">Aprobado</span></td>
                        </tr>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">RS</div>
                                    <span>Roberto Sánchez</span>
                                </div>
                            </td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td class="col-total">4</td>
                            <td class="col-total pct-warning">72%</td>
                            <td><span class="status status-warning">En riesgo</span></td>
                        </tr>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">AL</div>
                                    <span>Ana López</span>
                                </div>
                            </td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-j">J</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td class="col-total">2</td>
                            <td class="col-total pct-danger">55%</td>
                            <td><span class="status status-danger">Crítico</span></td>
                        </tr>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">PR</div>
                                    <span>Pedro Ramírez</span>
                                </div>
                            </td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td class="col-total">7</td>
                            <td class="col-total pct-ok">85%</td>
                            <td><span class="status status-ok">Aprobado</span></td>
                        </tr>
                        <tr>
                            <td class="col-alumno">
                                <div class="alumno-cell">
                                    <div class="avatar-sm">LT</div>
                                    <span>Laura Torres</span>
                                </div>
                            </td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-f">F</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td><span class="celda-j">J</span></td>
                            <td><span class="celda-a">A</span></td>
                            <td class="col-total">6</td>
                            <td class="col-total pct-warning">78%</td>
                            <td><span class="status status-warning">En riesgo</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Leyenda matriz --}}
            <div class="matriz-leyenda">
                <span class="celda-a">A</span> Asistencia &nbsp;
                <span class="celda-f">F</span> Falta &nbsp;
                <span class="celda-j">J</span> Justificante
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL: ENVIAR POR CORREO ===================== --}}
<div class="modal-overlay" id="modalEnviar">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Enviar reporte por correo</h3>
                <p class="modal-subtitle">Se enviará el reporte actual en formato PDF</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalEnviar')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Destinatario(s) <span class="required">*</span></label>
                <input type="email" class="form-input" placeholder="correo@ejemplo.com">
                <p class="form-hint">Separa varios correos con coma</p>
            </div>
            <div class="form-group">
                <label class="form-label">Asunto</label>
                <input type="text" class="form-input" value="Reporte de asistencias — Matemáticas Grupo A — Mayo 2026">
            </div>
            <div class="form-group">
                <label class="form-label">Mensaje adicional</label>
                <textarea class="form-textarea" rows="3" placeholder="Mensaje opcional..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalEnviar')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-paper-plane"></i>
                Enviar
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== BÚSQUEDA MATRIZ ====================
    document.getElementById('buscarMatriz').addEventListener('input', function () {
        const texto = this.value.toLowerCase();
        document.querySelectorAll('#tablaMatriz tbody tr').forEach(tr => {
            const nombre = tr.querySelector('.alumno-cell span').textContent.toLowerCase();
            tr.style.display = nombre.includes(texto) ? '' : 'none';
        });
    });

    // ==================== GENERAR REPORTE (placeholder) ====================
    function generarReporte() {
        const btn = document.querySelector('.filtros-acciones .btn-primary');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando...';
        btn.disabled  = true;
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-chart-bar"></i> Generar reporte';
            btn.disabled  = false;
        }, 1500);
    }

    // ==================== EXPORTAR (placeholder) ====================
    function exportar() {
        const btn = document.querySelector('.header-actions .btn-primary');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exportando...';
        btn.disabled  = true;
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-download"></i> Exportar reporte';
            btn.disabled  = false;
        }, 1200);
    }

    // ==================== LIMPIAR FILTROS ====================
    function limpiarFiltros() {
        document.getElementById('filtroAula').value   = '';
        document.getElementById('filtroEstado').value = '';
        document.getElementById('filtroDesde').value  = '';
        document.getElementById('filtroHasta').value  = '';
    }

    // ==================== MODAL ====================
    function abrirModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function cerrarModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') cerrarModal('modalEnviar');
    });
</script>
@endpush

@endsection