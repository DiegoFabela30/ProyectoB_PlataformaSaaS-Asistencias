{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Cierre de Ciclo — Revisión final, validación
 *                 de condiciones y ejecución del cierre de aula (RF-11).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Cierre de Ciclo (RF-11).
 */
--}}

@extends('layouts.app')

@section('title', 'Cierre de Ciclo - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ciclo.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Cierre de Ciclo</h1>
                <p>Revisión final y cierre del aula — Matemáticas Grupo A</p>
            </div>
            <div class="header-actions">
                <span class="badge badge-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Acción irreversible
                </span>
            </div>
        </div>
    </div>

    {{-- ===================== BANNER ADVERTENCIA ===================== --}}
    <div class="warning-banner">
        <div class="warning-icon">
            <i class="fas fa-lock"></i>
        </div>
        <div class="warning-content">
            <h3 class="warning-title">¿Estás seguro de cerrar el ciclo?</h3>
            <p class="warning-desc">
                Una vez ejecutado el cierre, no podrán registrarse más asistencias ni modificarse los registros existentes.
                Todos los alumnos que no alcancen el mínimo requerido quedarán marcados como <strong>reprobados por inasistencia</strong>.
                Revisa cuidadosamente el resumen antes de continuar.
            </p>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">18</span>
                <span class="kpi-label">Sesiones realizadas</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-user-check"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">21</span>
                <span class="kpi-label">Alumnos aprobados</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--danger">
            <div class="kpi-icon"><i class="fas fa-user-times"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">4</span>
                <span class="kpi-label">Alumnos a reprobar</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">2</span>
                <span class="kpi-label">Justificantes pendientes</span>
            </div>
        </div>
    </div>

    {{-- ===================== CHECKLIST DE CONDICIONES ===================== --}}
    <div class="card card--checklist">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-clipboard-list"></i>
                Condiciones para el cierre
            </h3>
            <span class="badge badge-warning" id="badgeCondiciones">
                <i class="fas fa-times-circle"></i>
                1 condición pendiente
            </span>
        </div>
        <div class="card-body">
            <div class="checklist">

                <div class="checklist-item checklist-ok">
                    <div class="check-icon check-ok">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="check-content">
                        <span class="check-title">Todas las sesiones están cerradas</span>
                        <span class="check-desc">18 de 18 sesiones con registro cerrado</span>
                    </div>
                </div>

                <div class="checklist-item checklist-ok">
                    <div class="check-icon check-ok">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="check-content">
                        <span class="check-title">Asistencias calculadas correctamente</span>
                        <span class="check-desc">Todos los registros están validados</span>
                    </div>
                </div>

                <div class="checklist-item checklist-pending" id="condicionJustificantes">
                    <div class="check-icon check-pending">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="check-content">
                        <span class="check-title">Justificantes pendientes de resolución</span>
                        <span class="check-desc check-desc--warning">
                            Existen 2 justificantes sin dictaminar. Puedes cerrar el ciclo, pero quedarán como falta.
                        </span>
                    </div>
                    <button class="btn btn-outline btn-sm" onclick="window.location.href='#'">
                        <i class="fas fa-external-link-alt"></i>
                        Ir a justificantes
                    </button>
                </div>

                <div class="checklist-item checklist-ok">
                    <div class="check-icon check-ok">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="check-content">
                        <span class="check-title">No hay sesiones con clave activa</span>
                        <span class="check-desc">Ninguna sesión está actualmente abierta</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===================== RESUMEN POR ALUMNO ===================== --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users"></i>
                Resumen final por alumno
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar alumno..." id="buscarAlumno">
                </div>
                <select class="filter-select" id="filtroResultado">
                    <option value="">Todos</option>
                    <option value="aprobado">Aprobados</option>
                    <option value="reprobado">A reprobar</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-container">
                <table class="dynamic-table" id="tablaResumen">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                            <th>Asistencias</th>
                            <th>Faltas</th>
                            <th>Justificantes</th>
                            <th>% Final</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-resultado="aprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">CM</div>
                                    <span>Carlos Martínez</span>
                                </div>
                            </td>
                            <td>16</td>
                            <td>2</td>
                            <td>1</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-ok" style="width:88%"></div>
                                    <span class="pct-ok">88%</span>
                                </div>
                            </td>
                            <td><span class="status status-aprobado">Aprobado</span></td>
                        </tr>
                        <tr data-resultado="aprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">MG</div>
                                    <span>María García</span>
                                </div>
                            </td>
                            <td>17</td>
                            <td>1</td>
                            <td>0</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-ok" style="width:92%"></div>
                                    <span class="pct-ok">92%</span>
                                </div>
                            </td>
                            <td><span class="status status-aprobado">Aprobado</span></td>
                        </tr>
                        <tr data-resultado="reprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">RS</div>
                                    <span>Roberto Sánchez</span>
                                </div>
                            </td>
                            <td>13</td>
                            <td>5</td>
                            <td>0</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-warning" style="width:72%"></div>
                                    <span class="pct-warning">72%</span>
                                </div>
                            </td>
                            <td><span class="status status-reprobado">A reprobar</span></td>
                        </tr>
                        <tr data-resultado="reprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">AL</div>
                                    <span>Ana López</span>
                                </div>
                            </td>
                            <td>10</td>
                            <td>7</td>
                            <td>1</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-danger" style="width:55%"></div>
                                    <span class="pct-danger">55%</span>
                                </div>
                            </td>
                            <td><span class="status status-reprobado">A reprobar</span></td>
                        </tr>
                        <tr data-resultado="aprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">PR</div>
                                    <span>Pedro Ramírez</span>
                                </div>
                            </td>
                            <td>15</td>
                            <td>2</td>
                            <td>1</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-ok" style="width:85%"></div>
                                    <span class="pct-ok">85%</span>
                                </div>
                            </td>
                            <td><span class="status status-aprobado">Aprobado</span></td>
                        </tr>
                        <tr data-resultado="reprobado">
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">LT</div>
                                    <span>Laura Torres</span>
                                </div>
                            </td>
                            <td>14</td>
                            <td>4</td>
                            <td>0</td>
                            <td>
                                <div class="pct-cell">
                                    <div class="bar-mini bar-warning" style="width:78%"></div>
                                    <span class="pct-warning">78%</span>
                                </div>
                            </td>
                            <td><span class="status status-reprobado">A reprobar</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===================== BOTÓN CIERRE ===================== --}}
    <div class="cierre-footer">
        <div class="cierre-footer-info">
            <i class="fas fa-info-circle"></i>
            <span>Al confirmar el cierre se generará un reporte PDF final y se enviará a los alumnos afectados.</span>
        </div>
        <button class="btn btn-danger btn-lg" onclick="abrirModalCierre()">
            <i class="fas fa-lock"></i>
            Ejecutar cierre de ciclo
        </button>
    </div>

</div>

{{-- ===================== MODAL: CONFIRMAR CIERRE ===================== --}}
<div class="modal-overlay" id="modalCierre">
    <div class="modal modal-md">
        <div class="modal-header modal-header--danger">
            <div>
                <h3 class="modal-title">Confirmar cierre de ciclo</h3>
                <p class="modal-subtitle">Esta acción es irreversible</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalCierre')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="confirmacion-resumen">
                <div class="conf-item">
                    <span class="conf-label">Aula</span>
                    <span class="conf-value">Matemáticas — Grupo A</span>
                </div>
                <div class="conf-item">
                    <span class="conf-label">Ciclo</span>
                    <span class="conf-value">Enero – Junio 2026</span>
                </div>
                <div class="conf-item">
                    <span class="conf-label">Alumnos aprobados</span>
                    <span class="conf-value conf-ok">21</span>
                </div>
                <div class="conf-item">
                    <span class="conf-label">Alumnos reprobados</span>
                    <span class="conf-value conf-danger">4</span>
                </div>
                <div class="conf-item">
                    <span class="conf-label">Justificantes sin resolver</span>
                    <span class="conf-value conf-warning">2 (quedarán como falta)</span>
                </div>
            </div>

            <div class="confirmacion-input">
                <label class="form-label">
                    Escribe <strong>CERRAR</strong> para confirmar
                </label>
                <input type="text" class="form-input" id="inputConfirmacion"
                    placeholder="Escribe CERRAR aquí..."
                    oninput="validarConfirmacion()">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalCierre')">Cancelar</button>
            <button class="btn btn-danger btn-md" id="btnConfirmarCierre" disabled>
                <i class="fas fa-lock"></i>
                Confirmar cierre
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== BÚSQUEDA Y FILTRO ====================
    function filtrarTabla() {
        const texto     = document.getElementById('buscarAlumno').value.toLowerCase();
        const resultado = document.getElementById('filtroResultado').value;

        document.querySelectorAll('#tablaResumen tbody tr').forEach(tr => {
            const nombre   = tr.querySelector('.alumno-cell span').textContent.toLowerCase();
            const trResult = tr.dataset.resultado;
            const muestra  = (!texto || nombre.includes(texto)) && (!resultado || trResult === resultado);
            tr.style.display = muestra ? '' : 'none';
        });
    }

    document.getElementById('buscarAlumno').addEventListener('input', filtrarTabla);
    document.getElementById('filtroResultado').addEventListener('change', filtrarTabla);

    // ==================== MODAL ====================
    function abrirModalCierre() {
        document.getElementById('inputConfirmacion').value = '';
        document.getElementById('btnConfirmarCierre').disabled = true;
        document.getElementById('modalCierre').classList.add('active');
    }

    function cerrarModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    // Validar que se escriba exactamente "CERRAR"
    function validarConfirmacion() {
        const val = document.getElementById('inputConfirmacion').value.trim();
        document.getElementById('btnConfirmarCierre').disabled = val !== 'CERRAR';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') cerrarModal('modalCierre');
    });
</script>
@endpush

@endsection