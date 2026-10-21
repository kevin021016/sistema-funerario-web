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
      <div v-if="isLoading" class="text-center p-5 col-12">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
          <span class="visually-hidden">Cargando información...</span>
        </div>
        <p class="mt-2 text-muted">Consultando la información del contrato...</p>
      </div>
      <div v-else class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5>Configuración de Nuevo Contrato</h5>
            </div>
            <div class="card-body">
              <form @submit.prevent="guardarContrato">

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">1. Selección de Cliente</h6>
                    <label class="form-label">Buscar y Seleccionar Cliente</label>

                    <div class="dropdown">
                      <input type="text" class="form-control dropdown-toggle"
                        placeholder="Escribe el nombre del cliente para buscar..." v-model="busquedaCliente"
                        data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" />

                      <ul class="dropdown-menu w-100 shadow-lg" style="max-height: 200px; overflow-y: auto;">
                        <li v-for="cliente in clientesFiltrados" :key="cliente.id">
                          <button type="button" class="dropdown-item cursor-pointer"
                            @click="seleccionarCliente(cliente)">
                            {{ cliente.nombre }} {{ cliente.apellidos }} — {{ cliente.celular || 'Sin celular' }}
                          </button>
                        </li>
                        <li v-if="clientesFiltrados.length === 0">
                          <span class="dropdown-item text-muted small">No se encontraron clientes</span>
                        </li>
                      </ul>
                    </div>

                    <div v-if="clienteSeleccionado" class="mt-2">
                      <span class="badge bg-light-success text-success p-2">
                        Cliente Seleccionado: <strong>{{ clienteSeleccionado.nombre }} {{ clienteSeleccionado.apellidos
                        }}</strong>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">2. Datos de la Mascota</h6>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" placeholder="Ej. Max" v-model="form.pet_name" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Especie/Raza</label>
                    <input type="text" class="form-control" placeholder="Ej. Canino / Labrador" v-model="form.pet_breed"
                      required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" class="form-control" placeholder="0"
                      v-model.number="form.pet_weight" required>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12">
                    <h6 class="text-primary border-bottom pb-2">3. Paquete y Urna</h6>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Seleccionar Servicio Base</label>
                    <select class="form-select" v-model="form.base_service_id"
                      @change="actualizarPrecioPaquete(); recalcularPagos()" required>
                      <option value="" disabled>Elegir paquete...</option>
                      <option v-for="pkg in catalogo.packages" :key="pkg.id" :value="pkg.id">
                        {{ pkg.name }} - ${{ formatNumber(pkg.default_price) }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Seleccionar Urna (Inventario)</label>
                    <select class="form-select" v-model="form.urn_id" @change="actualizarPrecioUrna">
                      <option value="" disabled>Buscar modelo...</option>
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
                    <div class="custom-scroll-container">
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
                          <tr v-if="serviciosAgregados.length === 0">
                            <td colspan="4" class="text-center text-muted small py-3">No se han añadido servicios
                              adicionales.</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label class="form-label fw-bold">Folio del Contrato (Manual)</label>
                    <input type="text" class="form-control" placeholder="Ej. A-00234" v-model="form.folio" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold">Fecha de Venta</label>
                    <input type="date" class="form-control" v-model="form.sale_date" required>
                  </div>
                  <div class="col-md-4" v-if="form.payment_scheme === '2'">
                    <label class="form-label fw-bold text-primary">Fecha del primer Pago</label>
                    <input type="date" class="form-control" v-model="form.first_payment_date" required>
                    <small class="text-muted" style="font-size: 0.75rem;">Aplica después del enganche.</small>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card bg-primary text-white shadow-sm mb-4">
            <div class="card-body">
              <h5>Resumen de Cobro</h5>
              <div class="mt-4">
                <div class="d-flex justify-content-between mb-2">
                  <span>Subtotal Servicios:</span>
                  <span>${{ formatNumber(form.subtotal_services) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Urna:</span>
                  <span>${{ formatNumber(form.urn_price) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span>Extras:</span>
                  <span>${{ formatNumber(form.subtotal_extras) }}</span>
                </div>
                <hr class="bg-white opacity-25">
                <div class="d-flex justify-content-between mb-3">
                  <span class="h5 text-white">Total Final:</span>
                  <span class="h5 text-white">${{ formatNumber(totalFinal) }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label">Esquema de Pago</label>
                <select class="form-select" v-model="form.payment_scheme" @change="cambiarEsquema">
                  <option value="1">Contado (Liquidación inmediata)</option>
                  <option value="2">Crédito (Pagos parciales)</option>
                </select>
              </div>

              <div v-if="form.payment_scheme === '2'">
                <div class="mb-3">
                  <label class="form-label fw-bold text-success">Monto de importe</label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" class="form-control" v-model="form.payment_amount"
                      @change="recalcularPagos">
                  </div>
                  <small class="text-muted" v-if="form.payment_scheme === '1'">
                    Puedes dejarlo en $0.00 si liquidará en otra ocasión.
                  </small>
                </div>
                <div class="mb-3">
                  <label class="form-label">Periodicidad de pagos</label>
                  <select class="form-select" v-model="form.payment_frequency" @change="recalcularPagos">
                    <option value="semanal">Semanal</option>
                    <option value="quincenal">Quincenal</option>
                    <option value="mensual">Mensual</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Número de pagos / Plazo</label>
                  <div class="input-group">
                    <input type="number" class="form-control" v-model.number="form.total_payments" min="1">
                    <span class="input-group-text">pagos</span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold text-success">
                  {{ form.payment_scheme === '1' ? 'Monto a Abonar (Hoy)' : 'Monto de Enganche' }}
                </label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" step="0.01" class="form-control" v-model.number="form.down_payment"
                    @change="recalcularPagos">
                </div>
                <small class="text-muted" v-if="form.payment_scheme === '1'">
                  Puedes dejarlo en $0.00 si liquidará en otra ocasión.
                </small>
              </div>

              <button type="button" class="btn btn-primary w-100 shadow mt-2" :disabled="saving"
                @click="guardarContrato">
                <span v-if="saving" class="spinner-border spinner-border-sm me-1"></span>
                Generar Contrato y Folio
              </button>
              <p class="text-muted small text-center mt-3 mb-0">
                Al generar, se descontará 1 unidad de la urna del inventario.
              </p>
            </div>
          </div>
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
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" v-model.number="modalData.agreed_price">
              </div>
              <small class="text-muted">Puedes ajustar el precio manualmente si es necesario.</small>
            </div>
            <div class="mb-3">
              <label class="form-label">Notas o detalles</label>
              <textarea class="form-control" rows="2" placeholder="Ej. Recolección en Clínica San José"
                v-model="modalData.notes"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
              @click="agregarServicioExtraAContrato">Agregar al contrato</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

// Estados globales de control de UI
const saving = ref(false);
const listaClientes = ref([]);
const busquedaCliente = ref('');
const clienteSeleccionado = ref(null);
const isLoading = ref(true);

const catalogo = reactive({
  packages: [],
  extras: [],
  urns: []
});

// Estructura Reactiva del Formulario
const form = reactive({
  folio: '',
  sale_date: new Date().toISOString().split('T')[0], // Asigna hoy por defecto
  first_payment_date: '',
  client_id: '',
  pet_name: '',
  pet_breed: '',
  pet_weight: 0,
  base_service_id: '',
  urn_id: '',
  subtotal_services: 0,
  urn_price: 0,
  subtotal_extras: 0,
  total_price: 0,
  payment_amount: 0,
  payment_scheme: '1',
  payment_frequency: 'unico',
  total_payments: 1,
  down_payment: 0,
  additional_services: []
});

// Estado de la data intermedia del modal
const serviciosAgregados = ref([]);
const modalData = reactive({
  selected_id: '',
  name: '',
  agreed_price: 0,
  notes: ''
});

// Encabezados seguros usando las variables del storage del proyecto
const getAuthHeaders = () => ({
  headers: {
    'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
    'Accept': 'application/json'
  }
});

// Filtrado del buscador
const clientesFiltrados = computed(() => {
  if (!busquedaCliente.value) return listaClientes.value;
  const query = busquedaCliente.value.toLowerCase();
  return listaClientes.value.filter(c =>
    c.nombre.toLowerCase().includes(query) ||
    (c.apellidos && c.apellidos.toLowerCase().includes(query))
  );
});

const seleccionarCliente = (cliente) => {
  clienteSeleccionado.value = cliente;
  form.client_id = cliente.id;
  busquedaCliente.value = `${cliente.nombre} ${cliente.apellidos || ''}`;
};

// Carga de catálogos y clientes iniciales utilizando CONFIG.API_BASE_URL
onMounted(async () => {
  isLoading.value = true;
  try {
    // Ejecutamos ambas peticiones en paralelo para mayor velocidad
    const [resClientes, resCat] = await Promise.all([
      axios.get(`${CONFIG.API_BASE_URL}/clients`, getAuthHeaders()),
      axios.get(`${CONFIG.API_BASE_URL}/contracts/create`, getAuthHeaders())
    ]);

    // Asignación de datos
    listaClientes.value = resClientes.data;
    catalogo.packages = resCat.data.packages;
    catalogo.extras = resCat.data.extras;
    catalogo.urns = resCat.data.urns;

  } catch (error) {
    console.error("Error al cargar componentes del contrato:", error);
    if (window.swal) {
      swal("Error", "No se pudieron iniciar los catálogos del servicio.", "error");
    }
  } finally {
    // Independientemente de si hubo éxito o error, ocultamos el loader
    isLoading.value = false;
  }
});
// Control de cálculos financieros reactivos
const totalFinal = computed(() => {
  const total = form.subtotal_services + form.urn_price + form.subtotal_extras;
  form.total_price = total;
  return total;
});

const actualizarPrecioPaquete = () => {
  const pkg = catalogo.packages.find(p => p.id === form.base_service_id);
  if (pkg) form.subtotal_services = parseFloat(pkg.default_price);
};

const actualizarPrecioUrna = () => {
  const urna = catalogo.urns.find(u => u.id === form.urn_id);
  if (urna) form.urn_price = 0; // Ajustar si las urnas tienen valor comercial extra
};

// Función para recalcular los pagos en base a la frecuencia y el total
const recalcularPagos = () => {
  // Asegurarnos de que hay un total a dividir, para evitar dividir por 0
  if (totalFinal.value > 0) {
    form.total_payments = Math.ceil((totalFinal.value - form.down_payment) / form.payment_amount);
  } else {
    form.total_payments = 1; // Valor por defecto si el total es 0
  }
};
const cambiarEsquema = () => {
  if (form.payment_scheme === '1') {
    form.payment_frequency = 'unico';
    form.total_payments = 1;
    form.down_payment = 0;
  } else {
    form.payment_frequency = 'quincenal';
    recalcularPagos();
    form.down_payment = 0;
  }
};

// Preparar campos limpios del modal al abrir
const abrirModalExtra = () => {
  modalData.selected_id = '';
  modalData.name = '';
  modalData.agreed_price = 0;
  modalData.notes = '';
};

const actualizarPrecioSugeridoModal = () => {
  const ext = catalogo.extras.find(e => e.id === modalData.selected_id);
  if (ext) {
    modalData.name = ext.name;
    modalData.agreed_price = parseFloat(ext.default_price);
  }
};

const agregarServicioExtraAContrato = () => {
  if (!modalData.selected_id) return;

  serviciosAgregados.value.push({
    id: modalData.selected_id,
    name: modalData.name,
    agreed_price: modalData.agreed_price,
    notes: modalData.notes
  });

  form.additional_services.push({
    service_id: modalData.selected_id,
    name: modalData.name,
    agreed_price: modalData.agreed_price,
    notes: modalData.notes
  });

  form.subtotal_extras += modalData.agreed_price;
};

const eliminarServicioExtra = (index) => {
  const eliminado = serviciosAgregados.value[index];
  form.subtotal_extras -= eliminado.agreed_price;
  serviciosAgregados.value.splice(index, 1);
  form.additional_services.splice(index, 1);
};

// Guardar Contrato mediante la API
const guardarContrato = async () => {
  if (!form.client_id) {
    if (window.swal) swal("Atención", "Por favor, selecciona un cliente primero.", "warning");
    return;
  }

  saving.value = true;
  try {
    const response = await axios.post(`${CONFIG.API_BASE_URL}/contracts`, form, getAuthHeaders());
    if (response.status === 201 || response.status === 200) {
      if (window.swal) {
        swal("¡Contrato Creado!", `El contrato con folio ${response.data.contract.folio} ha sido generado exitosamente.`, "success")
          .then(() => router.push('/contratos'));
      } else {
        router.push('/contratos');
      }
    }
  } catch (error) {
    console.error("Error al registrar contrato funerario:", error);
    const msg = error.response?.data?.message || "Ocurrió un error en el servidor.";
    if (window.swal) swal("Error", msg, "error");
  } finally {
    saving.value = false;
  }
};

// Formateador estético de números
const formatNumber = (val) => {
  return isNaN(parseFloat(val)) ? '0.00' : parseFloat(val).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
};
</script>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}

.custom-scroll-container {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
</style>