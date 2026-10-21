<!doctype html>
<html lang="en">
<title>Editar Contrato | #000001</title>
@include("layouts.head")

<style>
    .custom-scroll-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        /* Suavidad en móviles */
        display: block;
    }
</style>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    @include('layouts.sidebar')
    @include('layouts.topBar')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item"><a href="./ListaContratos">Contratos</a></li>
                                <li class="breadcrumb-item" aria-current="page">Editar Contrato</li>
                            </ul>
                        </div>
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <div class="page-header-title">
                                <h2 class="mb-0">Editar Contrato</h2>
                            </div>
                            <!--<span class="badge bg-light-warning text-warning f-14">Estado: En Proceso</span>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                         <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Modificar Información</h5>
                            <h5 class="mb-0 text-muted">Folio: <span class="text-primary">#000001</span></h5>
                        </div>
                        <div class="card-body">
                            <form action="#">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h6 class="text-primary border-bottom pb-2">1. Datos de la Mascota</h6>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" value="Max" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Especie/Raza</label>
                                        <input type="text" class="form-control" value="Canino / Labrador" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Corregir Peso (kg)</label>
                                        <input type="number" class="form-control" value="25">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h6 class="text-primary border-bottom pb-2">2. Paquete y Urna Seleccionada</h6>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Plan Contratado</label>
                                        <select class="form-select">
                                            <option value="1" selected>Cremación Individual - $2,500</option>
                                            <option value="2">Cremación Comunitaria - $1,200</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Modelo de Urna</label>
                                        <select class="form-select">
                                            <option value="u1" selected>Urna Madera Clásica</option>
                                            <option value="u2">Urna Cerámica Blanca</option>
                                            <option value="u3">Urna de Mármol Premium</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <h6 class="text-primary border-bottom pb-2 flex-grow-1">3. Servicios Adicionales
                                        </h6>
                                        <button type="button" class="btn btn-sm btn-link-primary mb-2"
                                            data-bs-toggle="modal" data-bs-target="#modalServicioExtra">
                                            <i class="ti ti-plus"></i> Gestionar Extras
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-scroll-container bg-light rounded p-2">
                                            <table class="table table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Concepto</th>
                                                        <th>Costo</th>
                                                        <th class="text-end">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Recolección Nocturna</td>
                                                        <td>$500.00</td>
                                                        <td class="text-end">
                                                            <a href="#" class="text-danger"><i
                                                                    class="ti ti-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Motivo de la edición</label>
                                    <textarea class="form-control" rows="2"
                                        placeholder="Describa por qué está editando el contrato (Para auditoría)..."></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-primary shadow-none" style="border-style: dashed;">
                        <div class="card-body">
                            <h6 class="text-center text-muted mb-3">Balance de Modificación</h6>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Nuevo Total de Venta:</span>
                                <span class="fw-bold text-dark">$3,500.00</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Pagos registrados:</span>
                                <span class="fw-bold text-success">- $1,500.00</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h6 mb-0">Saldo a Liquidar:</span>
                                <span class="h4 mb-0 text-primary fw-bold">$2,000.00</span>
                            </div>

                            <div class="mt-3 small text-info text-center">
                                <i class="ti ti-info-circle"></i> Los abonos realizados se mantienen vinculados al
                                folio.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Configuración de Pagos</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Modificar Esquema</label>
                                <select class="form-select" id="select-esquema">
                                    <option value="1">Contado</option>
                                    <option value="2" selected>Crédito</option>
                                </select>
                            </div>

                            <div id="seccion-credito">
                                <div class="mb-3">
                                    <label class="form-label text-muted">Ajustar Periodicidad</label>
                                    <select class="form-select form-select-sm">
                                        <option>Semanal</option>
                                        <option selected>Quincenal</option>
                                        <option>Mensual</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i> Guardar Cambios
                                </button>
                                <button class="btn btn-outline-secondary">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light-info d-flex align-items-center" role="alert">
                        <i class="ti ti-info-circle me-2 f-20"></i>
                        <div>
                            Si cambia la <b>Urna</b>, el sistema devolverá la anterior al stock y descontará la nueva
                            automáticamente.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalServicioExtra" tabindex="-1" aria-labelledby="modalServicioExtraLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalServicioExtraLabel">Añadir Servicio Adicional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-servicio-extra">
                        <div class="mb-3">
                            <label class="form-label">Seleccionar Servicio</label>
                            <select class="form-select" id="modal-select-servicio">
                                <option selected disabled>Elegir del catálogo...</option>
                                <option value="500">Recolección Nocturna - $500</option>
                                <option value="300">Certificado Extra - $300</option>
                                <option value="800">Traslado Foráneo - $800</option>
                                <option value="250">Flores de Acompañamiento - $250</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Costo Confirmado</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="modal-precio-servicio" placeholder="0.00">
                            </div>
                            <small class="text-muted">Puedes ajustar el precio manualmente si es
                                necesario.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notas o detalles</label>
                            <textarea class="form-control" rows="2"
                                placeholder="Ej. Recolección en Clínica San José"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-guardar-servicio">Agregar al
                        contrato</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    @include('layouts.scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectEsquema = document.getElementById('select-esquema');
            const seccionCredito = document.getElementById('seccion-credito');

            selectEsquema.addEventListener('change', function () {
                seccionCredito.style.display = (this.value === "2") ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>