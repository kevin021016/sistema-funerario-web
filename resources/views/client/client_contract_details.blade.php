<!doctype html>
<html lang="en">
<title>Detalles de contrato</title>
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
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('layouts.sidebar')
    @include('layouts.topBar')

    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Lista de contratos</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de contrato</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de contrato</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Información de contrato</h5>
                            <h5 class="mb-0 text-muted">Folio: <span class="text-primary">#000001</span></h5>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tipo de servicio:</label>
                                            <input type="text" class="form-control" value="Cremación Individual"
                                                disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha de venta:</label>
                                            <input type="text" class="form-control" value="08/04/2026" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha de primer pago:</label>
                                            <input type="text" class="form-control" value="15/04/2026" disabled />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Enganche:</label>
                                                    <input type="text" class="form-control" value="$1,500.00"
                                                        disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Estatus:</label>
                                                    <input type="text" class="form-control"
                                                        value="Activo / Al corriente" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Monto total del servicio:</label>
                                            <input type="text" class="form-control" value="$4,200.00" disabled />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre de la mascota:</label>
                                            <input type="text" class="form-control" value="Max" disabled />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipo de mascota:</label>
                                                    <input type="text" class="form-control" value="Canino (Labrador)"
                                                        disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Peso aprox. (kg):</label>
                                                    <input type="text" class="form-control" value="25 kg" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tipo de pago:</label>
                                                    <input type="text" class="form-control" value="Crédito" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Mensualidades:</label>
                                                    <input type="text" class="form-control" value="6 meses" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Método de pago:</label>
                                            <input type="text" class="form-control" value="Transferencia Bancaria"
                                                disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Urna seleccionada:</label>
                                            <input type="text" class="form-control" value="Modelo Madera Clásico"
                                                disabled />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Observaciones del servicio:</label>
                                            <textarea class="form-control" name="observaciones" id="observaciones"
                                                rows="1" style="resize: none; overflow: hidden; min-height: 38px;"
                                                oninput="this.style.height = 'auto'; this.style.height = this.scrollHeight + 'px';"
                                                disabled>El cliente solicita que la placa de la urna tenga el nombre en cursivas. Entrega programada para el próximo viernes.</textarea>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success">Imprimir carátula</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="mb-3 mt-3">Detalles de financiamiento</h4>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>Registro de pagos</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button data-bs-toggle="modal" data-bs-target="#myModal"
                                    class="btn btn-primary mb-3">Agregar pago</button>
                            </div>
                            <div class="custom-scroll-container">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Concepto</th>
                                            <th>Método</th>
                                            <!--<th>Estado</th>-->
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="fw-bold text-primary">0001</span></td>
                                            <td>09/04/2026</td>
                                            <td><span class="fw-bold">$1,500.00</span></td>
                                            <td><span class="badge bg-light-info text-info">Enganche</span></td>
                                            <td>Transferencia</td>
                                            <!--<td><span class="badge bg-light-success text-success">Validado</span>-->
                                            </td>
                                            <td class="text-center">
                                                <ul class="list-inline mb-0">
                                                    <!--
                                                    <li class="list-inline-item m-0">
                                                        <a href="#" class="avtar avtar-s btn btn-info me-1"
                                                            title="Ver Recibo">
                                                            <i class="ti ti-file-text f-18"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item m-0">
                                                        <a href="#" class="avtar avtar-s btn btn-warning me-1"
                                                            title="Editar">
                                                            <i class="ti ti-pencil f-18"></i>
                                                        </a>
                                                    </li>
                                                    -->
                                                    <li class="list-inline-item m-0">
                                                        <form action="" method="POST" style="display:inline;">
                                                            <button type="button"
                                                                class="delete_user avtar avtar-s btn btn-danger"
                                                                title="Anular Pago">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <button class="btn btn-success">Imprimir lista</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Resumen de Cuenta</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Paquete Base:</span>
                                <span class="fw-bold">$1,500.00</span>
                            </div>
                             <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Servicios y Urna:</span>
                                <span class="fw-bold">$3,300.00</span>
                            </div>
                            <div class="d-flex justify-content-between text-danger mb-2">
                                <span>Descuento aplicado:</span>
                                <span>- $600.00</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">Total del Contrato:</h5>
                                <h5 class="mb-0 text-primary">$4,200.00</h5>
                            </div>

                            <div class="bg-light-success p-2 rounded mb-2">
                                <div class="d-flex justify-content-between">
                                    <small class="text-success fw-bold">Total Pagado:</small>
                                    <small class="text-success fw-bold">$1,500.00</small>
                                </div>
                            </div>
                            <div class="bg-light-danger p-2 rounded">
                                <div class="d-flex justify-content-between">
                                    <small class="text-danger fw-bold">Saldo Restante:</small>
                                    <small class="text-danger fw-bold">$2,700.00</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5>Servicios Adicionales y Urna</h5>
                        </div>
                        <div class="card-body">
                            <div class="custom-scroll-container">
                                <table class="table table-sm table-borderless">
                                    <thead class="text-muted">
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Cant.</th>
                                            <th>Precio</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-box me-2 text-primary f-20"></i>
                                                    <div>
                                                        <h6 class="mb-0">Urna de Madera Nogal</h6>
                                                        <small class="text-muted">S/N: 750123456789</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>$2,500.00</td>
                                            <td class="text-end">$2,500.00</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="ti ti-truck me-2 text-primary f-20"></i>
                                                    <div>
                                                        <h6 class="mb-0">Traslado Domicilio</h6>
                                                        <small class="text-muted">Servicio de recolección
                                                            nocturna</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>$800.00</td>
                                            <td class="text-end">$800.00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="border-top">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">Total de Extras:</td>
                                            <td class="text-end fw-bold text-primary">$3,300.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="">

                            <div class="modal-header">
                                <h5 class="modal-title">Agregar pago</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Monto a pagar:</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" placeholder="0.00"
                                                    step="0.01">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fecha del movimiento:</label>
                                            <input type="date" class="form-control" value="2026-04-09">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Método de pago:</label>
                                            <select class="form-select">
                                                <option selected>Efectivo</option>
                                                <option value="1">Transferencia</option>
                                                <option value="2">Tarjeta Débito / Crédito</option>
                                                <option value="3">Depósito</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Referencia / No. de ticket:</label>
                                            <input type="text" class="form-control" placeholder="Ej. T-88291">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Notas del pago:</label>
                                            <textarea class="form-control" rows="2" style="resize: none;"
                                                placeholder="Opcional..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Confirmar pago
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('layouts.footer')
    @include('layouts.scripts')

    <script src="../assets/js/plugins/simple-datatables.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tx = document.getElementById('observaciones');
            if (tx) {
                tx.style.height = 'auto';
                tx.style.height = tx.scrollHeight + 'px';
            }
        });
    </script>
</body>

</html>