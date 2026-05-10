{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Gestión de Instituciones — Alta, edición
 *                 y desactivación de instituciones (RF-02).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Instituciones (RF-02).
 */
--}}

@extends('layouts.app')

@section('title', 'Instituciones - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/instituciones.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Instituciones</h1>
                <p>Gestión de instituciones registradas en la plataforma</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary btn-md" onclick="abrirModal('modalCrear')">
                    <i class="fas fa-plus"></i>
                    Nueva institución
                </button>
            </div>
        </div>
    </div>

    {{-- ===================== KPI CARDS ===================== --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-building"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">12</span>
                <span class="kpi-label">Total instituciones</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--success">
            <div class="kpi-icon"><i class="fas fa-check-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">9</span>
                <span class="kpi-label">Activas</span>
            </div>
        </div>
        <div class="kpi-card kpi-card--warning">
            <div class="kpi-icon"><i class="fas fa-pause-circle"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">3</span>
                <span class="kpi-label">Inactivas</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon"><i class="fas fa-chalkboard"></i></div>
            <div class="kpi-content">
                <span class="kpi-value">48</span>
                <span class="kpi-label">Aulas registradas</span>
            </div>
        </div>
    </div>

    {{-- ===================== TABLA ===================== --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-building"></i>
                Listado de instituciones
            </h3>
            <div class="card-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar institución..." id="buscarInstitucion">
                </div>
                <select class="filter-select" id="filtroEstado">
                    <option value="">Todos los estados</option>
                    <option value="activa">Activa</option>
                    <option value="inactiva">Inactiva</option>
                </select>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-container">
                <table class="dynamic-table" id="tablaInstituciones">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Institución</th>
                            <th>Contacto</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Aulas</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-estado="activa">
                            <td>001</td>
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-university"></i></div>
                                    <div>
                                        <span class="inst-nombre">CBTIS 168</span>
                                        <span class="inst-tipo">Pública</span>
                                    </div>
                                </div>
                            </td>
                            <td>Lic. Juan Pérez</td>
                            <td>jperez@cbtis168.edu.mx</td>
                            <td>55 1234 5678</td>
                            <td><span class="badge-num">12</span></td>
                            <td><span class="status status-active">Activa</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Editar" onclick="abrirModal('modalEditar')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn danger" title="Desactivar" onclick="confirmarDesactivar(1, 'CBTIS 168')">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-estado="activa">
                            <td>002</td>
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-school"></i></div>
                                    <div>
                                        <span class="inst-nombre">Colegio Americano</span>
                                        <span class="inst-tipo">Privada</span>
                                    </div>
                                </div>
                            </td>
                            <td>Mtra. Laura Vega</td>
                            <td>lvega@colamex.edu.mx</td>
                            <td>55 9876 5432</td>
                            <td><span class="badge-num">8</span></td>
                            <td><span class="status status-active">Activa</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Editar" onclick="abrirModal('modalEditar')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn danger" title="Desactivar" onclick="confirmarDesactivar(2, 'Colegio Americano')">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-estado="activa">
                            <td>003</td>
                            <td>
                                <div class="inst-cell">
                                    <div class="inst-icon"><i class="fas fa-university"></i></div>
                                    <div>
                                        <span class="inst-nombre">CECyTE Plantel 5</span>
                                        <span class="inst-tipo">Pública</span>
                                    </div>
                                </div>
                            </td>
                            <td>Dr. Martín Flores</td>
                            <td>mflores@cecyte.edu.mx</td>
                            <td>55 5555 1234</td>
                            <td><span class="badge-num">15</span></td>
                            <td><span class="status status-active">Activa</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Editar" onclick="abrirModal('modalEditar')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn danger" title="Desactivar" onclick="confirmarDesactivar(3, 'CECyTE Plantel 5')">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                        <tr data-estado="inactiva">
                            <td>004</td>
                            <td>
                                <div class="inst-cell inst-cell--inactive">
                                    <div class="inst-icon inst-icon--inactive"><i class="fas fa-school"></i></div>
                                    <div>
                                        <span class="inst-nombre">Preparatoria Lázaro</span>
                                        <span class="inst-tipo">Pública</span>
                                    </div>
                                </div>
                            </td>
                            <td>Mtra. Ana Ríos</td>
                            <td>arios@lazaro.edu.mx</td>
                            <td>55 4444 8888</td>
                            <td><span class="badge-num">6</span></td>
                            <td><span class="status status-inactive">Inactiva</span></td>
                            <td class="action-cell">
                                <button class="action-btn" title="Ver detalle" onclick="abrirModal('modalDetalle')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn" title="Reactivar" onclick="confirmarReactivar(4, 'Preparatoria Lázaro')">
                                    <i class="fas fa-redo"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="pagination">
                <button class="page-link disabled"><i class="fas fa-chevron-left"></i></button>
                <button class="page-link active">1</button>
                <button class="page-link">2</button>
                <button class="page-link"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

</div>

{{-- ===================== MODAL: NUEVA INSTITUCIÓN ===================== --}}
<div class="modal-overlay" id="modalCrear">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Nueva Institución</h3>
                <p class="modal-subtitle">Completa los datos de la institución</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalCrear')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-grid">
                <div class="form-group form-group--full">
                    <label class="form-label">Nombre de la institución <span class="required">*</span></label>
                    <input type="text" class="form-input" placeholder="Ej. CBTIS 168">
                </div>
                <div class="form-group">
                    <label class="form-label">Tipo <span class="required">*</span></label>
                    <select class="form-input">
                        <option value="">Selecciona...</option>
                        <option>Pública</option>
                        <option>Privada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre del contacto <span class="required">*</span></label>
                    <input type="text" class="form-input" placeholder="Nombre completo">
                </div>
                <div class="form-group">
                    <label class="form-label">Correo electrónico <span class="required">*</span></label>
                    <input type="email" class="form-input" placeholder="correo@institucion.edu.mx">
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-input" placeholder="55 0000 0000">
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-input" placeholder="Calle, número, colonia, ciudad">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalCrear')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-save"></i>
                Guardar institución
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: VER DETALLE ===================== --}}
<div class="modal-overlay" id="modalDetalle">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">CBTIS 168</h3>
                <p class="modal-subtitle">Detalle de la institución</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalDetalle')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="detalle-grid">
                <div class="detalle-item">
                    <span class="detalle-label">Tipo</span>
                    <span class="detalle-value">Pública</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Estado</span>
                    <span class="status status-active">Activa</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Contacto</span>
                    <span class="detalle-value">Lic. Juan Pérez</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Correo</span>
                    <span class="detalle-value">jperez@cbtis168.edu.mx</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Teléfono</span>
                    <span class="detalle-value">55 1234 5678</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Aulas registradas</span>
                    <span class="detalle-value">12</span>
                </div>
                <div class="detalle-item detalle-item--full">
                    <span class="detalle-label">Dirección</span>
                    <span class="detalle-value">Av. Insurgentes 456, Col. Centro, CDMX</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalDetalle')">Cerrar</button>
            <button class="btn btn-primary btn-md" onclick="cerrarModal('modalDetalle'); abrirModal('modalEditar')">
                <i class="fas fa-edit"></i>
                Editar
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: EDITAR ===================== --}}
<div class="modal-overlay" id="modalEditar">
    <div class="modal modal-md">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Editar Institución</h3>
                <p class="modal-subtitle">CBTIS 168</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalEditar')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-grid">
                <div class="form-group form-group--full">
                    <label class="form-label">Nombre de la institución <span class="required">*</span></label>
                    <input type="text" class="form-input" value="CBTIS 168">
                </div>
                <div class="form-group">
                    <label class="form-label">Tipo <span class="required">*</span></label>
                    <select class="form-input">
                        <option selected>Pública</option>
                        <option>Privada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre del contacto</label>
                    <input type="text" class="form-input" value="Lic. Juan Pérez">
                </div>
                <div class="form-group">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" class="form-input" value="jperez@cbtis168.edu.mx">
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-input" value="55 1234 5678">
                </div>
                <div class="form-group form-group--full">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-input" value="Av. Insurgentes 456, Col. Centro, CDMX">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalEditar')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-save"></i>
                Guardar cambios
            </button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: CONFIRMAR ACCIÓN ===================== --}}
<div class="modal-overlay" id="modalConfirmar">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div>
                <h3 class="modal-title" id="confirmarTitulo">Confirmar acción</h3>
                <p class="modal-subtitle" id="confirmarSubtitulo"></p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalConfirmar')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p id="confirmarMensaje"></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalConfirmar')">Cancelar</button>
            <button class="btn btn-danger btn-md" id="confirmarBtn">Confirmar</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== BÚSQUEDA Y FILTRO ====================
    function filtrar() {
        const texto  = document.getElementById('buscarInstitucion').value.toLowerCase();
        const estado = document.getElementById('filtroEstado').value;
        document.querySelectorAll('#tablaInstituciones tbody tr').forEach(tr => {
            const nombre  = tr.querySelector('.inst-nombre').textContent.toLowerCase();
            const trEst   = tr.dataset.estado;
            const muestra = (!texto || nombre.includes(texto)) && (!estado || trEst === estado);
            tr.style.display = muestra ? '' : 'none';
        });
    }
    document.getElementById('buscarInstitucion').addEventListener('input', filtrar);
    document.getElementById('filtroEstado').addEventListener('change', filtrar);

    // ==================== MODALES ====================
    function abrirModal(id) { document.getElementById(id).classList.add('active'); }
    function cerrarModal(id) { document.getElementById(id).classList.remove('active'); }

    function confirmarDesactivar(id, nombre) {
        document.getElementById('confirmarTitulo').textContent   = 'Desactivar institución';
        document.getElementById('confirmarSubtitulo').textContent = 'Las aulas activas quedarán suspendidas';
        document.getElementById('confirmarMensaje').textContent  = `¿Desactivar la institución "${nombre}"? Los docentes y alumnos vinculados no podrán acceder.`;
        abrirModal('modalConfirmar');
    }

    function confirmarReactivar(id, nombre) {
        document.getElementById('confirmarTitulo').textContent   = 'Reactivar institución';
        document.getElementById('confirmarSubtitulo').textContent = 'Se restaurará el acceso a sus aulas';
        document.getElementById('confirmarMensaje').textContent  = `¿Reactivar la institución "${nombre}"?`;
        document.getElementById('confirmarBtn').className        = 'btn btn-primary btn-md';
        document.getElementById('confirmarBtn').textContent      = 'Reactivar';
        abrirModal('modalConfirmar');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') ['modalCrear','modalDetalle','modalEditar','modalConfirmar'].forEach(cerrarModal);
    });
</script>
@endpush

@endsection