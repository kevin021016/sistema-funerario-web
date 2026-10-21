<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Lista de clientes</title>
@include('layouts.head')
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
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.sidebar')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    @include('layouts.topbar')
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div id="listaClientes">
        <div id="clients" class="pc-container" v-cloak>
            <div class="pc-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Lista de clientes</li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0">Lista de clientes</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <!-- [ Main Content ] start -->
                <div class="row">

                    <div v-if="loading" class="text-center p-5">
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-2 text-muted">Cargando lista de clientes...</p>
                    </div>

                    <div v-else class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                            <div class="input-group" style="max-width: 350px;">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="ti ti-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0"
                                    placeholder="Buscar por nombre, email o rol..." v-model="search">
                            </div>
                            <div class="d-flex gap-2">
                                <a href="./CrearUsuario" class="btn btn-primary d-inline-flex align-items-center">
                                    <i class="ti ti-plus me-1"></i> Agregar cliente
                                </a>
                            </div>
                        </div>
                        <div class="custom-scroll-container">
                            <table class="table table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Teléfono</th>
                                        <th>colonia</th>
                                        <th>C.P</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="user in filteredClients" :key="user.id">
                                        <td>
                                            <div class="d-inline-block">
                                                <h6 class="m-b-0">@{{ user.nombre }}</h6>
                                                <p class="m-b-0 text-primary">@{{ user.celular }}</p>
                                            </div>
                                        </td>
                                        <td>@{{ user.apellidos }}</td>
                                        <td>@{{ user.telefono }}</td>
                                        <td>@{{ user.colonia}}</td>
                                        <td>@{{ user.codigo_postal}}</td>
                                        <td>
                                            <ul class="list-inline mb-0 d-flex gap-2">
                                                <li class="list-inline-item m-0">
                                                    <a :href="'{{ url('/EditarUsuario') }}/' + user.id"
                                                        class="avtar avtar-s btn btn-warning">
                                                        <i class="ti ti-pencil f-18"></i>
                                                    </a>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <button @click="confirmDelete(user.id)" type="button"
                                                        class="delete_user avtar avtar-s btn btn-danger">
                                                        <i class="ti ti-trash f-18" style="color: #ffffffee"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <button class="btn btn-success d-inline-flex align-items-center" @click="generatePDF">
                            <i class="ti ti-file-text me-1"></i> Imprimir lista
                        </button>
                        <button class="btn btn-light-success d-inline-flex align-items-center ms-2" @click="exportToExcel">
                            <i class="ti ti-table me-1"></i> Exportar Excel
                        </button>
                    </div>

                    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pdfModalLabel">Vista Previa del Reporte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background: #525659;">
                                    <iframe id="pdfPreview" style="width: 100%; height: 75vh; border: none;"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ sample-page ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer')


    <!-- Scripts start -->
    @include('layouts.scripts')
    <!-- Scripts end -->
    <!-- [Page Specific JS] start -->
    <script src="../assets/js/plugins/simple-datatables.js"></script>
    <script src="{{ asset('assets/js/vue/clients.js') }}"></script>


 
    <!-- [Page Specific JS] end -->

</body>
<!-- [Body] end -->

</html>