{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Portal del Alumno — Registro de asistencia con clave
 *                 de sesión e historial de asistencias (RF-07 / RF-13).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Portal Alumno (RF-07/RF-13).
 */
--}}

@extends('layouts.app')

@section('title', 'Mi Asistencia - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/asistencias-alumno.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Mi Asistencia</h1>
                <p>Matemáticas — Grupo A &nbsp;|&nbsp; Lunes y Miércoles 08:00 – 09:30</p>
            </div>
            <div class="header-actions">
                <span class="badge badge-info">
                    <i class="fas fa-graduation-cap"></i>
                    Carlos Martínez
                </span>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card kpi-card--highlight">
            <div class="kpi-icon"><i class="fas fa-percentage"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">88%</span>
                <span class="kpi-label">Mi asistencia global</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">16</span>
                <span class="kpi-label">Asistencias</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-times-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">2</span>
                <span class="kpi-label">Faltas</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-file-alt"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">1</span>
                <span class="kpi-label">Justificantes</span>
            </div>
        </div>
    </div>

    <div class="panel-grid">

        {{-- ===================== PANEL IZQUIERDO ===================== --}}
        <div class="panel-left">

            {{-- REGISTRO CON CLAVE --}}
            <div class="card card--registro">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-key"></i>
                        Registrar Asistencia
                    </h3>
                </div>
                <div class="card-body">

                    {{-- Estado: esperando clave --}}
                    <div id="vistaFormClave">
                        <p class="registro-desc">
                            Ingresa la clave que tu docente proyectó en clase para registrar tu asistencia.
                        </p>
                        <div class="clave-inputs">
                            <input class="clave-char" type="text" maxlength="1" id="c1" autocomplete="off">
                            <input class="clave-char" type="text" maxlength="1" id="c2" autocomplete="off">
                            <input class="clave-char" type="text" maxlength="1" id="c3" autocomplete="off">
                            <span class="clave-separador">—</span>
                            <input class="clave-char" type="text" maxlength="1" id="c4" autocomplete="off">
                            <input class="clave-char" type="text" maxlength="1" id="c5" autocomplete="off">
                            <input class="clave-char" type="text" maxlength="1" id="c6" autocomplete="off">
                        </div>
                        <p class="clave-hint" id="claveHint"></p>
                        <button class="btn btn-primary btn-lg btn-full" id="btnRegistrar" onclick="registrarAsistencia()" disabled>
                            <i class="fas fa-paper-plane"></i>
                            Registrar asistencia
                        </button>
                    </div>

                    {{-- Estado: éxito --}}
                    <div id="vistaExito" style="display:none;">
                        <div class="registro-exito">
                            <div class="exito-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="exito-titulo">¡Asistencia registrada!</h3>
                            <p class="exito-desc">Tu asistencia quedó registrada correctamente.</p>
                            <div class="exito-detalle">
                                <span class="exito-hora" id="horaRegistro">08:07 AM</span>
                                <span class="exito-fecha">07 de Mayo, 2026</span>
                            </div>
                        </div>
                    </div>

                    {{-- Estado: error de clave --}}
                    <div id="vistaError" style="display:none;">
                        <div class="registro-error">
                            <div class="error-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h3 class="error-titulo">Clave incorrecta</h3>
                            <p class="error-desc">La clave ingresada no es válida o ya expiró. Solicita a tu docente que verifique la sesión.</p>
                            <button class="btn btn-outline btn-md btn-full" onclick="reintentar()">
                                <i class="fas fa-redo"></i>
                                Intentar de nuevo
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- PROGRESO GENERAL --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Mi Progreso
                    </h3>
                </div>
                <div class="card-body">

                    <div class="progreso-global">
                        <div class="progreso-porcentaje">88%</div>
                        <div class="progreso-barra-wrapper">
                            <div class="progreso-barra" style="width: 88%"></div>
                        </div>
                        <div class="progreso-meta">
                            <span>Meta mínima: 80%</span>
                            <span class="progreso-estado ok">
                                <i class="fas fa-check-circle"></i> Aprobado
                            </span>
                        </div>
                    </div>

                    <div class="progreso-desglose">
                        <div class="desglose-item">
                            <span class="desglose-label">
                                <i class="fas fa-circle desglose-dot dot-a"></i>
                                Asistencias
                            </span>
                            <span class="desglose-value">16 / 18 sesiones</span>
                        </div>
                        <div class="desglose-item">
                            <span class="desglose-label">
                                <i class="fas fa-circle desglose-dot dot-f"></i>
                                Faltas
                            </span>
                            <span class="desglose-value">2</span>
                        </div>
                        <div class="desglose-item">
                            <span class="desglose-label">
                                <i class="fas fa-circle desglose-dot dot-j"></i>
                                Justificantes
                            </span>
                            <span class="desglose-value">1</span>
                        </div>
                        <div class="desglose-item">
                            <span class="desglose-label">
                                <i class="fas fa-circle desglose-dot dot-p"></i>
                                Faltas restantes permitidas
                            </span>
                            <span class="desglose-value desglose-alerta">2 más</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- ===================== PANEL DERECHO: HISTORIAL ===================== --}}
        <div class="panel-right">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history"></i>
                        Historial de Asistencias
                    </h3>
                    <div class="card-actions">
                        <div class="search-bar">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Buscar fecha..." id="buscarHistorial">
                        </div>
                        <select class="filter-select" id="filtroHistorial">
                            <option value="">Todos</option>
                            <option value="A">Asistencia</option>
                            <option value="F">Falta</option>
                            <option value="J">Justificante</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-container">
                        <table class="dynamic-table" id="tablaHistorial">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Día</th>
                                    <th>Hora de registro</th>
                                    <th>Estado</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-estado="A">
                                    <td>18</td>
                                    <td>05/05/2026</td>
                                    <td>Lunes</td>
                                    <td>08:04</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>17</td>
                                    <td>30/04/2026</td>
                                    <td>Miércoles</td>
                                    <td>08:02</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="F">
                                    <td>16</td>
                                    <td>28/04/2026</td>
                                    <td>Lunes</td>
                                    <td>—</td>
                                    <td><span class="status status-absent">Falta</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>15</td>
                                    <td>23/04/2026</td>
                                    <td>Miércoles</td>
                                    <td>08:10</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="J">
                                    <td>14</td>
                                    <td>21/04/2026</td>
                                    <td>Lunes</td>
                                    <td>—</td>
                                    <td><span class="status status-justified">Justificante</span></td>
                                    <td>Cita médica comprobada</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>13</td>
                                    <td>16/04/2026</td>
                                    <td>Miércoles</td>
                                    <td>08:03</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>12</td>
                                    <td>14/04/2026</td>
                                    <td>Lunes</td>
                                    <td>08:06</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="F">
                                    <td>11</td>
                                    <td>09/04/2026</td>
                                    <td>Miércoles</td>
                                    <td>—</td>
                                    <td><span class="status status-absent">Falta</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>10</td>
                                    <td>07/04/2026</td>
                                    <td>Lunes</td>
                                    <td>08:01</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                                <tr data-estado="A">
                                    <td>9</td>
                                    <td>02/04/2026</td>
                                    <td>Miércoles</td>
                                    <td>08:09</td>
                                    <td><span class="status status-active">Asistencia</span></td>
                                    <td>—</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación --}}
                    <div class="pagination">
                        <button class="page-link disabled">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="page-link active">1</button>
                        <button class="page-link">2</button>
                        <button class="page-link">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // ==================== INPUTS CLAVE ====================
    const campos = ['c1','c2','c3','c4','c5','c6'];

    campos.forEach((id, idx) => {
        const input = document.getElementById(id);

        input.addEventListener('input', () => {
            input.value = input.value.toUpperCase();
            if (input.value && idx < campos.length - 1) {
                document.getElementById(campos[idx + 1]).focus();
            }
            validarClave();
        });

        input.addEventListener('keydown', e => {
            if (e.key === 'Backspace' && !input.value && idx > 0) {
                document.getElementById(campos[idx - 1]).focus();
            }
        });
    });

    function validarClave() {
        const clave = campos.map(id => document.getElementById(id).value).join('');
        const completa = clave.length === 6;
        document.getElementById('btnRegistrar').disabled = !completa;
        document.getElementById('claveHint').textContent = completa ? '' : `${clave.length} / 6 caracteres`;
    }

    // ==================== REGISTRAR ASISTENCIA ====================
    function registrarAsistencia() {
        const clave = campos.map(id => document.getElementById(id).value).join('');

        // Simulación: clave correcta = cualquier 6 chars (en real se valida en backend)
        const esCorrecta = clave.length === 6;

        if (esCorrecta) {
            const ahora  = new Date();
            const hora   = ahora.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('horaRegistro').textContent = hora;
            document.getElementById('vistaFormClave').style.display = 'none';
            document.getElementById('vistaExito').style.display     = 'block';
        } else {
            document.getElementById('vistaFormClave').style.display = 'none';
            document.getElementById('vistaError').style.display     = 'block';
        }
    }

    function reintentar() {
        campos.forEach(id => { document.getElementById(id).value = ''; });
        document.getElementById('vistaError').style.display     = 'none';
        document.getElementById('vistaFormClave').style.display = 'block';
        document.getElementById('btnRegistrar').disabled = true;
        document.getElementById('claveHint').textContent = '';
        document.getElementById('c1').focus();
    }

    // ==================== FILTRO HISTORIAL ====================
    function filtrarHistorial() {
        const texto  = document.getElementById('buscarHistorial').value.toLowerCase();
        const estado = document.getElementById('filtroHistorial').value;

        document.querySelectorAll('#tablaHistorial tbody tr').forEach(tr => {
            const fecha    = tr.querySelectorAll('td')[1].textContent.toLowerCase();
            const trEstado = tr.dataset.estado;
            const muestra  = (!texto || fecha.includes(texto)) && (!estado || trEstado === estado);
            tr.style.display = muestra ? '' : 'none';
        });
    }

    document.getElementById('buscarHistorial').addEventListener('input', filtrarHistorial);
    document.getElementById('filtroHistorial').addEventListener('change', filtrarHistorial);
</script>
@endpush

@endsection