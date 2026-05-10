{{--
/**
 * G.A.M.A. SOLUTIONS S.A. de C.V.
 * "El factor de cambio en tu tecnología"
 *
 * @descripcion    Módulo de Aulas — Formulario de creación de nueva aula
 *                 y generación de código de invitación (RF-04 / RF-05).
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
 * 07/05/2026  | Rubén Alejandro   | Implementación inicial Crear Aula (RF-04/RF-05).
 */
--}}

@extends('layouts.app')

@section('title', 'Nueva Aula - GAMA Solutions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/aulas.css') }}">
@endpush

@section('content')
<div class="main-content">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Nueva Aula</h1>
                <p>Configura los datos del aula y genera el código de invitación</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('aulas.index') }}" class="btn btn-outline btn-md">
                    <i class="fas fa-arrow-left"></i>
                    Volver a aulas
                </a>
            </div>
        </div>
    </div>

    <div class="create-grid">

        {{-- ===================== FORMULARIO PRINCIPAL ===================== --}}
        <div class="create-main">

            {{-- Datos generales --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i>
                        Datos generales
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-grid">
                        <div class="form-group form-group--full">
                            <label class="form-label">Nombre del aula / materia <span class="required">*</span></label>
                            <input type="text" class="form-input" id="nombreAula"
                                placeholder="Ej. Matemáticas" oninput="actualizarCodigo()">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Grupo <span class="required">*</span></label>
                            <input type="text" class="form-input" id="grupo"
                                placeholder="Ej. A" maxlength="3" oninput="actualizarCodigo()">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ciclo escolar <span class="required">*</span></label>
                            <select class="form-input" id="ciclo" onchange="actualizarCodigo()">
                                <option value="">Selecciona...</option>
                                <option value="2026">Enero – Junio 2026</option>
                                <option value="2026B">Agosto – Diciembre 2026</option>
                                <option value="2027">Enero – Junio 2027</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Institución <span class="required">*</span></label>
                            <select class="form-input">
                                <option value="">Selecciona...</option>
                                <option>CBTIS 168</option>
                                <option>Colegio Americano</option>
                                <option>CECyTE Plantel 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Capacidad máxima <span class="required">*</span></label>
                            <input type="number" class="form-input" placeholder="25" min="1" max="100">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Asistencia mínima requerida <span class="required">*</span></label>
                            <div class="input-suffix-wrapper">
                                <input type="number" class="form-input" value="80" min="1" max="100">
                                <span class="input-suffix">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Horario --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock"></i>
                        Horario de clases
                    </h3>
                </div>
                <div class="card-body">
                    <div class="dias-semana">
                        <button type="button" class="dia-btn" data-dia="Lun" onclick="toggleDia(this)">Lun</button>
                        <button type="button" class="dia-btn" data-dia="Mar" onclick="toggleDia(this)">Mar</button>
                        <button type="button" class="dia-btn active" data-dia="Mié" onclick="toggleDia(this)">Mié</button>
                        <button type="button" class="dia-btn" data-dia="Jue" onclick="toggleDia(this)">Jue</button>
                        <button type="button" class="dia-btn active" data-dia="Vie" onclick="toggleDia(this)">Vie</button>
                        <button type="button" class="dia-btn" data-dia="Sáb" onclick="toggleDia(this)">Sáb</button>
                    </div>
                    <div class="form-grid" style="margin-top:16px;">
                        <div class="form-group">
                            <label class="form-label">Hora inicio <span class="required">*</span></label>
                            <input type="time" class="form-input" value="08:00">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hora fin <span class="required">*</span></label>
                            <input type="time" class="form-input" value="09:30">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="create-actions">
                <button type="button" class="btn btn-outline btn-md" onclick="window.history.back()">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary btn-md" onclick="abrirModal('modalConfirmar')">
                    <i class="fas fa-save"></i>
                    Crear aula y generar código
                </button>
            </div>

        </div>

        {{-- ===================== PANEL LATERAL: CÓDIGO DE INVITACIÓN ===================== --}}
        <div class="create-sidebar">

            {{-- Preview código --}}
            <div class="card card--codigo">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-key"></i>
                        Código de invitación
                    </h3>
                </div>
                <div class="card-body codigo-body">
                    <p class="codigo-desc">
                        El código se genera automáticamente con los datos del aula.
                        Los alumnos lo usarán para unirse al aula.
                    </p>
                    <div class="codigo-preview" id="codigoPreview">
                        <span class="codigo-texto" id="codigoTexto">MAT-A-2026</span>
                        <button class="btn-copy" title="Copiar" onclick="copiarCodigo()" id="btnCopiar">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <p class="codigo-nota">
                        <i class="fas fa-info-circle"></i>
                        Podrás regenerar el código desde el detalle del aula si es necesario.
                    </p>
                </div>
            </div>

            {{-- Checklist previa --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-list"></i>
                        Antes de crear
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="pre-checklist">
                        <li class="pre-check" id="checkNombre">
                            <i class="fas fa-circle pre-dot"></i>
                            Nombre del aula
                        </li>
                        <li class="pre-check" id="checkGrupo">
                            <i class="fas fa-circle pre-dot"></i>
                            Grupo definido
                        </li>
                        <li class="pre-check" id="checkCiclo">
                            <i class="fas fa-circle pre-dot"></i>
                            Ciclo seleccionado
                        </li>
                        <li class="pre-check">
                            <i class="fas fa-circle pre-dot pre-dot--ok"></i>
                            Días de clase seleccionados
                        </li>
                        <li class="pre-check">
                            <i class="fas fa-circle pre-dot pre-dot--ok"></i>
                            Horario establecido
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</div>

{{-- ===================== MODAL: CONFIRMAR CREACIÓN ===================== --}}
<div class="modal-overlay" id="modalConfirmar">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div>
                <h3 class="modal-title">Confirmar creación</h3>
                <p class="modal-subtitle">Se generará el código de invitación</p>
            </div>
            <button class="modal-close" onclick="cerrarModal('modalConfirmar')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="confirm-resumen">
                <div class="conf-row">
                    <span class="conf-label">Aula</span>
                    <span class="conf-value" id="confNombre">Matemáticas — Grupo A</span>
                </div>
                <div class="conf-row">
                    <span class="conf-label">Código</span>
                    <span class="conf-value code-inline" id="confCodigo">MAT-A-2026</span>
                </div>
                <div class="conf-row">
                    <span class="conf-label">Ciclo</span>
                    <span class="conf-value">Enero – Junio 2026</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline btn-md" onclick="cerrarModal('modalConfirmar')">Cancelar</button>
            <button class="btn btn-primary btn-md">
                <i class="fas fa-save"></i>
                Crear aula
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ==================== CÓDIGO DINÁMICO ====================
    function actualizarCodigo() {
        const nombre = document.getElementById('nombreAula').value.trim();
        const grupo  = document.getElementById('grupo').value.trim().toUpperCase();
        const ciclo  = document.getElementById('ciclo').value;

        const prefijo = nombre.length >= 3
            ? nombre.substring(0, 3).toUpperCase().replace(/\s/g, '')
            : '???';

        const codigo = [prefijo, grupo || '?', ciclo || '????'].join('-');
        document.getElementById('codigoTexto').textContent = codigo;
        document.getElementById('confCodigo').textContent  = codigo;
        document.getElementById('confNombre').textContent  =
            (nombre || 'Sin nombre') + (grupo ? ' — Grupo ' + grupo : '');

        // Checklist dinámica
        toggleCheck('checkNombre', nombre.length > 0);
        toggleCheck('checkGrupo',  grupo.length > 0);
        toggleCheck('checkCiclo',  ciclo.length > 0);
    }

    function toggleCheck(id, ok) {
        const el  = document.getElementById(id);
        const dot = el.querySelector('.pre-dot');
        if (ok) { dot.classList.add('pre-dot--ok'); }
        else    { dot.classList.remove('pre-dot--ok'); }
    }

    // ==================== DÍAS DE SEMANA ====================
    function toggleDia(btn) {
        btn.classList.toggle('active');
    }

    // ==================== COPIAR CÓDIGO ====================
    function copiarCodigo() {
        const codigo = document.getElementById('codigoTexto').textContent;
        navigator.clipboard.writeText(codigo).then(() => {
            const btn = document.getElementById('btnCopiar');
            btn.innerHTML = '<i class="fas fa-check"></i>';
            setTimeout(() => { btn.innerHTML = '<i class="fas fa-copy"></i>'; }, 1500);
        });
    }

    // ==================== MODAL ====================
    function abrirModal(id) { document.getElementById(id).classList.add('active'); }
    function cerrarModal(id) { document.getElementById(id).classList.remove('active'); }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal('modalConfirmar'); });
</script>
@endpush

@endsection