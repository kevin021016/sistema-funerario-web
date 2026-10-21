<!doctype html>
<html lang="en">
<title>Agregar Urna | Inventario</title>
@include("layouts.head")

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
                                <li class="breadcrumb-item" aria-current="page">Nueva Urna</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Registrar Nueva Urna</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Información del Producto</h5>
                        </div>
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nombre del Modelo / Referencia</label>
                                        <input type="text" class="form-control"
                                            placeholder="Ej. Urna de Madera Nogal Clásica">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Código de Barras / SKU</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="ti ti-barcode"></i></span>
                                            <input type="text" class="form-control"
                                                placeholder="Escanee o escriba el código">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Material / Categoría</label>
                                        <select class="form-select">
                                            <option selected disabled>Seleccionar...</option>
                                            <option>Madera</option>
                                            <option>Mármol</option>
                                            <option>Cerámica</option>
                                            <option>Biodegradable</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Costo de Adquisición</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                        </div>
                                        <small class="text-muted">Lo que te costó comprarla.</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label text-primary fw-bold">Precio de Venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light-primary text-primary">$</span>
                                            <input type="number" class="form-control border-primary" placeholder="0.00"
                                                step="0.01">
                                        </div>
                                        <small class="text-muted">Precio final al cliente en el contrato.</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Existencia Inicial (Stock)</label>
                                        <input type="number" class="form-control" placeholder="Ej. 10">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Stock Mínimo (Alerta)</label>
                                        <input type="number" class="form-control" placeholder="Ej. 2">
                                        <small class="text-muted">El sistema avisará cuando quede esta cantidad.</small>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Descripción / Notas Adicionales</label>
                                        <textarea class="form-control" rows="3"
                                            placeholder="Detalles sobre el acabado, dimensiones, etc."></textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <button type="button" class="btn btn-light-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar en Inventario</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Imagen del Producto</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="ti ti-photo f-50 text-muted"></i>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label text-muted small">Subir foto de la urna</label>
                                <input class="form-control form-control-sm" type="file" id="formFile">
                            </div>
                            <hr>
                            <div class="alert alert-info small text-start mb-0">
                                <i class="ti ti-info-circle me-1"></i>
                                Al subir una imagen, los asesores podrán mostrar el catálogo digital al cliente antes de
                                la venta.
                            </div>
                        </div>
                    </div>

                    <div class="card border-warning shadow-none" style="border-style: dashed;">
                        <div class="card-body">
                            <h6 class="text-warning"><i class="ti ti-alert-triangle"></i> Control de Stock</h6>
                            <p class="small mb-0">Recuerda que al generar un contrato, el sistema descontará
                                automáticamente una unidad de este modelo.</p>
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