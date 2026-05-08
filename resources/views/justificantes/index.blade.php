{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Justificantes — Solicitud por parte del alumno
 *                 y dictamen por parte del docente/admin (RF-08).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Justificantes (RF-08).
 */
--}}

@extends('layouts.app')

@section('title', 'Justificantes - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/justificantes.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Justificantes</h1>
                <p>Solicitud y resolución de justificantes de inasistencia</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary btn-md" onclick="abrirModalSolicitud()">
                    <i class="fas fa-plus"></i>
                    Nueva solicitud
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-inbox"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">8</span>
                <span class="kpi-label">Total solicitudes</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">3</span>
                <span class="kpi-label">Pendientes</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">4</span>
                <span class="kpi-label">Aprobados</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--danger">
            <div class="kpi-icon"><i class="fas fa-times-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">1</span>
                <span class="kpi-label">Rechazados</span>
            </div>
        </div>
    </div>

    {{-- ===================== TABS ===================== --}}
    <div class="mod-tabs">
        <button class="mod-tab active" data-tab="todos">
            <i class="fas fa-list"></i>
            Todos
        </button>
        <button class="mod-tab" data-tab="pendientes">
            <i class="fas fa-hourglass-half"></i>
            Pendientes
            <span class="tab-badge">3</span>
        </button>
        <button class="mod-tab" data-tab="resueltos">
            <i class="fas fa-check-double"></i>
            Resueltos
        </button>
    </div>

    {{-- ===================== TABLA PRINCIPAL ===================== --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-file-alt"></i>
                Solicitudes de Justificante
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar alumno o fecha..." id="buscarJustificante">
                </div>
                <select class="filter-select" id="filtroAula">
                    <option value="">Todas las aulas</option>
                    <option value="1">Matemáticas — Grupo A</option>
                    <option value="2">Historia — Grupo B</option>
                </select>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-container">
                <table class="dynamic-table" id="tablaJustificantes">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Alumno</th>
                            <th>Aula</th>
                            <th>Fecha de falta</th>
                            <th>Motivo</th>
                            <th>Fecha solicitud</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Pendientes --}}
                        <tr data-tab="pendientes" data-estado="P">
                            <td>001</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">CM</div>
                                    <span>Carlos Martínez</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>28/04/2026</td>
                            <td>
                                <span class="motivo-texto" title="Cita médica con especialista comprobada con documento oficial">
                                    Cita médica con especialista...
                                </span>
                            </td>
                            <td>30/04/2026</td>
                            <td><span class="status status-pending">Pendiente</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(1)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn approve" title="Aprobar" onclick="dictaminar(1, 'aprobar', 'Carlos Martínez')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="action-btn reject" title="Rechazar" onclick="dictaminar(1, 'rechazar', 'Carlos Martínez')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="pendientes" data-estado="P">
                            <td>002</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">AL</div>
                                    <span>Ana López</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>09/04/2026</td>
                            <td>
                                <span class="motivo-texto" title="Fallecimiento de familiar directo, acta de defunción adjunta">
                                    Fallecimiento de familiar...
                                </span>
                            </td>
                            <td>10/04/2026</td>
                            <td><span class="status status-pending">Pendiente</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(2)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn approve" title="Aprobar" onclick="dictaminar(2, 'aprobar', 'Ana López')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="action-btn reject" title="Rechazar" onclick="dictaminar(2, 'rechazar', 'Ana López')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="pendientes" data-estado="P">
                            <td>003</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">LT</div>
                                    <span>Laura Torres</span>
                                </div>
                            </td>
                            <td>Historia — Grupo B</td>
                            <td>05/05/2026</td>
                            <td>
                                <span class="motivo-texto" title="Representación institucional en evento deportivo interescolar">
                                    Representación institucional...
                                </span>
                            </td>
                            <td>06/05/2026</td>
                            <td><span class="status status-pending">Pendiente</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(3)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn approve" title="Aprobar" onclick="dictaminar(3, 'aprobar', 'Laura Torres')">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="action-btn reject" title="Rechazar" onclick="dictaminar(3, 'rechazar', 'Laura Torres')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        {{-- Resueltos --}}
                        <tr data-tab="resueltos" data-estado="A">
                            <td>004</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">MG</div>
                                    <span>María García</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>21/04/2026</td>
                            <td>
                                <span class="motivo-texto" title="Cita médica con cardiólogo">
                                    Cita médica con cardiólogo
                                </span>
                            </td>
                            <td>22/04/2026</td>
                            <td><span class="status status-approved">Aprobado</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(4)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="resueltos" data-estado="A">
                            <td>005</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">PR</div>
                                    <span>Pedro Ramírez</span>
                                </div>
                            </td>
                            <td>Historia — Grupo B</td>
                            <td>14/04/2026</td>
                            <td>
                                <span class="motivo-texto" title="Participación en olimpiada de matemáticas">
                                    Olimpiada de matemáticas
                                </span>
                            </td>
                            <td>15/04/2026</td>
                            <td><span class="status status-approved">Aprobado</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(5)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="resueltos" data-estado="R">
                            <td>006</td>
                            <td>
                                <div class="alumno-cell">
                                    <div class="avatar-sm">RS</div>
                                    <span>Roberto Sánchez</span>
                                </div>
                            </td>
                            <td>Matemáticas — Grupo A</td>
                            <td>07/04/2026</td>
                            <td>
                                <span class="motivo-texto" title="Motivo personal sin documentación">
                                    Motivo personal sin doc...
                                </span>
                            </td>
                            <td>08/04/2026</td>
                            <td><span class="status status-rejected">Rechazado</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="verDetalle(6)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL: VER DETALLE ===================== --}}
<div class="modal-overlay" id="modalDetalle">
    <div class="modal modal-lg">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Detalle de Justificante</h3>
                <p class="modal-subtitle">Solicitud #001</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalDetalle')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="detalle-grid">
                <div class="detalle-item">
                    <span class="detalle-label">Alumno</span>
                    <span class="detalle-value">Carlos Martínez</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Aula</span>
                    <span class="detalle-value">Matemáticas — Grupo A</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Fecha de falta</span>
                    <span class="detalle-value">28/04/2026</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Fecha de solicitud</span>
                    <span class="detalle-value">30/04/2026</span>
                </div>
                <div class="detalle-item detalle-item--full">
                    <span class="detalle-label">Motivo</span>
                    <span class="detalle-value">Cita médica con especialista comprobada con documento oficial del IMSS.</span>
                </div>
                <div class="detalle-item detalle-item--full">
                    <span class="detalle-label">Documento adjunto</span>
                    <div class="adjunto-placeholder">
                        <i class="fas fa-file-pdf"></i>
                        <span>documento_medico.pdf</span>
                        <span class="adjunto-size">245 KB</span>
                    </div>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Estado actual</span>
                    <span class="status status-pending">Pendiente</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalDetalle')">Cerrar</button>
            <button class="btn btn-danger btn-md" onclick="dictaminar(1, 'rechazar', 'Carlos Martínez'); cerrarModal('modalDetalle')">
                <i class="fas fa-times"></i>
                Rechazar
            </button>
            <button class="btn btn-success btn-md" onclick="dictaminar(1, 'aprobar', 'Carlos Martínez'); cerrarModal('modalDetalle')">
                <i class="fas fa-check"></i>
                Aprobar
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: NUEVA SOLICITUD ===================== --}}
<div class="modal-overlay" id="modalSolicitud">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Nueva Solicitud de Justificante</h3>
                <p class="modal-subtitle">Completa todos los campos requeridos</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalSolicitud')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Aula <span class="required">*</span></label>
                <select class="form-input">
                    <option value="">Selecciona una aula...</option>
                    <option>Matemáticas — Grupo A</option>
                    <option>Historia — Grupo B</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Fecha de la falta <span class="required">*</span></label>
                <input type="date" class="form-input">
            </div>
            <div class="form-group">
                <label class="form-label">Motivo <span class="required">*</span></label>
                <textarea class="form-textarea" placeholder="Describe el motivo de tu inasistencia..." rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Documento de respaldo</label>
                <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                    <p class="upload-text">Arrastra un archivo o <span class="upload-link">haz clic para seleccionar</span></p>
                    <p class="upload-hint">PDF, JPG o PNG — máx. 5 MB</p>
                    <input type="file" id="fileInput" accept=".pdf,.jpg,.png" style="display:none" onchange="mostrarArchivo(this)">
                </div>
                <div class="archivo-seleccionado" id="archivoSeleccionado" style="display:none">
                    <i class="fas fa-file-alt"></i>
                    <span id="nombreArchivo"></span>
                    <button type="button" class="btn-remove-file" onclick="quitarArchivo()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalSolicitud')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-paper-plane"></i>
                Enviar solicitud
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: CONFIRMAR DICTAMEN ===================== --}}
<div class="modal-overlay" id="modalDictamen">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="dictamenTitulo">Confirmar aprobación</h3>
                <p class="modal-subtitle" id="dictamenSubtitulo">Esta acción modificará el registro de asistencia</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalDictamen')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p id="dictamenMensaje"></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalDictamen')">Cancelar</button>
            <button class="btn btn-primary btn-md" id="dictamenConfirmar">
                Confirmar
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== TABS ====================
    document.querySelectorAll('.mod-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.mod-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const tabActiva = tab.dataset.tab;
            document.querySelectorAll('#tablaJustificantes tbody tr').forEach(tr => {
                if (tabActiva === 'todos') {
                    tr.style.display = '';
                } else {
                    tr.style.display = tr.dataset.tab === tabActiva ? '' : 'none';
                }
            });
        });
    });

    // ==================== BÚSQUEDA ====================
    document.getElementById('buscarJustificante').addEventListener('input', function () {
        const texto = this.value.toLowerCase();
        document.querySelectorAll('#tablaJustificantes tbody tr').forEach(tr => {
            tr.style.display = tr.textContent.toLowerCase().includes(texto) ? '' : 'none';
        });
    });

    // ==================== MODALES ====================
    function abrirModal(id) {
        document.getElementById(id).classList.add('active');
    }

    function cerrarModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    function abrirModalSolicitud() {
        abrirModal('modalSolicitud');
    }

    function verDetalle(id) {
        abrirModal('modalDetalle');
    }

    function dictaminar(id, accion, nombre) {
        const esAprobar = accion === 'aprobar';
        document.getElementById('dictamenTitulo').textContent    = esAprobar ? 'Confirmar aprobación' : 'Confirmar rechazo';
        document.getElementById('dictamenSubtitulo').textContent = 'Esta acción modificará el registro de asistencia';
        document.getElementById('dictamenMensaje').textContent   =
            esAprobar
                ? `¿Aprobar el justificante de ${nombre}? La falta quedará marcada como justificada.`
                : `¿Rechazar el justificante de ${nombre}? La falta se mantendrá sin justificación.`;

        const btn = document.getElementById('dictamenConfirmar');
        btn.className = esAprobar ? 'btn btn-success btn-md' : 'btn btn-danger btn-md';
        btn.innerHTML = esAprobar ? '<i class="fas fa-check"></i> Aprobar' : '<i class="fas fa-times"></i> Rechazar';

        abrirModal('modalDictamen');
    }

    // ==================== UPLOAD ====================
    const uploadArea = document.getElementById('uploadArea');

    uploadArea.addEventListener('dragover', e => {
        e.preventDefault();
        uploadArea.classList.add('drag-over');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('drag-over');
    });

    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file) mostrarArchivoObj(file);
    });

    function mostrarArchivo(input) {
        if (input.files[0]) mostrarArchivoObj(input.files[0]);
    }

    function mostrarArchivoObj(file) {
        document.getElementById('uploadArea').style.display          = 'none';
        document.getElementById('archivoSeleccionado').style.display = 'flex';
        document.getElementById('nombreArchivo').textContent         = file.name;
    }

    function quitarArchivo() {
        document.getElementById('fileInput').value                   = '';
        document.getElementById('uploadArea').style.display          = 'block';
        document.getElementById('archivoSeleccionado').style.display = 'none';
    }

    // Cerrar con Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            ['modalDetalle', 'modalSolicitud', 'modalDictamen'].forEach(cerrarModal);
        }
    });
</script>
@endpush

@endsection