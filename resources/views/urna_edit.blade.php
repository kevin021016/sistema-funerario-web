<!doctype html>
<html lang="en">
<title>Editar Urna | #UR-982</title>
@include("layouts.head")

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
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
                                <li class="breadcrumb-item" aria-current="page">Editar Urna</li>
                            </ul>
                        </div>
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <div class="page-header-title">
                                <h2 class="mb-0">Editar Urna: <span class="text-muted f-18">Madera Nogal Clásica</span></h2>
                            </div>
                            <span class="badge bg-light-success text-success f-14">En Stock</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Información del Producto</h5>
                            <small class="text-muted">Última actualización: hace 2 días</small>
                        </div>
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nombre del Modelo</label>
                                        <input type="text" class="form-control" value="Urna de Madera Nogal Clásica">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Código de Barras / SKU</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ti ti-barcode"></i></span>
                                            <input type="text" class="form-control" value="750123456789">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Material / Categoría</label>
                                        <select class="form-select">
                                            <option selected>Madera</option>
                                            <option>Mármol</option>
                                            <option>Cerámica</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Costo de Adquisición</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" value="850.00" step="0.01">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-primary fw-bold">Precio de Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light-primary text-primary">$</span>
                                            <input type="number" class="form-control border-primary" value="2500.00" step="0.01">
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold text-success">Stock Actual</label>
                                        <input type="number" class="form-control border-success" value="12">
                                        <small class="text-muted">Unidades físicas en almacén.</small>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Stock Mínimo</label>
                                        <input type="number" class="form-control" value="3">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Ventas Totales</label>
                                        <input type="text" class="form-control bg-light" value="45" readonly>
                                        <small class="text-muted">Histórico de salidas.</small>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" rows="3">Acabado barniz mate, dimensiones 20x15x15cm. Incluye placa grabada.</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="ti ti-trash"></i> Eliminar del Catálogo
                                    </button>
                                    <div class="gap-2 d-flex">
                                        <button type="button" class="btn btn-light-secondary">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5>Imagen Actual</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="ti ti-package f-50 text-muted"></i>
                            </div>
                            <div class="mb-3 text-start">
                                <label class="form-label small">Reemplazar imagen</label>
                                <input class="form-control form-control-sm" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light-primary shadow-none border-0">
                        <div class="card-body">
                            <h6 class="text-primary mb-3"><i class="ti ti-chart-bar"></i> Rendimiento</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small text-muted">Margen de utilidad:</span>
                                <span class="fw-bold text-dark">$1,650.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-0">
                                <span class="small text-muted">Porcentaje:</span>
                                <span class="fw-bold text-success">194%</span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light-warning small" role="alert">
                        <i class="ti ti-alert-triangle me-1"></i>
                        Si cambias el <b>Precio de Venta</b>, los contratos que ya están firmados no se verán afectados, solo los nuevos.
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>
</html>