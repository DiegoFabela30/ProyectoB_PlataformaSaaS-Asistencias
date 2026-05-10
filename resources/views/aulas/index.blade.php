{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Aulas — Listado de aulas activas e inactivas
 *                 con acceso a detalle y gestión (RF-04).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Aulas Index (RF-04).
 */
--}}

@extends('layouts.app')

@section('title', 'Aulas - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/aulas.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Aulas</h1>
                <p>Gestión de aulas y grupos de la institución</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('aulas.create') }}" class="btn btn-primary btn-md">
                    <i class="fas fa-plus"></i>
                    Nueva aula
                </a>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-chalkboard"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">8</span>
                <span class="kpi-label">Total aulas</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-lock-open"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">6</span>
                <span class="kpi-label">Ciclo abierto</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-lock"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">2</span>
                <span class="kpi-label">Ciclo cerrado</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-users"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">148</span>
                <span class="kpi-label">Alumnos totales</span>
            </div>
        </div>
    </div>

    {{-- ===================== TABS ===================== --}}
    <div class="mod-tabs">
        <button class="mod-tab active" data-tab="todas">
            <i class="fas fa-th-large"></i>
            Todas
        </button>
        <button class="mod-tab" data-tab="abierto">
            <i class="fas fa-lock-open"></i>
            Ciclo abierto
        </button>
        <button class="mod-tab" data-tab="cerrado">
            <i class="fas fa-lock"></i>
            Ciclo cerrado
        </button>
    </div>

    {{-- ===================== VISTA TOGGLE ===================== --}}
    <div class="vista-toggle">
        <button class="toggle-btn active" id="btnGrid" title="Vista tarjetas">
            <i class="fas fa-th-large"></i>
        </button>
        <button class="toggle-btn" id="btnList" title="Vista tabla">
            <i class="fas fa-list"></i>
        </button>
        <div class="search-bar" style="margin-left:auto;">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Buscar aula..." id="buscarAula">
        </div>
    </div>

    {{-- ===================== VISTA TARJETAS ===================== --}}
    <div id="vistaGrid">
        <div class="aulas-grid" id="gridAulas">

            <div class="aula-card" data-tab="abierto">
                <div class="aula-card-header">
                    <div class="aula-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="status status-open">Abierto</span>
                </div>
                <h3 class="aula-nombre">Matemáticas</h3>
                <p class="aula-grupo">Grupo A &nbsp;·&nbsp; Lunes y Miércoles</p>
                <div class="aula-stats">
                    <div class="aula-stat">
                        <i class="fas fa-users"></i>
                        <span>20 alumnos</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-calendar-check"></i>
                        <span>18 sesiones</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-chart-line"></i>
                        <span>84% asist.</span>
                    </div>
                </div>
                <div class="aula-docente">
                    <div class="avatar-xs">RN</div>
                    <span>Prof. Rubén Nolasco</span>
                </div>
                <div class="aula-card-footer">
                    <span class="aula-codigo">MAT-A-2026</span>
                    <div class="aula-acciones">
                        <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn" title="Ir a asistencias">
                            <i class="fas fa-clipboard-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="aula-card" data-tab="abierto">
                <div class="aula-card-header">
                    <div class="aula-icon aula-icon--b"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="status status-open">Abierto</span>
                </div>
                <h3 class="aula-nombre">Historia</h3>
                <p class="aula-grupo">Grupo B &nbsp;·&nbsp; Martes y Jueves</p>
                <div class="aula-stats">
                    <div class="aula-stat">
                        <i class="fas fa-users"></i>
                        <span>25 alumnos</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-calendar-check"></i>
                        <span>16 sesiones</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-chart-line"></i>
                        <span>91% asist.</span>
                    </div>
                </div>
                <div class="aula-docente">
                    <div class="avatar-xs">DH</div>
                    <span>Prof. Diego Hernández</span>
                </div>
                <div class="aula-card-footer">
                    <span class="aula-codigo">HIS-B-2026</span>
                    <div class="aula-acciones">
                        <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn" title="Ir a asistencias">
                            <i class="fas fa-clipboard-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="aula-card" data-tab="abierto">
                <div class="aula-card-header">
                    <div class="aula-icon aula-icon--c"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="status status-open">Abierto</span>
                </div>
                <h3 class="aula-nombre">Física</h3>
                <p class="aula-grupo">Grupo C &nbsp;·&nbsp; Viernes</p>
                <div class="aula-stats">
                    <div class="aula-stat">
                        <i class="fas fa-users"></i>
                        <span>18 alumnos</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-calendar-check"></i>
                        <span>14 sesiones</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-chart-line"></i>
                        <span>78% asist.</span>
                    </div>
                </div>
                <div class="aula-docente">
                    <div class="avatar-xs">GG</div>
                    <span>Prof. Ghael García</span>
                </div>
                <div class="aula-card-footer">
                    <span class="aula-codigo">FIS-C-2026</span>
                    <div class="aula-acciones">
                        <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn" title="Ir a asistencias">
                            <i class="fas fa-clipboard-check"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="aula-card aula-card--cerrada" data-tab="cerrado">
                <div class="aula-card-header">
                    <div class="aula-icon aula-icon--closed"><i class="fas fa-chalkboard-teacher"></i></div>
                    <span class="status status-closed">Cerrado</span>
                </div>
                <h3 class="aula-nombre">Química</h3>
                <p class="aula-grupo">Grupo A &nbsp;·&nbsp; Lunes</p>
                <div class="aula-stats">
                    <div class="aula-stat">
                        <i class="fas fa-users"></i>
                        <span>22 alumnos</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-calendar-check"></i>
                        <span>20 sesiones</span>
                    </div>
                    <div class="aula-stat">
                        <i class="fas fa-chart-line"></i>
                        <span>86% asist.</span>
                    </div>
                </div>
                <div class="aula-docente">
                    <div class="avatar-xs">RN</div>
                    <span>Prof. Rubén Nolasco</span>
                </div>
                <div class="aula-card-footer">
                    <span class="aula-codigo">QUI-A-2025</span>
                    <div class="aula-acciones">
                        <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn" title="Ver reporte">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ===================== VISTA TABLA ===================== --}}
    <div id="vistaList" style="display:none;">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-container">
                    <table class="dynamic-table" id="tablaAulas">
                        <thead>
                            <tr>
                                <th>Aula</th>
                                <th>Docente</th>
                                <th>Horario</th>
                                <th>Alumnos</th>
                                <th>Sesiones</th>
                                <th>% Asist. prom.</th>
                                <th>Ciclo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-tab="abierto">
                                <td>
                                    <div class="aula-cell">
                                        <div class="aula-dot dot-a"></div>
                                        <div>
                                            <span class="cell-nombre">Matemáticas</span>
                                            <span class="cell-grupo">Grupo A · MAT-A-2026</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Prof. Rubén Nolasco</td>
                                <td>Lun / Mié</td>
                                <td>20</td>
                                <td>18</td>
                                <td><span class="pct-ok">84%</span></td>
                                <td><span class="status status-open">Abierto</span></td>
                                <td class="action-cell">
                                    <button class="action-btn" title="Ver" onclick="abrirModal('modalDetalle')"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Asistencias"><i class="fas fa-clipboard-check"></i></button>
                                </td>
                            </tr>
                            <tr data-tab="abierto">
                                <td>
                                    <div class="aula-cell">
                                        <div class="aula-dot dot-b"></div>
                                        <div>
                                            <span class="cell-nombre">Historia</span>
                                            <span class="cell-grupo">Grupo B · HIS-B-2026</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Prof. Diego Hernández</td>
                                <td>Mar / Jue</td>
                                <td>25</td>
                                <td>16</td>
                                <td><span class="pct-ok">91%</span></td>
                                <td><span class="status status-open">Abierto</span></td>
                                <td class="action-cell">
                                    <button class="action-btn" title="Ver" onclick="abrirModal('modalDetalle')"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Asistencias"><i class="fas fa-clipboard-check"></i></button>
                                </td>
                            </tr>
                            <tr data-tab="cerrado">
                                <td>
                                    <div class="aula-cell">
                                        <div class="aula-dot dot-closed"></div>
                                        <div>
                                            <span class="cell-nombre">Química</span>
                                            <span class="cell-grupo">Grupo A · QUI-A-2025</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Prof. Rubén Nolasco</td>
                                <td>Lunes</td>
                                <td>22</td>
                                <td>20</td>
                                <td><span class="pct-ok">86%</span></td>
                                <td><span class="status status-closed">Cerrado</span></td>
                                <td class="action-cell">
                                    <button class="action-btn" title="Ver" onclick="abrirModal('modalDetalle')"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn" title="Reporte"><i class="fas fa-chart-bar"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL: DETALLE AULA ===================== --}}
<div class="modal-overlay" id="modalDetalle">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Matemáticas — Grupo A</h3>
                <p class="modal-subtitle">Código: MAT-A-2026</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalDetalle')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="detalle-grid">
                <div class="detalle-item">
                    <span class="detalle-label">Docente</span>
                    <span class="detalle-value">Prof. Rubén Nolasco</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Estado del ciclo</span>
                    <span class="status status-open">Abierto</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Horario</span>
                    <span class="detalle-value">Lunes y Miércoles 08:00–09:30</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Ciclo escolar</span>
                    <span class="detalle-value">Enero – Junio 2026</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Alumnos inscritos</span>
                    <span class="detalle-value">20 / 25 cupo</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Sesiones realizadas</span>
                    <span class="detalle-value">18</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Asistencia promedio</span>
                    <span class="detalle-value pct-ok">84%</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Asistencia mínima</span>
                    <span class="detalle-value">80%</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalDetalle')">Cerrar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-clipboard-check"></i>
                Ir a asistencias
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

            document.querySelectorAll('.aula-card').forEach(card => {
                card.style.display = (tabActiva === 'todas' || card.dataset.tab === tabActiva) ? '' : 'none';
            });
            document.querySelectorAll('#tablaAulas tbody tr').forEach(tr => {
                tr.style.display = (tabActiva === 'todas' || tr.dataset.tab === tabActiva) ? '' : 'none';
            });
        });
    });

    // ==================== TOGGLE VISTA ====================
    document.getElementById('btnGrid').addEventListener('click', () => {
        document.getElementById('vistaGrid').style.display = 'block';
        document.getElementById('vistaList').style.display = 'none';
        document.getElementById('btnGrid').classList.add('active');
        document.getElementById('btnList').classList.remove('active');
    });

    document.getElementById('btnList').addEventListener('click', () => {
        document.getElementById('vistaGrid').style.display = 'none';
        document.getElementById('vistaList').style.display = 'block';
        document.getElementById('btnList').classList.add('active');
        document.getElementById('btnGrid').classList.remove('active');
    });

    // ==================== BÚSQUEDA ====================
    document.getElementById('buscarAula').addEventListener('input', function () {
        const texto = this.value.toLowerCase();
        document.querySelectorAll('.aula-card').forEach(card => {
            card.style.display = card.textContent.toLowerCase().includes(texto) ? '' : 'none';
        });
        document.querySelectorAll('#tablaAulas tbody tr').forEach(tr => {
            tr.style.display = tr.textContent.toLowerCase().includes(texto) ? '' : 'none';
        });
    });

    // ==================== MODALES ====================
    function abrirModal(id) { document.getElementById(id).classList.add('active'); }
    function cerrarModal(id) { document.getElementById(id).classList.remove('active'); }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal('modalDetalle'); });
</script>
@endpush

@endsection