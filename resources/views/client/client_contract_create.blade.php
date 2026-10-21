<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Agregar contrato</title>
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

<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @include('layouts.sidebar')
    @include('layouts.topBar')

    <!-- [ Main Content ] start -->
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item"><a href="./ListaClientes">Lista de usuarios</a></li>
                                <li class="breadcrumb-item" aria-current="page">Agregar contrato</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Agregar contrato</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Configuración de Nuevo Contrato</h5>
                        </div>
                        <div class="card-body">
                            <form action="#">
                               <div class="row mb-4 align-items-end"> <div class="col-md-12">
        <h6 class="text-primary border-bottom pb-2">0. Selección de Cliente</h6>
    </div>
    <div class="col-md-9">
        <div class="form-group mb-0"> <label class="form-label">Buscar Cliente Existente</label>
            <select class="form-select" id="buscar-cliente" name="cliente_id">
                <option value="">Escriba nombre o apellido para buscar...</option>
                <option value="1">Juan Pérez Sánchez - 6121234567</option>
                <option value="2">Andrés López - 6129876543</option>
                <option value="3">Oscar Valadez - 6124567890</option>
                <option value="4">Luis García - 6121112233</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <a href="./AgregarCliente" class="btn btn-outline-secondary w-100" target="_blank">
            <i class="ti ti-user-plus"></i> Nuevo Cliente
        </a>
    </div>
    <div class="col-md-12">
        <small class="text-muted">Puedes buscar por nombre, apellido o teléfono.</small>
    </div>
</div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h6 class="text-primary border-bottom pb-2">1. Datos de la Mascota</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" placeholder="Ej. Max">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Especie/Raza</label>
                                        <input type="text" class="form-control" placeholder="Ej. Canino / Labrador">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Peso (kg)</label>
                                        <input type="number" class="form-control" placeholder="0">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h6 class="text-primary border-bottom pb-2">2. Paquete y Urna</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Seleccionar Servicio Base</label>
                                        <select class="form-select">
                                            <option selected disabled>Elegir paquete...</option>
                                            <option value="1">Cremación Individual - $2,500</option>
                                            <option value="2">Cremación Comunitaria - $1,200</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Seleccionar Urna (Inventario)</label>
                                        <select class="form-select">
                                            <option selected disabled>Buscar modelo...</option>
                                            <option value="u1">Urna Madera Clásica (Stock: 5)</option>
                                            <option value="u2">Urna Cerámica Blanca (Stock: 2)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <h6 class="text-primary border-bottom pb-2 flex-grow-1">3. Servicios Adicionales
                                        </h6>
                                        <button type="button" class="btn btn-sm btn-primary mb-2 ms-2"
                                            data-bs-toggle="modal" data-bs-target="#modalServicioExtra">
                                            <i class="ti ti-plus"></i> Añadir
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-scroll-container">
                                            <table class="table table-sm">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Servicio</th>
                                                        <th>Costo</th>
                                                        <th class="text-end">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Recolección a domicilio (Nocturna)</td>
                                                        <td>$500.00</td>
                                                        <td class="text-end text-danger"><i
                                                                class="ti ti-trash cursor-pointer"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-primary text-white shadow-sm">
                        <div class="card-body">
                            <h5>Resumen de Cobro</h5>
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal Servicios:</span>
                                    <span>$2,500.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Urna:</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Extras:</span>
                                    <span>$500.00</span>
                                </div>
                                <hr class="bg-white">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="h5 text-white">Total Final:</span>
                                    <span class="h5 text-white">$3,000.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Esquema de Pago</label>
                                <select class="form-select" id="select-esquema">
                                    <option value="1">Contado (Liquidación inmediata)</option>
                                    <option value="2">Crédito (Pagos parciales)</option>
                                </select>
                            </div>

                            <div id="seccion-credito" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label">Periodicidad de pagos</label>
                                    <select class="form-select">
                                        <option value="semanal">Semanal</option>
                                        <option value="quincenal" selected>Quincenal</option>
                                        <option value="mensual">Mensual</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Número de pagos / Plazo</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="Ej. 6" value="4">
                                        <span class="input-group-text">pagos</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-success">Monto de Enganche</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="0.00">
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 shadow mt-2">Generar Contrato y Folio</button>
                            <p class="text-muted small text-center mt-3">Al generar, se descontará 1 unidad de la urna
                                del inventario.</p>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <input type="number" class="form-control" id="modal-precio-servicio"
                                            placeholder="0.00">
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

            <!-- [ form-element ] end -->
        </div>
        <!-- [ Main Content ] end -->
        </div>
    </section>
    <!-- [ Main Content ] end -->
    @include('layouts.footer')
    <!-- Required Js -->
    @include('layouts.scripts')
    <!-- [Page Specific JS] start -->
    <script src="../assets/js/plugins/simple-datatables.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectEsquema = document.getElementById('select-esquema');
            const seccionCredito = document.getElementById('seccion-credito');

            // Escuchar el cambio en el selector de esquema
            selectEsquema.addEventListener('change', function () {
                if (this.value === "2") { // "2" es el valor de Crédito
                    seccionCredito.style.display = 'block';
                } else {
                    seccionCredito.style.display = 'none';
                }
            });

            // Inicializar DataTable (Tu código existente)
            if (document.getElementById('pc-dt-simple')) {
                const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
                    sortable: false,
                    perPage: 5
                });
            }
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectServicio = document.getElementById('modal-select-servicio');
            const inputPrecio = document.getElementById('modal-precio-servicio');

            // Al cambiar la opción del select, actualizar el precio
            if (selectServicio) {
                selectServicio.addEventListener('change', function () {
                    // Usamos el value del option como precio sugerido
                    inputPrecio.value = this.value;
                });
            }

            // Lógica para cerrar el modal al "Guardar" (puedes expandir esto para insertar en la tabla)
            const btnGuardar = document.getElementById('btn-guardar-servicio');
            if (btnGuardar) {
                btnGuardar.addEventListener('click', function () {
                    // Aquí iría tu lógica para añadir la fila a la tabla dinámicamente
                    // Por ahora, solo cerramos el modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalServicioExtra'));
                    modal.hide();
                });
            }
        });
    </script>
    <link rel="stylesheet" href="../assets/js/plugins/choices.min.css">
<script src="../assets/js/plugins/choices.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Inicializar el buscador de clientes
        const element = document.getElementById('buscar-cliente');
        if (element) {
            const choices = new Choices(element, {
                searchEnabled: true,
                itemSelectText: 'Presiona para seleccionar',
                noResultsText: 'No se encontraron clientes',
                noChoicesText: 'No hay más clientes disponibles',
                placeholder: true,
                placeholderValue: 'Escriba para buscar cliente...'
            });
        }
    });
</script>
</body>
<!-- [Body] end -->

</html>