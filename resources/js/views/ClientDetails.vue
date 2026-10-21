<template>
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item"><router-link to="/clientes">Lista de clientes</router-link>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de cliente</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div v-if="loading" class="text-center p-5 col-12">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Cargando información...</span>
                    </div>
                    <p class="mt-2 text-muted">Consultando la ficha técnica del cliente...</p>
                </div>

                <div v-else class="col-9">


                    {{ client }}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Información de cliente</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre:</label>
                                            <input type="text" class="form-control" :value="client.nombre" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Apellidos:</label>
                                            <input type="text" class="form-control" :value="client.apellidos"
                                                disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Celular:</label>
                                            <input type="text" class="form-control" :value="client.celular" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Número de teléfono:</label>
                                            <input type="text" class="form-control"
                                                :value="client.telefono || client.celular" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ciudad:</label>
                                            <input type="text" class="form-control" :value="client.ciudad || 'La Paz'"
                                                disabled />
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Colonia:</label>
                                                    <input type="text" class="form-control" :value="client.colonia"
                                                        disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">C.P.:</label>
                                                    <input type="text" class="form-control"
                                                        :value="client.codigo_postal" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Calle:</label>
                                            <input type="text" class="form-control" :value="client.calle" disabled />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Entre calles:</label>
                                            <input type="text" class="form-control" :value="client.entre_calles"
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" @click="printCover">Imprimir
                                    carátula</button>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Contratos del cliente</h5>
                                    <router-link :to="`/NuevoContrato?cliente=${client.id}`"
                                        class="btn btn-primary btn-sm">
                                        <i class="ti ti-plus me-1"></i> Agregar contrato
                                    </router-link>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-scroll-container">
                                                <table class="table table-sm table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Folio</th>
                                                            <th scope="col">Mascota</th>
                                                            <th scope="col">Monto</th>
                                                            <th scope="col">Forma de pago</th>
                                                            <th scope="col">Estado</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="contract in contracts" :key="contract.id">
                                                            <td class="fw-bold">#{{ contract.folio }}</td>
                                                            <td>{{ contract.pet_name }}</td>
                                                            <td>${{ formatCurrency(contract.total_price) }}</td>
                                                            <td>{{ contract.payment_scheme }}</td>
                                                            <td>
                                                                <span
                                                                    :class="['badge', contract.status === 'Liquidado' ? 'bg-light-success text-success' : 'bg-light-warning text-warning']">
                                                                    {{ contract.status }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <ul class="list-inline mb-0 d-flex gap-1">
                                                                    <li class="list-inline-item m-0">
                                                                        <router-link
                                                                            :to="`/DetallesContrato/${contract.id}`"
                                                                            class="avtar avtar-s btn btn-info">
                                                                            <i class="ti ti-eye f-18"></i>
                                                                        </router-link>
                                                                    </li>
                                                                    <li class="list-inline-item m-0">
                                                                        <router-link
                                                                            :to="`/EditarContrato/${contract.id}`"
                                                                            class="avtar avtar-s btn btn-warning">
                                                                            <i class="ti ti-pencil f-18"></i>
                                                                        </router-link>
                                                                    </li>
                                                                    <li class="list-inline-item m-0">
                                                                        <button type="button"
                                                                            class="avtar avtar-s btn btn-danger"
                                                                            @click="confirmDeleteContract(contract.id)">
                                                                            <i class="ti ti-trash f-18"
                                                                                style="color: #ffffffee"></i>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="button" class="btn btn-success mt-3"
                                                @click="printContractsList">Imprimir lista</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card bg-light-info shadow-none">
                                <div class="card-body">
                                    <h6 class="mb-2">Resumen de cuenta</h6>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">Total pagado:</span>
                                        <span class="fw-bold">${{ formatCurrency(mockFinancials.total_paid) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small">Saldo deudor:</span>
                                        <span class="fw-bold text-danger">${{ formatCurrency(mockFinancials.balance_due)
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import PizZip from 'pizzip';
import Docxtemplater from 'docxtemplater';
import JSZipUtils from 'jszip-utils';

const route = useRoute();

// Estados estructurales
const loading = ref(true);
const client = ref({});
const contracts = ref([]);

// Captura de ID desde la ruta de Vue Router (/detallesCliente/:id)
const clientId = route.params.id;

// ==========================================
// ⚡ DATOS FICTICIOS (CONTRATOS Y FINANZAS)
// ==========================================
const mockContracts = ref([
    { id: 1, folio: "000001", mascota: "Max (Labrador)", monto: 4200, forma_pago: "Contado", estado: "Liquidado" },
    { id: 2, folio: "000045", mascota: "Toby (Chihuahua)", monto: 5500, forma_pago: "Parcialidades", estado: "Pendiente" }
]);

const mockFinancials = ref({
    total_paid: 4500.00,
    balance_due: 1200.00
});


// Cabeceras con Token de Sanctum
const getAuthHeaders = () => ({
    headers: {
        'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
        'Accept': 'application/json'
    }
});

// Consultar los datos de tu API SQLite de Laravel
onMounted(async () => {
    try {
        const response = await axios.get(`${CONFIG.API_BASE_URL}/clients/${clientId}`, getAuthHeaders());
        client.value = response.data;

        contracts.value = response.data.contracts || response.data.contratos;

        // Si no trae observaciones la API, forzamos un string por defecto para mantener diseño
    } catch (error) {
        console.error("Error al recuperar los detalles de la base de datos:", error);
        if (window.swal) swal("Error", "No se pudo obtener la ficha del cliente.", "error");
    } finally {
        loading.value = false;
    }
});

// Auto-ajuste de la caja de comentarios (Reemplaza el script de Blade)
/*const autoResizeTextArea = () => {
    nextTick(() => {
        const el = observacionesTextArea.value;
        if (el) {
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        }
    });
};*/

// Métodos para impresión y eliminaciones
const printCover = () => {
    const urlPlantilla = "/plantillas/caratula_cliente.docx";

    if (window.swal) swal("Generando...", "Procesando carátula Word...", "info");

    // 2. Cargar el contenido binario de la plantilla
    JSZipUtils.getBinaryContent(urlPlantilla, (error, content) => {
        if (error) {
            console.error("Error cargando plantilla:", error);
            if (window.swal) swal("Error", "No se encontró el archivo de Word en public/plantillas/", "error");
            return;
        }

        try {
            const zip = new PizZip(content);
            const doc = new Docxtemplater(zip, {
                paragraphLoop: true,
                linebreaks: true,
            });

            // 3. Pasamos los datos del cliente (los que ya tienes en tu ref 'client')
            // OJO: Los nombres aquí deben ser EXACTAMENTE iguales a los que pusiste entre { } en Word
            doc.setData({
                nombre: client.value.nombre || 'N/A',
                apellidos: client.value.apellidos || 'N/A',
                celular: client.value.celular || 'N/A',
                telefono: client.value.telefono || 'N/A',
                ciudad: client.value.ciudad || 'La Paz',
                colonia: client.value.colonia || 'N/A',
                codigo_postal: client.value.codigo_postal || 'N/A',
                calle: client.value.calle || 'N/A',
                entre_calles: client.value.entre_calles || 'N/A',
                fecha: new Date().toLocaleDateString('es-MX')
            });

            // 4. Procesar el documento
            doc.render();

            // 5. Generar el archivo como un objeto descargable
            const out = doc.getZip().generate({
                type: "blob",
                mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            });

            // 6. Descarga automática
            const fileName = `Caratula_${client.value.nombre}_${client.value.id}.docx`;
            const url = window.URL.createObjectURL(out);
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', fileName);
            document.body.appendChild(link);
            link.click();

            // Limpieza de memoria
            link.remove();
            window.URL.revokeObjectURL(url);

            if (window.swal) swal.close();

        } catch (e) {
            console.error("Error al procesar Word:", e);
            if (window.swal) swal("Error", "Hubo un fallo al rellenar los campos del Word.", "error");
        }
    });
};
const printContractsList = () => {
    if (window.swal) swal("Impresión", "Generando archivo de impresión de contratos vinculados...", "info");
};

const deleteUser = async (id) => {
  try {
    const response = await axios.delete(`${CONFIG.API_BASE_URL}/contracts/${id}`, getAuthHeaders());
    if (response.status === 200 || response.status === 204) {
      contracts.value = contracts.value.filter(user => user.id !== id);
      if (window.swal) swal("¡Éxito!", "Usuario eliminado correctamente", "success");
    }
  } catch (error) {
    console.error("Error al eliminar:", error);
    const msg = error.response?.data?.message || "No se pudo eliminar el registro";
    if (window.swal) swal("Error", msg, "error");
  }
};


const confirmDeleteContract = (id) => {
  if (window.swal) {
    swal({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer y afectará los registros de la funeraria.",
      icon: "warning",
      buttons: ["Cancelar", "Sí, eliminar"],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        deleteUser(id);
      }
    });
  } else {
    if (confirm("¿Estás seguro de eliminar este registro?")) {
      deleteUser(id);
    }
  }
};


// Formateador estándar para moneda mexicana (MXN)
const formatCurrency = (val) => {
    return parseFloat(val).toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
};
</script>

<style scoped>
/* Evitar distorsión de altura manual del textarea inhabilitado */
.no-resize-disabled {
    resize: none;
    overflow: hidden;
    min-height: 38px;
    background-color: #f8f9fa !important;
}

.custom-scroll-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    /* Suavidad en móviles */
    display: block;
}
</style>