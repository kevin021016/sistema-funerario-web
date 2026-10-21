<!doctype html>
<html lang="en">
<title>Detalles de Urna | #UR-982</title>
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
                                <li class="breadcrumb-item"><a href="./Inventario">Inventario</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de Urna</li>
                            </ul>
                        </div>
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <div class="page-header-title">
                                <h2 class="mb-0">Expediente de Producto</h2>
                            </div>
                            <div>
                                <a href="./EditarUrna/1" class="btn btn-warning"><i class="ti ti-pencil me-1"></i>
                                    Editar Producto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center border-end">
                                    <div class="chat-avtar d-inline-flex mx-auto border p-3 rounded bg-light mb-3">
                                        <i class="ti ti-package f-50 text-muted"></i>
                                    </div>
                                    <h4 class="mb-1">Madera Nogal</h4>
                                    <p class="text-muted small">ID: UR-982-2026</p>
                                    <span class="badge bg-light-success text-success">Disponible en Stock</span>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="mb-3">Especificaciones Técnicas</h5>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <p class="mb-0 text-muted small">Material:</p>
                                            <h6>Madera Sólida de Nogal</h6>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-0 text-muted small">Acabado:</p>
                                            <h6>Barniz Mate / Placa Bronce</h6>
                                        </div>
                                        <div class="col-12 border-top pt-2">
                                            <p class="mb-0 text-muted small">Descripción:</p>
                                            <p class="mb-0">Urna de alta calidad tallada a mano, dimensiones 25x15x15cm.
                                                Incluye compartimento para fotografía de la mascota.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Historial de Salidas (Contratos)</h5>
                        </div>
                        <div class="card-body px-0 py-2">
                            <div class="custom-scroll-container">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Folio Contrato</th>
                                            <th>Fecha Venta</th>
                                            <th>Cliente</th>
                                            <th>Mascota</th>
                                            <th class="text-end">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#" class="fw-bold">#000045</a></td>
                                            <td>12/04/2026</td>
                                            <td>Juan Perez</td>
                                            <td>Rex</td>
                                            <td class="text-end"><a href="#" class="btn btn-sm btn-light-info"><i
                                                        class="ti ti-eye"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="#" class="fw-bold">#000038</a></td>
                                            <td>05/04/2026</td>
                                            <td>Maria Lopez</td>
                                            <td>Luna</td>
                                            <td class="text-end"><a href="#" class="btn btn-sm btn-light-info"><i
                                                        class="ti ti-eye"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="mb-0">Precios</h5>
                                <i class="ti ti-currency-dollar f-20 text-primary"></i>
                            </div>
                            <div class="mb-2 d-flex justify-content-between">
                                <span class="text-muted small">Precio Venta:</span>
                                <span class="h5 mb-0">$2,500.00</span>
                            </div>
                            <div class="mb-2 d-flex justify-content-between">
                                <span class="text-muted small">Costo:</span>
                                <span class="text-muted fw-bold">$850.00</span>
                            </div>
                            <hr>
                            <div class="bg-light-primary p-2 rounded text-center">
                                <p class="mb-0 small text-primary fw-bold">Margen: 194% ($1,650.00)</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="text-muted mb-3">Inventario Físico</h6>
                            <div class="row align-items-center">
                                <div class="col-6 border-end">
                                    <h2 class="mb-0">12</h2>
                                    <p class="text-muted small mb-0">En Almacén</p>
                                </div>
                                <div class="col-6">
                                    <h2 class="mb-0 text-info">45</h2>
                                    <p class="text-muted small mb-0">Vendidas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <i class="ti ti-barcode f-40 mb-2"></i>
                            <h5 class="text-white mb-0">750123456789</h5>
                            <small class="text-white text-opacity-50">SKU de Almacén</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>