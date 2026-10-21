<!doctype html>
<html lang="en">
<!-- [Head] start -->
<title>Inicio</title>
@include('layouts.head')

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
  <!-- [ Sidebar Menu ] start -->
  @include('layouts.sidebar')
  <!-- [ Sidebar Menu ] end -->
  <!-- [ Header Topbar ] start -->
  @include('layouts.topbar')
  <!-- [ Header ] end -->



  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Home</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <div class="card statistics-card-1 overflow-hidden">
            <div class="card-body">
              <img src="../assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4">Ingresos Mensuales</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="f-w-300 d-flex align-items-center m-b-0">$45,249.00</h3>
                <span class="badge bg-light-success ms-2">12% vs mes anterior</span>
              </div>
              <p class="text-muted mb-2 text-sm mt-3">Monto total de contratos cerrados este mes</p>
              <div class="progress" style="height: 7px">
                <div class="progress-bar bg-brand-color-3" role="progressbar" style="width: 75%"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card statistics-card-1 overflow-hidden">
            <div class="card-body">
              <img src="../assets/images/widget/img-status-5.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4">Margen de Ganancia</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="f-w-300 d-flex align-items-center m-b-0">64.5%</h3>
                <span class="badge bg-light-primary ms-2">Saludable</span>
              </div>
              <p class="text-muted mb-2 text-sm mt-3">Utilidad neta restando costo de urnas y servicios</p>
              <div class="progress" style="height: 7px">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 64%"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-12">
          <div class="card statistics-card-1 overflow-hidden bg-danger">
            <div class="card-body">
              <img src="../assets/images/widget/img-status-6.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4 text-white">Saldo Pendiente Total</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">$12,800.00</h3>
              </div>
              <p class="text-white text-opacity-75 mb-2 text-sm mt-3">Dinero pendiente en contratos a crédito</p>
              <div class="progress bg-white bg-opacity-10" style="height: 7px">
                <div class="progress-bar bg-white" role="progressbar" style="width: 30%"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
    <div class="col-md-7 col-xl-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Estado de Servicios (Cremaciones)</h5>
                <i class="ph-duotone ph-creature f-20 text-muted"></i>
            </div>
            <div class="card-body">
                <div class="custom-scroll-container">
                   <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Folio / Mascota</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Estado Pago</th>
                                <th class="text-end">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="mb-0">#00045</h6>
                                    <p class="text-muted mb-0 small">Rocky (Canino)</p>
                                </td>
                                <td>Luis Perez</td>
                                <td class="fw-bold">$4,200.00</td>
                                <td><span class="badge bg-light-success text-success">Liquidado</span></td>
                                <td class="text-end">
                                    <a href="./DetallesContrato/45" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-18"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0">#00046</h6>
                                    <p class="text-muted mb-0 small">Luna (Felino)</p>
                                </td>
                                <td>Andrés López</td>
                                <td class="fw-bold">$2,800.00</td>
                                <td><span class="badge bg-light-warning text-warning">Pendiente</span></td>
                                <td class="text-end">
                                    <a href="./DetallesContrato/46" class="avtar avtar-xs btn-link-secondary"><i class="ti ti-eye f-18"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-xl-4">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h5>Cobranza del día</h5>
            </div>
            <div class="card-body">
                <div class="bg-light-danger p-3 rounded mb-3">
                    <div class="d-flex align-items-center">
                        <div class="avtar avtar-s bg-danger text-white flex-shrink-0">
                            <i class="ti ti-calendar-event f-20"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-danger">5 Pagos Vencidos</h6>
                            <p class="mb-0 small text-danger">Total: $3,250.00</p>
                        </div>
                    </div>
                </div>
                
                <h6 class="mb-3">Próximos a vencer (Hoy):</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Andrés López</h6>
                        <p class="text-muted mb-0 small">Folio #00021 - Pago 3/6</p>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-0">$750.00</h6>
                        <a href="https://wa.me/5212345678" class="text-success small"><i class="ti ti-brand-whatsapp"></i> Recordar</a>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-0">Oscar Valadez</h6>
                        <p class="text-muted mb-0 small">Folio #00015 - Pago 1/4</p>
                    </div>
                    <div class="text-end">
                        <h6 class="mb-0">$1,200.00</h6>
                        <a href="#" class="text-success small"><i class="ti ti-brand-whatsapp"></i> Recordar</a>
                    </div>
                </div>
                <button class="btn btn-outline-secondary w-100 btn-sm mt-2">Ver agenda completa</button>
            </div>
        </div>
        
        <div class="card bg-brand-color-3 text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="ti ti-package f-30 text-white-50"></i>
                    <div class="ms-3">
                        <h4 class="text-white mb-0">12 Urnas</h4>
                        <p class="mb-0 text-white text-opacity-75 small">Stock por debajo del mínimo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->
  @include('layouts.footer')

  <!-- SETTINGS -->
  <!-- Scripts start -->
  @include('layouts.scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var options = {
        series: [45, 30, 25], // Los porcentajes de Madera, Mármol y Otras
        chart: {
          type: 'donut',
          height: 300,
        },
        labels: ['Madera', 'Mármol', 'Otras'],
        colors: ['#007bff', '#28a745', '#ffc107'], // Azul, Verde, Amarillo
        legend: {
          show: false // La ocultamos porque ya tienes los datos abajo
        },
        plotOptions: {
          pie: {
            donut: {
              size: '70%',
              labels: {
                show: true,
                total: {
                  show: true,
                  label: 'Total Urnas',
                  formatter: function (w) {
                    return '100%' // O el número total de piezas
                  }
                }
              }
            }
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: false
        }
      };

      var chart = new ApexCharts(document.querySelector("#urnas-populares-chart"), options);
      chart.render();
    });
  </script>
  <!-- Scripts end -->

</body>
<!-- [Body] end -->

</html>