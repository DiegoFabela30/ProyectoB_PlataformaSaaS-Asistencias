{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Panel del Docente — Generación de clave de sesión y
 *                 control de asistencias en tiempo real (RF-06).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Panel Docente (RF-06).
 */
--}}

@extends('layouts.app')

@section('title', 'Asistencias — Docente - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/asistencias-docente.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Control de Asistencias</h1>
                <p>Matemáticas — Grupo A &nbsp;|&nbsp; Lunes y Miércoles 08:00 – 09:30</p>
            </div>
            <div class="header-actions">
                <span class="badge badge-info">
                    <i class="fas fa-users"></i>
                    20 / 25 alumnos inscritos
                </span>
                <span class="badge badge-success" id="badgeEstadoSesion" style="display:none;">
                    <i class="fas fa-circle pulse"></i>
                    Sesión activa
                </span>
            </div>
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
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-user-check"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">17</span>
                <span class="kpi-label">Asistieron hoy</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">3</span>
                <span class="kpi-label">Alumnos en riesgo</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-file-alt"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">2</span>
                <span class="kpi-label">Justificantes pendientes</span>
            </div>
        </div>
    </div>

    <div class="panel-grid">

        {{-- ===================== PANEL IZQUIERDO: CLAVE DE SESIÓN ===================== --}}
        <div class="panel-left">

            {{-- CLAVE ACTIVA --}}
            <div class="card card--clave" id="cardClave">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-key"></i>
                        Clave de Sesión
                    </h3>
                    <span class="badge badge-muted" id="estadoClave">Sin sesión activa</span>
                </div>
                <div class="card-body clave-body">

                    {{-- Estado: sin sesión --}}
                    <div id="vistaInactiva">
                        <p class="clave-desc">
                            Genera una clave alfanumérica temporal para que tus alumnos registren su asistencia.
                        </p>
                        <div class="clave-config">
                            <label class="form-label">Duración de la clave</label>
                            <div class="duracion-options">
                                <button class="duracion-btn active" data-min="5">5 min</button>
                                <button class="duracion-btn" data-min="10">10 min</button>
                                <button class="duracion-btn" data-min="15">15 min</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg btn-full" id="btnGenerarClave" onclick="generarClave()">
                            <i class="fas fa-key"></i>
                            Generar clave de sesión
                        </button>
                    </div>

                    {{-- Estado: sesión activa --}}
                    <div id="vistaActiva" style="display:none;">
                        <div class="clave-display">
                            <span class="clave-codigo" id="codigoClave">AB3X9Z</span>
                            <button class="btn-copy" title="Copiar clave" onclick="copiarClave()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <div class="countdown-wrapper">
                            <div class="countdown-ring">
                                <svg class="countdown-svg" viewBox="0 0 80 80">
                                    <circle class="ring-bg" cx="40" cy="40" r="34"/>
                                    <circle class="ring-progress" cx="40" cy="40" r="34" id="ringProgress"/>
                                </svg>
                                <div class="countdown-time" id="countdownTime">10:00</div>
                            </div>
                            <p class="countdown-label">tiempo restante</p>
                        </div>
                        <div class="sesion-stats">
                            <div class="sesion-stat">
                                <span class="sesion-stat-value" id="contadorAsistencias">0</span>
                                <span class="sesion-stat-label">registrados</span>
                            </div>
                            <div class="sesion-stat-divider"></div>
                            <div class="sesion-stat">
                                <span class="sesion-stat-value">20</span>
                                <span class="sesion-stat-label">esperados</span>
                            </div>
                        </div>
                        <button class="btn btn-danger btn-md btn-full" onclick="confirmarCierre()">
                            <i class="fas fa-stop-circle"></i>
                            Cerrar registro manualmente
                        </button>
                    </div>

                </div>
            </div>

            {{-- CONFIGURACIÓN DEL AULA --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cog"></i>
                        Configuración del Aula
                    </h3>
                </div>
                <div class="card-body">
                    <div class="config-row">
                        <span class="config-label">Asistencia mínima requerida</span>
                        <span class="config-value">80%</span>
                    </div>
                    <div class="config-row">
                        <span class="config-label">Capacidad del aula</span>
                        <span class="config-value">25 alumnos</span>
                    </div>
                    <div class="config-row">
                        <span class="config-label">Ciclo escolar</span>
                        <span class="config-value">Ene – Jun 2026</span>
                    </div>
                    <div class="config-row">
                        <span class="config-label">Código de invitación</span>
                        <span class="config-value code-inline">MAT-A-2026</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===================== PANEL DERECHO: LISTA DE ALUMNOS ===================== --}}
        <div class="panel-right">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i>
                        Alumnos — Sesión de hoy
                    </h3>
                    <div class="card-actions">
                        <div class="search-bar">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Buscar alumno..." id="buscarAlumno">
                        </div>
                        <select class="filter-select" id="filtroEstado">
                            <option value="">Todos</option>
                            <option value="A">Asistencia</option>
                            <option value="F">Falta</option>
                            <option value="P">Pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-container">
                        <table class="dynamic-table" id="tablaAlumnos">
                            <thead>
                                <tr>
                                    <th>Alumno</th>
                                    <th>% Asistencia</th>
                                    <th>Estado hoy</th>
                                    <th>Hora registro</th>
                                    <th>Riesgo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-estado="A">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">CM</div>
                                            <span>Carlos Martínez</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini" style="width:92%"></div>
                                            <span>92%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>08:04</td>
                                    <td><span class="riesgo riesgo-ok"><i class="fas fa-circle"></i> Bajo</span></td>
                                </tr>
                                <tr data-estado="A">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">MG</div>
                                            <span>María García</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini" style="width:88%"></div>
                                            <span>88%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>08:06</td>
                                    <td><span class="riesgo riesgo-ok"><i class="fas fa-circle"></i> Bajo</span></td>
                                </tr>
                                <tr data-estado="F">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">RS</div>
                                            <span>Roberto Sánchez</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini progress-warning" style="width:72%"></div>
                                            <span>72%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-absent">Falta</span></td>
                                    <td>—</td>
                                    <td><span class="riesgo riesgo-medio"><i class="fas fa-circle"></i> Medio</span></td>
                                </tr>
                                <tr data-estado="F">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">AL</div>
                                            <span>Ana López</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini progress-risk" style="width:55%"></div>
                                            <span>55%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-absent">Falta</span></td>
                                    <td>—</td>
                                    <td><span class="riesgo riesgo-alto"><i class="fas fa-circle"></i> Alto</span></td>
                                </tr>
                                <tr data-estado="A">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">PR</div>
                                            <span>Pedro Ramírez</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini" style="width:85%"></div>
                                            <span>85%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>08:02</td>
                                    <td><span class="riesgo riesgo-ok"><i class="fas fa-circle"></i> Bajo</span></td>
                                </tr>
                                <tr data-estado="P">
                                    <td>
                                        <div class="alumno-cell">
                                            <div class="avatar-sm">LT</div>
                                            <span>Laura Torres</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress-mini">
                                            <div class="progress-bar-mini progress-warning" style="width:78%"></div>
                                            <span>78%</span>
                                        </div>
                                    </td>
                                    <td><span class="status status-pending">Pendiente</span></td>
                                    <td>—</td>
                                    <td><span class="riesgo riesgo-medio"><i class="fas fa-circle"></i> Medio</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===================== MODAL: CONFIRMAR CIERRE ===================== --}}
<div class="modal-overlay" id="modalOverlay">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Cerrar registro de asistencia</h3>
                <p class="modal-subtitle">Esta acción no puede deshacerse</p>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p>¿Está seguro que desea cerrar el registro antes de que expire la clave?</p>
            <p>Los alumnos que no hayan registrado su asistencia quedarán marcados como <strong>Falta</strong>.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="closeModal()">Cancelar</button>
            <button class="btn btn-danger btn-md" onclick="cerrarSesion()">
                <i class="fas fa-stop-circle"></i>
                Cerrar registro
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== DURACIÓN ====================
    let duracionSeleccionada = 5;

    document.querySelectorAll('.duracion-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.duracion-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            duracionSeleccionada = parseInt(btn.dataset.min);
        });
    });

    // ==================== CLAVE ====================
    let countdownInterval = null;
    let segundosRestantes  = 0;
    let contadorAsist      = 0;

    function generarClave() {
        const chars  = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        let clave    = '';
        for (let i = 0; i < 6; i++) clave += chars[Math.floor(Math.random() * chars.length)];

        document.getElementById('codigoClave').textContent   = clave;
        document.getElementById('vistaInactiva').style.display = 'none';
        document.getElementById('vistaActiva').style.display   = 'block';
        document.getElementById('badgeEstadoSesion').style.display = 'inline-flex';
        document.getElementById('estadoClave').textContent    = 'Sesión activa';
        document.getElementById('estadoClave').className      = 'badge badge-success';

        segundosRestantes = duracionSeleccionada * 60;
        contadorAsist     = 0;
        actualizarContador();
        iniciarContdown();
        simularAsistencias();
    }

    function iniciarContdown() {
        clearInterval(countdownInterval);
        const total = segundosRestantes;

        countdownInterval = setInterval(() => {
            segundosRestantes--;
            actualizarContador();

            // Anillo SVG
            const circunferencia = 2 * Math.PI * 34;
            const progreso = segundosRestantes / total;
            const offset   = circunferencia * (1 - progreso);
            document.getElementById('ringProgress').style.strokeDashoffset = offset;

            if (segundosRestantes <= 0) {
                clearInterval(countdownInterval);
                cerrarSesionAutomatico();
            }
        }, 1000);

        // Init anillo
        const circunferencia = 2 * Math.PI * 34;
        const ring = document.getElementById('ringProgress');
        ring.style.strokeDasharray  = circunferencia;
        ring.style.strokeDashoffset = 0;
    }

    function actualizarContador() {
        const m = String(Math.floor(segundosRestantes / 60)).padStart(2, '0');
        const s = String(segundosRestantes % 60).padStart(2, '0');
        document.getElementById('countdownTime').textContent = `${m}:${s}`;
    }

    // Simula alumnos registrándose en tiempo real (placeholder)
    function simularAsistencias() {
        const intervalo = setInterval(() => {
            if (contadorAsist >= 17 || segundosRestantes <= 0) {
                clearInterval(intervalo);
                return;
            }
            contadorAsist++;
            document.getElementById('contadorAsistencias').textContent = contadorAsist;
        }, 1800);
    }

    function cerrarSesionAutomatico() {
        document.getElementById('vistaActiva').style.display   = 'none';
        document.getElementById('vistaInactiva').style.display = 'block';
        document.getElementById('badgeEstadoSesion').style.display = 'none';
        document.getElementById('estadoClave').textContent = 'Sin sesión activa';
        document.getElementById('estadoClave').className  = 'badge badge-muted';
    }

    function copiarClave() {
        const clave = document.getElementById('codigoClave').textContent;
        navigator.clipboard.writeText(clave).then(() => {
            const btn = document.querySelector('.btn-copy');
            btn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => { btn.innerHTML = '<i class="fas fa-copy"></i>'; }, 1500);
        });
    }

    // ==================== MODAL ====================
    function confirmarCierre() {
        document.getElementById('modalOverlay').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.remove('active');
    }

    function cerrarSesion() {
        clearInterval(countdownInterval);
        closeModal();
        cerrarSesionAutomatico();
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

    // ==================== BÚSQUEDA Y FILTRO ====================
    function filtrarTabla() {
        const texto  = document.getElementById('buscarAlumno').value.toLowerCase();
        const estado = document.getElementById('filtroEstado').value;

        document.querySelectorAll('#tablaAlumnos tbody tr').forEach(tr => {
            const nombre    = tr.querySelector('.alumno-cell span').textContent.toLowerCase();
            const trEstado  = tr.dataset.estado;
            const coincide  = (!texto || nombre.includes(texto)) && (!estado || trEstado === estado);
            tr.style.display = coincide ? '' : 'none';
        });
    }

    document.getElementById('buscarAlumno').addEventListener('input', filtrarTabla);
    document.getElementById('filtroEstado').addEventListener('change', filtrarTabla);
</script>
@endpush

@endsection