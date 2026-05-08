{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Edición Administrativa — Corrección de asistencias,
 *                 baja de alumnos y eliminación de clases/sesiones (RF-14).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial de Edición Administrativa (RF-14).
 */
--}}

@extends('layouts.app')

@section('title', 'Edición Administrativa - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-edicion.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Edición Administrativa</h1>
                <p>Corrección de asistencias, baja de alumnos y gestión de sesiones</p>
            </div>
            <div class="header-actions">
                {{-- Badge de advertencia RF-14: solo ciclos abiertos --}}
                <span class="badge badge-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Solo ciclos activos
                </span>
            </div>
        </div>
    </div>

    {{-- ===================== ALERTS ===================== --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-times-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- ===================== TABS DE MÓDULO ===================== --}}
    <div class="admin-tabs">
        <button class="admin-tab active" data-tab="asistencias">
            <i class="fas fa-clipboard-check"></i>
            Corrección de Asistencias
        </button>
        <button class="admin-tab" data-tab="alumnos">
            <i class="fas fa-user-times"></i>
            Baja de Alumnos
        </button>
        <button class="admin-tab" data-tab="sesiones">
            <i class="fas fa-calendar-times"></i>
            Eliminar Clase / Sesión
        </button>
    </div>

    {{-- ==================== TAB 1: CORRECCIÓN DE ASISTENCIAS (RF-14) ==================== --}}
    <div class="tab-panel active" id="tab-asistencias">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clipboard-check"></i>
                    Corrección de Estado de Asistencia
                </h3>
                <div class="card-actions">
                    {{-- Filtro por aula --}}
                    <select class="filter-select" id="filtroAulaAsistencias">
                        <option value="">Seleccionar aula...</option>
                        {{-- @foreach($aulas as $aula) --}}
                        {{-- <option value="{{ $aula->id }}">{{ $aula->nombre }}</option> --}}
                        {{-- @endforeach --}}
                        <option value="1">Matemáticas — Grupo A</option>
                        <option value="2">Historia — Grupo B</option>
                    </select>
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Buscar alumno..." id="buscarAlumnoAsistencias">
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{-- INFO RF-14: audit log --}}
                <div class="info-banner">
                    <i class="fas fa-info-circle"></i>
                    Toda corrección queda registrada en el log de auditoría con usuario, fecha y hora.
                </div>

                <div class="table-container">
                    <table class="dynamic-table" id="tablaAsistencias">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Fecha de Sesión</th>
                                <th>Estado Actual</th>
                                <th>Corregir a</th>
                                <th>Motivo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @forelse($registros as $registro) --}}
                            <tr>
                                <td>
                                    <div class="alumno-cell">
                                        <div class="avatar-sm">CM</div>
                                        <span>Carlos Martínez</span>
                                    </div>
                                </td>
                                <td>05/05/2026</td>
                                <td><span class="status status-absent">Falta</span></td>
                                <td>
                                    <select class="input-select estado-correcto" data-id="1">
                                        <option value="A">Asistencia</option>
                                        <option value="F" selected>Falta</option>
                                        <option value="J">Justificante</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="input-text motivo-input" placeholder="Motivo de corrección..." data-id="1">
                                </td>
                                <td class="action-cell">
                                    <button class="btn btn-primary btn-sm btn-guardar-asistencia" data-id="1"
                                        onclick="confirmarCorreccion(1, 'Carlos Martínez')">
                                        <i class="fas fa-save"></i>
                                        Guardar
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
                                <td>05/05/2026</td>
                                <td><span class="status status-active">Asistencia</span></td>
                                <td>
                                    <select class="input-select estado-correcto" data-id="2">
                                        <option value="A" selected>Asistencia</option>
                                        <option value="F">Falta</option>
                                        <option value="J">Justificante</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="input-text motivo-input" placeholder="Motivo de corrección..." data-id="2">
                                </td>
                                <td class="action-cell">
                                    <button class="btn btn-primary btn-sm btn-guardar-asistencia" data-id="2"
                                        onclick="confirmarCorreccion(2, 'María García')">
                                        <i class="fas fa-save"></i>
                                        Guardar
                                    </button>
                                </td>
                            </tr>
                            {{-- @empty --}}
                            {{-- <tr><td colspan="6" class="empty-state">Selecciona un aula para ver registros.</td></tr> --}}
                            {{-- @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== TAB 2: BAJA DE ALUMNOS (RF-14) ==================== --}}
    <div class="tab-panel" id="tab-alumnos">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-times"></i>
                    Baja Administrativa de Alumno
                </h3>
                <div class="card-actions">
                    <select class="filter-select" id="filtroAulaAlumnos">
                        <option value="">Seleccionar aula...</option>
                        <option value="1">Matemáticas — Grupo A</option>
                        <option value="2">Historia — Grupo B</option>
                    </select>
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Buscar alumno...">
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{-- WARNING RF-14: no baja si tiene justificantes pendientes --}}
                <div class="warning-banner">
                    <i class="fas fa-exclamation-triangle"></i>
                    No se puede dar de baja a un alumno con justificantes pendientes de resolución.
                </div>

                <div class="table-container">
                    <table class="dynamic-table" id="tablaAlumnos">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Correo</th>
                                <th>% Asistencia</th>
                                <th>Justificantes Pendientes</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="alumno-cell">
                                        <div class="avatar-sm">RS</div>
                                        <span>Roberto Sánchez</span>
                                    </div>
                                </td>
                                <td>roberto@escuela.edu</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-bar-mini" style="width: 72%"></div>
                                        <span>72%</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-success">0 pendientes</span></td>
                                <td><span class="status status-active">Activo</span></td>
                                <td class="action-cell">
                                    <button class="btn btn-danger btn-sm" onclick="confirmarBaja(1, 'Roberto Sánchez')">
                                        <i class="fas fa-user-times"></i>
                                        Dar de baja
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
                                <td>ana@escuela.edu</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-bar-mini progress-risk" style="width: 55%"></div>
                                        <span>55%</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">2 pendientes</span></td>
                                <td><span class="status status-active">Activo</span></td>
                                <td class="action-cell">
                                    {{-- Deshabilitado por justificantes pendientes (RF-14) --}}
                                    <button class="btn btn-danger btn-sm" disabled title="No se puede dar de baja: tiene justificantes pendientes">
                                        <i class="fas fa-user-times"></i>
                                        Dar de baja
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== TAB 3: ELIMINAR SESIÓN (RF-14) ==================== --}}
    <div class="tab-panel" id="tab-sesiones">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-times"></i>
                    Eliminar Clase / Sesión
                </h3>
                <div class="card-actions">
                    <select class="filter-select" id="filtroAulaSesiones">
                        <option value="">Seleccionar aula...</option>
                        <option value="1">Matemáticas — Grupo A</option>
                        <option value="2">Historia — Grupo B</option>
                    </select>
                </div>
            </div>

            <div class="card-body">
                {{-- WARNING RF-14: no eliminar con asistencias/justificantes --}}
                <div class="warning-banner">
                    <i class="fas fa-exclamation-triangle"></i>
                    No se puede eliminar una sesión que tenga asistencias o justificantes vinculados.
                </div>

                <div class="table-container">
                    <table class="dynamic-table" id="tablaSesiones">
                        <thead>
                            <tr>
                                <th>Fecha de Sesión</th>
                                <th>Aula</th>
                                <th>Asistencias Registradas</th>
                                <th>Justificantes Vinculados</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>02/05/2026 — 08:00</td>
                                <td>Matemáticas — Grupo A</td>
                                <td><span class="badge badge-success">0</span></td>
                                <td><span class="badge badge-success">0</span></td>
                                <td><span class="status status-active">Eliminable</span></td>
                                <td class="action-cell">
                                    <button class="btn btn-danger btn-sm" onclick="confirmarEliminarSesion(1, '02/05/2026')">
                                        <i class="fas fa-trash"></i>
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>30/04/2026 — 08:00</td>
                                <td>Matemáticas — Grupo A</td>
                                <td><span class="badge badge-warning">18</span></td>
                                <td><span class="badge badge-warning">3</span></td>
                                <td><span class="status status-inactive">No eliminable</span></td>
                                <td class="action-cell">
                                    <button class="btn btn-danger btn-sm" disabled title="Tiene asistencias o justificantes vinculados">
                                        <i class="fas fa-trash"></i>
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ==================== MODAL CONFIRMACIÓN ==================== --}}
<div class="modal-overlay" id="modalOverlay">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="modalTitle">Confirmar Acción</h3>
                <p class="modal-subtitle" id="modalSubtitle">¿Está seguro de que desea continuar?</p>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p id="modalMessage">Esta acción quedará registrada en el log de auditoría.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="closeModal()">Cancelar</button>
            <form id="modalForm" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="hidden" name="registro_id" id="modalRegistroId">
                <input type="hidden" name="accion" id="modalAccion">
                <button type="submit" class="btn btn-danger btn-md" id="modalConfirmBtn">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== TABS ====================
    document.querySelectorAll('.admin-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
        });
    });

    // ==================== MODAL ====================
    function openModal() {
        document.getElementById('modalOverlay').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
    }

    // RF-14: Confirmar corrección de asistencia
    function confirmarCorreccion(id, nombre) {
        const estado = document.querySelector(`.estado-correcto[data-id="${id}"]`).value;
        const motivo = document.querySelector(`.motivo-input[data-id="${id}"]`).value;

        if (!motivo.trim()) {
            alert('Debe ingresar un motivo para la corrección.');
            return;
        }

        document.getElementById('modalTitle').textContent = 'Confirmar Corrección';
        document.getElementById('modalSubtitle').textContent = 'Edición Administrativa — RF-14';
        document.getElementById('modalMessage').textContent =
            `¿Corregir asistencia de ${nombre} a "${estado}"? Esta acción se registrará en el audit_log.`;
        document.getElementById('modalForm').action = `/admin/asistencia/${id}`;
        document.getElementById('modalRegistroId').value = id;
        document.getElementById('modalAccion').value = 'correccion';
        openModal();
    }

    // RF-14: Confirmar baja de alumno
    function confirmarBaja(id, nombre) {
        document.getElementById('modalTitle').textContent = 'Confirmar Baja Administrativa';
        document.getElementById('modalSubtitle').textContent = 'Esta acción no puede revertirse en ciclos cerrados.';
        document.getElementById('modalMessage').textContent =
            `¿Dar de baja al alumno ${nombre}? Se verificará que no tenga justificantes pendientes.`;
        document.getElementById('modalForm').action = `/admin/alumno/${id}`;
        document.getElementById('modalRegistroId').value = id;
        document.getElementById('modalAccion').value = 'baja';
        openModal();
    }

    // RF-14: Confirmar eliminación de sesión
    function confirmarEliminarSesion(id, fecha) {
        document.getElementById('modalTitle').textContent = 'Eliminar Sesión';
        document.getElementById('modalSubtitle').textContent = 'Solo sesiones sin asistencias ni justificantes.';
        document.getElementById('modalMessage').textContent =
            `¿Eliminar la sesión del ${fecha}? Se verificará que no tenga registros vinculados.`;
        document.getElementById('modalForm').action = `/admin/sesion/${id}`;
        document.getElementById('modalRegistroId').value = id;
        document.getElementById('modalAccion').value = 'eliminar_sesion';
        openModal();
    }

    // Cerrar modal con Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });
</script>
@endpush

@endsection