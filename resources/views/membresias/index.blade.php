{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Membresías y Suscripciones — Gestión de planes,
 *                 asignación a instituciones y control de vencimientos (RF-03 / RF-12).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Membresías (RF-03/RF-12).
 */
--}}

@extends('layouts.app')

@section('title', 'Membresías - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/membresias.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Membresías</h1>
                <p>Gestión de planes y suscripciones de instituciones</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline btn-md" onclick="abrirModal('modalPlanes')">
                    <i class="fas fa-tags"></i>
                    Gestionar planes
                </button>
                <button class="btn btn-primary btn-md" onclick="abrirModal('modalAsignar')">
                    <i class="fas fa-plus"></i>
                    Asignar membresía
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">9</span>
                <span class="kpi-label">Membresías activas</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-exclamation-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">2</span>
                <span class="kpi-label">Por vencer (30 días)</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--danger">
            <div class="kpi-icon"><i class="fas fa-times-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">1</span>
                <span class="kpi-label">Expiradas</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-tags"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">3</span>
                <span class="kpi-label">Planes disponibles</span>
            </div>
        </div>
    </div>

    {{-- ===================== TABS ===================== --}}
    <div class="mod-tabs">
        <button class="mod-tab active" data-tab="todas">
            <i class="fas fa-list"></i>
            Todas
        </button>
        <button class="mod-tab" data-tab="activa">
            <i class="fas fa-check-circle"></i>
            Activas
        </button>
        <button class="mod-tab" data-tab="por-vencer">
            <i class="fas fa-clock"></i>
            Por vencer
            <span class="tab-badge">2</span>
        </button>
        <button class="mod-tab" data-tab="expirada">
            <i class="fas fa-times-circle"></i>
            Expiradas
        </button>
    </div>

    {{-- ===================== TABLA ===================== --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-id-card"></i>
                Membresías registradas
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar institución..." id="buscarMembresia">
                </div>
                <select class="filter-select" id="filtroPlan">
                    <option value="">Todos los planes</option>
                    <option value="Básico">Básico</option>
                    <option value="Estándar">Estándar</option>
                    <option value="Premium">Premium</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-container">
                <table class="dynamic-table" id="tablaMembresias">
                    <thead>
                        <tr>
                            <th>Institución</th>
                            <th>Plan</th>
                            <th>Inicio</th>
                            <th>Vencimiento</th>
                            <th>Aulas permitidas</th>
                            <th>Docentes permitidos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tab="activa">
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-university"></i></div>
                                    <span class="inst-nombre">CBTIS 168</span>
                                </div>
                            </td>
                            <td><span class="plan-badge plan-premium">Premium</span></td>
                            <td>01/01/2026</td>
                            <td>31/12/2026</td>
                            <td>Ilimitadas</td>
                            <td>Ilimitados</td>
                            <td><span class="status status-active">Activa</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Renovar" onclick="abrirModal('modalRenovar')">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="activa">
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-school"></i></div>
                                    <span class="inst-nombre">Colegio Americano</span>
                                </div>
                            </td>
                            <td><span class="plan-badge plan-estandar">Estándar</span></td>
                            <td>01/03/2026</td>
                            <td>28/02/2027</td>
                            <td>20 aulas</td>
                            <td>10 docentes</td>
                            <td><span class="status status-active">Activa</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Renovar" onclick="abrirModal('modalRenovar')">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="por-vencer">
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-university"></i></div>
                                    <span class="inst-nombre">CECyTE Plantel 5</span>
                                </div>
                            </td>
                            <td><span class="plan-badge plan-basico">Básico</span></td>
                            <td>01/06/2025</td>
                            <td class="fecha-alerta">25/05/2026</td>
                            <td>5 aulas</td>
                            <td>3 docentes</td>
                            <td><span class="status status-warning">Por vencer</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn warn" title="Renovar urgente" onclick="abrirModal('modalRenovar')">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-tab="expirada">
                            <td>
                                <div class="inst-cell inst-cell--inactive">
                                    <div class="inst-icon inst-icon--inactive"><i class="fas fa-school"></i></div>
                                    <span class="inst-nombre">Preparatoria Lázaro</span>
                                </div>
                            </td>
                            <td><span class="plan-badge plan-basico">Básico</span></td>
                            <td>01/04/2025</td>
                            <td class="fecha-vencida">30/03/2026</td>
                            <td>5 aulas</td>
                            <td>3 docentes</td>
                            <td><span class="status status-expired">Expirada</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Renovar" onclick="abrirModal('modalRenovar')">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL: PLANES ===================== --}}
<div class="modal-overlay" id="modalPlanes">
    <div class="modal modal-lg">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Gestión de Planes</h3>
                <p class="modal-subtitle">Crea y edita los planes disponibles</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalPlanes')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="planes-grid">
                <div class="plan-card plan-card--basico">
                    <div class="plan-header">
                        <span class="plan-nombre">Básico</span>
                        <button class="plan-edit-btn" title="Editar"><i class="fas fa-edit"></i></button>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> 5 aulas</li>
                        <li><i class="fas fa-check"></i> 3 docentes</li>
                        <li><i class="fas fa-check"></i> Reportes básicos</li>
                        <li class="feat-no"><i class="fas fa-times"></i> Exportación PDF</li>
                    </ul>
                </div>
                <div class="plan-card plan-card--estandar">
                    <div class="plan-header">
                        <span class="plan-nombre">Estándar</span>
                        <button class="plan-edit-btn" title="Editar"><i class="fas fa-edit"></i></button>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> 20 aulas</li>
                        <li><i class="fas fa-check"></i> 10 docentes</li>
                        <li><i class="fas fa-check"></i> Reportes completos</li>
                        <li><i class="fas fa-check"></i> Exportación PDF</li>
                    </ul>
                </div>
                <div class="plan-card plan-card--premium">
                    <div class="plan-header">
                        <span class="plan-nombre">Premium</span>
                        <button class="plan-edit-btn" title="Editar"><i class="fas fa-edit"></i></button>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> Aulas ilimitadas</li>
                        <li><i class="fas fa-check"></i> Docentes ilimitados</li>
                        <li><i class="fas fa-check"></i> Reportes + análisis</li>
                        <li><i class="fas fa-check"></i> Soporte prioritario</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalPlanes')">Cerrar</button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: ASIGNAR MEMBRESÍA ===================== --}}
<div class="modal-overlay" id="modalAsignar">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Asignar Membresía</h3>
                <p class="modal-subtitle">Selecciona institución y plan</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalAsignar')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Institución <span class="required">*</span></label>
                <select class="form-input">
                    <option value="">Selecciona una institución...</option>
                    <option>CBTIS 168</option>
                    <option>Colegio Americano</option>
                    <option>CECyTE Plantel 5</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Plan <span class="required">*</span></label>
                <select class="form-input">
                    <option value="">Selecciona un plan...</option>
                    <option>Básico</option>
                    <option>Estándar</option>
                    <option>Premium</option>
                </select>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Fecha de inicio <span class="required">*</span></label>
                    <input type="date" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Fecha de vencimiento <span class="required">*</span></label>
                    <input type="date" class="form-input">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Observaciones</label>
                <textarea class="form-textarea" rows="2" placeholder="Notas internas opcionales..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalAsignar')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-save"></i>
                Asignar membresía
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: RENOVAR ===================== --}}
<div class="modal-overlay" id="modalRenovar">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Renovar Membresía</h3>
                <p class="modal-subtitle">CECyTE Plantel 5 — Plan Básico</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalRenovar')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Nuevo plan</label>
                <select class="form-input">
                    <option>Básico</option>
                    <option>Estándar</option>
                    <option>Premium</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Nueva fecha de vencimiento <span class="required">*</span></label>
                <input type="date" class="form-input">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalRenovar')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-redo"></i>
                Renovar
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: DETALLE ===================== --}}
<div class="modal-overlay" id="modalDetalle">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">CBTIS 168</h3>
                <p class="modal-subtitle">Detalle de membresía</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalDetalle')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="detalle-grid">
                <div class="detalle-item">
                    <span class="detalle-label">Plan</span>
                    <span class="plan-badge plan-premium">Premium</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Estado</span>
                    <span class="status status-active">Activa</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Inicio</span>
                    <span class="detalle-value">01/01/2026</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Vencimiento</span>
                    <span class="detalle-value">31/12/2026</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Aulas permitidas</span>
                    <span class="detalle-value">Ilimitadas</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Docentes permitidos</span>
                    <span class="detalle-value">Ilimitados</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Aulas en uso</span>
                    <span class="detalle-value">12</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Docentes en uso</span>
                    <span class="detalle-value">8</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalDetalle')">Cerrar</button>
            <button class="btn btn-primary btn-md" onclick="cerrarModal('modalDetalle'); abrirModal('modalRenovar')">
                <i class="fas fa-redo"></i>
                Renovar
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
            document.querySelectorAll('#tablaMembresias tbody tr').forEach(tr => {
                tr.style.display = (tabActiva === 'todas' || tr.dataset.tab === tabActiva) ? '' : 'none';
            });
        });
    });

    // ==================== BÚSQUEDA ====================
    document.getElementById('buscarMembresia').addEventListener('input', function () {
        const texto = this.value.toLowerCase();
        document.querySelectorAll('#tablaMembresias tbody tr').forEach(tr => {
            tr.style.display = tr.textContent.toLowerCase().includes(texto) ? '' : 'none';
        });
    });

    // ==================== MODALES ====================
    function abrirModal(id) { document.getElementById(id).classList.add('active'); }
    function cerrarModal(id) { document.getElementById(id).classList.remove('active'); }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            ['modalPlanes','modalAsignar','modalRenovar','modalDetalle'].forEach(cerrarModal);
        }
    });
</script>
@endpush

@endsection