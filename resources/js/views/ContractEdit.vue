<template>
  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item"><router-link to="/clientes">Lista de usuarios</router-link></li>
                <li class="breadcrumb-item" aria-current="page">Editar contrato</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Editar contrato: {{ form.folio }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="cargando" class="text-center py-5">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">Obteniendo información del servidor...</p>
      </div>

      <div v-else class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5>Configuración de Contrato</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizarContrato">

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">1. Cliente</h6>
                    <div class="alert alert-secondary">
                      <i class="ti ti-user me-2"></i>
                      <strong>{{ clienteNombre }}</strong>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">2. Datos de la Mascota</h6>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" v-model="form.pet_name" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Especie/Raza</label>
                    <input type="text" class="form-control" v-model="form.pet_breed" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" class="form-control" v-model.number="form.pet_weight" required>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">3. Paquete y Urna</h6>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Seleccionar Servicio Base</label>
                    <select class="form-select" v-model="form.base_service_id" @change="actualizarPrecioPaquete"
                      required>
                      <option v-for="pkg in catalogo.packages" :key="pkg.id" :value="pkg.id">
                        {{ pkg.name }} - ${{ formatNumber(pkg.default_price) }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Seleccionar Urna (Inventario)</label>
                    <select class="form-select" v-model="form.urn_id">
                      <option :value="null">Ninguna / Pendiente</option>
                      <option v-for="urn in catalogo.urns" :key="urn.id" :value="urn.id">
                        {{ urn.model_name }} (Stock: {{ urn.stock }})
                      </option>
                    </select>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12 d-flex justify-content-between align-items-center mb-2">
                    <h6 class="text-primary border-bottom pb-2 flex-grow-1 mb-0">4. Servicios Adicionales</h6>
                    <button type="button" class="btn btn-sm btn-light-primary ms-2" data-bs-toggle="modal"
                      data-bs-target="#modalServiciosExtras" @click="abrirModalExtra">
                      <i class="ti ti-plus"></i> Añadir
                    </button>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-sm">
                      <thead class="bg-light">
                        <tr>
                          <th>Servicio</th>
                          <th>Notas</th>
                          <th>Costo</th>
                          <th class="text-end">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(srv, index) in serviciosAgregados" :key="index">
                          <td>{{ srv.name }}</td>
                          <td>{{ srv.notes || '-' }}</td>
                          <td>${{ formatNumber(srv.agreed_price) }}</td>
                          <td class="text-end">
                            <span class="text-danger cursor-pointer small" @click="eliminarServicioExtra(index)">
                              <i class="ti ti-trash"></i> Eliminar
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">5. Configuración de Financiamiento</h6>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Esquema de Pago</label>
                    <select class="form-select" v-model="form.payment_scheme"
                      :disabled="hasPaymentsRegistered && originalPaymentScheme === '2'" @change="cambiarEsquema">
                      <option value="1">Contado (Liquidación inmediata)</option>
                      <option value="2">Crédito (Pagos parciales)</option>
                    </select>
                    <small v-if="hasPaymentsRegistered && originalPaymentScheme === '2'"
                      class="text-danger d-block mt-1">
                      <i class="ti ti-alert-circle"></i> No puedes cambiar a Contado porque este contrato ya tiene
                      abonos registrados.
                    </small>
                  </div>

                  <!-- Estos campos solo se muestran si el esquema es Crédito -->
                  <template v-if="form.payment_scheme === '2'">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Monto por recibo ($)</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
                        <input type="number" step="0.01" class="form-control" v-model.number.lazy="form.payment_amount"
                          required>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Total de pagos proyectados</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-calendar-time"></i></span>
                        <input type="number" class="form-control bg-light" v-model.number="form.total_payments"
                          readonly>
                      </div>
                      <small class="text-muted d-block mt-1">Calculado restando el enganche (${{
                        formatNumber(form.down_payment) }}).</small>
                    </div>
                  </template>
                </div>

                <div class="row mb-2">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">6. Fechas del Contrato</h6>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de Venta</label>
                    <input type="date" class="form-control" v-model="form.sale_date" required>
                  </div>
                  <div class="col-md-6 mb-3" v-if="form.payment_scheme === '2'">
                    <label class="form-label">Fecha de Primer Pago</label>
                    <input type="date" class="form-control" v-model="form.first_payment_date">
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">
              <h5>Resumen de Cobro</h5>
              <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                  <span>Subtotal Servicios:</span>
                  <span>${{ formatNumber(form.subtotal_services) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Extras:</span>
                  <span>${{ formatNumber(form.subtotal_extras) }}</span>
                </div>
                <hr class="bg-white">
                <div class="d-flex justify-content-between">
                  <span class="h5 text-white">Total Final:</span>
                  <span class="h5 text-white">${{ formatNumber(totalFinal) }}</span>
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-primary w-100 shadow" :disabled="saving" @click="actualizarContrato">
            <span v-if="saving" class="spinner-border spinner-border-sm me-1"></span>
            Guardar Cambios
          </button>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalServiciosExtras" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Añadir Servicio Adicional</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Seleccionar Servicio</label>
              <select class="form-select" v-model="modalData.selected_id" @change="actualizarPrecioSugeridoModal">
                <option value="" disabled>Elegir del catálogo...</option>
                <option v-for="ext in catalogo.extras" :key="ext.id" :value="ext.id">
                  {{ ext.name }} - ${{ formatNumber(ext.default_price) }}
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Costo Confirmado</label>
              <input type="number" class="form-control" v-model.number="modalData.agreed_price">
            </div>
            <div class="mb-3">
              <label class="form-label">Notas</label>
              <textarea class="form-control" rows="2" v-model="modalData.notes"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
              @click="agregarServicioExtraAContrato">Añadir</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Importamos 'watch' de Vue
import { ref, reactive, computed, onMounted, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const route = useRoute();
const contractId = route.params.id; // Asegúrate que tu ruta sea /contratos/editar/:id

const cargando = ref(true);
const saving = ref(false);
const clienteNombre = ref('');

const catalogo = reactive({ packages: [], extras: [], urns: [] });

const form = reactive({
  pet_name: '',
  pet_breed: '',
  pet_weight: 0,
  base_service_id: '',
  urn_id: null,
  total_price: 0,
  additional_services: [],
  // Variables financieras añadidas al estado
  payment_amount: 0,
  down_payment: 0,
  total_payments: 0,
  // Auxiliares
  folio: '',
  subtotal_services: 0,
  subtotal_extras: 0,
  sale_date: '',
  first_payment_date: '',
  payment_scheme: '1',
  payment_frequency: 'unico',
});

const hasPaymentsRegistered = ref(false);
const originalPaymentScheme = ref('');
const serviciosAgregados = ref([]);
const modalData = reactive({ selected_id: '', name: '', agreed_price: 0, notes: '' });

const getAuthHeaders = () => ({
  headers: {
    'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
    'Accept': 'application/json'
  }
});

onMounted(async () => {
  try {
    // 1. Obtener catálogos
    const resCat = await axios.get(`${CONFIG.API_BASE_URL}/contracts/create`, getAuthHeaders());
    catalogo.packages = resCat.data.packages;
    catalogo.extras = resCat.data.extras;
    catalogo.urns = resCat.data.urns;

    // 2. Obtener datos del contrato
    const resCon = await axios.get(`${CONFIG.API_BASE_URL}/contracts/${contractId}`, getAuthHeaders());

    // DEBUG: Mira esto en tu consola (F12)
    console.log("Respuesta completa de la API:", resCon.data);

    // Intentamos obtener el objeto contrato buscando en diferentes posibles llaves
    const c = resCon.data.contract || resCon.data.data || resCon.data;

    if (!c || !c.folio) {
      throw new Error("No se encontró la información del contrato en la respuesta.");
    }

    // 3. Mapear datos al formulario
    form.folio = c.folio;
    form.pet_name = c.pet_name;
    form.pet_breed = c.pet_breed;
    form.pet_weight = parseFloat(c.pet_weight);
    form.base_service_id = c.base_service_id;
    form.urn_id = c.urn_id;
    form.sale_date = c.sale_date ? c.sale_date.split('T')[0] : '';
    form.first_payment_date = c.first_payment_date ? c.first_payment_date.split('T')[0] : '';
    form.payment_scheme = String(c.payment_scheme);
    form.payment_frequency = c.payment_frequency || 'unico';

    // Rellenamos las variables financieras desde la base de datos
    form.payment_amount = parseFloat(c.payment_amount || 0);
    form.down_payment = parseFloat(c.down_payment || 0);
    form.total_payments = parseInt(c.total_payments || 1);

    // Cliente
    if (c.client) {
      clienteNombre.value = `${c.client.nombre} ${c.client.apellidos}`;
    }

    originalPaymentScheme.value = String(c.payment_scheme);
    if (c.payments && c.payments.length > 0) {
        hasPaymentsRegistered.value = true;
    }

    // 4. Mapear servicios adicionales (JSON)
    const rawExtras = c.additional_services_json;
    if (rawExtras) {
      // Laravel a veces devuelve el JSON como string y otras como objeto/array ya casteado
      const parsedExtras = typeof rawExtras === 'string' ? JSON.parse(rawExtras) : rawExtras;
      serviciosAgregados.value = parsedExtras;
      form.additional_services = parsedExtras;
      form.subtotal_extras = parsedExtras.reduce((acc, s) => acc + parseFloat(s.agreed_price), 0);
    }

    // Recalcular subtotal de paquete
    actualizarPrecioPaquete();

    cargando.value = false;
  } catch (error) {
    console.error("Error detallado al cargar:", error);
    if (window.swal) swal("Error", "No se pudo cargar el contrato", "error");
    router.push('/clientes');
  }
});

const totalFinal = computed(() => {
  const total = parseFloat(form.subtotal_services || 0) + parseFloat(form.subtotal_extras || 0);
  form.total_price = total;
  return total;
});

const actualizarPrecioPaquete = () => {
  const pkg = catalogo.packages.find(p => p.id === form.base_service_id);
  if (pkg) form.subtotal_services = parseFloat(pkg.default_price);
};

const abrirModalExtra = () => { modalData.selected_id = ''; modalData.agreed_price = 0; modalData.notes = ''; };
const actualizarPrecioSugeridoModal = () => {
  const ext = catalogo.extras.find(e => e.id === modalData.selected_id);
  if (ext) { modalData.name = ext.name; modalData.agreed_price = ext.default_price; }
};

const agregarServicioExtraAContrato = () => {
  if (!modalData.selected_id) return;
  const nuevo = { service_id: modalData.selected_id, name: modalData.name, agreed_price: modalData.agreed_price, notes: modalData.notes };
  serviciosAgregados.value.push(nuevo);
  form.additional_services = serviciosAgregados.value;
  form.subtotal_extras += nuevo.agreed_price;
};

const eliminarServicioExtra = (index) => {
  form.subtotal_extras -= serviciosAgregados.value[index].agreed_price;
  serviciosAgregados.value.splice(index, 1);
  form.additional_services = serviciosAgregados.value;
};

const recalcularPagos = () => {
  // Asegurarnos de que el monto por pago no sea cero para evitar Infinity
  if (totalFinal.value > 0 && form.payment_amount > 0) {
    form.total_payments = Math.ceil((totalFinal.value - form.down_payment) / form.payment_amount);
  } else {
    form.total_payments = 1;
  }
};

// VIGILANTE: Si el monto ingresado o el total del contrato cambian, ejecuta el recálculo
watch([() => form.payment_amount, () => totalFinal.value], () => {
  recalcularPagos();
});

const actualizarContrato = async () => {
  saving.value = true;
  try {
    // IMPORTANTE: Enviamos el PUT con el objeto form
    await axios.put(`${CONFIG.API_BASE_URL}/contracts/${contractId}`, form, getAuthHeaders());
    if (window.swal) {
      swal("¡Éxito!", "Contrato actualizado", "success").then(() => router.push('/contratos'));
    } else {
      router.push('/contratos');
    }
  } catch (error) {
    const msg = error.response?.data?.message || "Error al actualizar";
    if (window.swal) swal("Error", msg, "error");
  } finally {
    saving.value = false;
  }
};

const formatNumber = (val) => parseFloat(val || 0).toLocaleString('es-MX', { minimumFractionDigits: 2 });
</script>