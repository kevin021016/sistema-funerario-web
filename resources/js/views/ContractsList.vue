<template>
  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item" aria-current="page">Lista de contratos</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Lista de contratos</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div v-if="loading" class="text-center p-5">
          <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Cargando...</span>
          </div>
          <p class="mt-2 text-muted">Cargando lista de contratos...</p>
        </div>

        <div v-else class="card-body">
          <!-- Barra de Herramientas y Filtros Extendida -->
          <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div class="d-flex align-items-center flex-wrap gap-2 flex-grow-1" style="max-width: 800px;">

              <!-- Input de Búsqueda -->
              <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-transparent border-end-0">
                  <i class="ti ti-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Buscar por folio..."
                  v-model="search">
              </div>

              <!-- Filtro de Orden -->
              <div style="min-width: 160px;">
                <select class="form-select" v-model="orderBy">
                  <option value="recent">Más reciente</option>
                  <option value="oldest">Más antiguo</option>
                </select>
              </div>
            </div>

            <div class="d-flex gap-2">
              <router-link to="/crearContrato" class="btn btn-primary d-inline-flex align-items-center">
                <i class="ti ti-plus me-1"></i> Agregar contrato
              </router-link>
            </div>
          </div>

          <div class="custom-scroll-container">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Nombre de mascota</th>
                  <th>Servicios</th>
                  <th>Servicios extras</th>
                  <th>Monto total</th>
                  <th>Cantidad pagada</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="contract in filteredContracts" :key="contract.id">
                  <td>
                    <div class="d-inline-block">
                      <h6 class="m-b-0 text-primary">{{ contract.folio }}</h6>
                    </div>
                  </td>
                  <td>{{ contract.pet_name }}</td>
                  <td>${{ formatNumber(contract.subtotal_services) || 'N/A' }}</td>
                  <td>${{ formatNumber(contract.subtotal_extras) || 'N/A' }}</td>
                  <td>${{ formatNumber(contract.total_price) || 'N/A' }}</td>
                  <td>${{ formatNumber(contract.total_paid) || 'N/A' }}</td>
                  <td>
                    <span
                      :class="['badge', contract.status === 'Liquidado' ? 'bg-light-success text-success' : 'bg-light-warning text-warning']">
                      {{ contract.status }}
                    </span>
                  </td>

                  <td>
                    <ul class="list-inline mb-0 d-flex gap-2">
                      <li class="list-inline-item m-0">
                        <router-link :to="`/detallesContrato/${contract.id}`" class="avtar avtar-s btn btn-info">
                          <i class="ti ti-eye f-18"></i>
                        </router-link>
                      </li>
                      <li class="list-inline-item m-0">
                        <router-link :to="`/editarContrato/${contract.id}`" class="avtar avtar-s btn btn-warning">
                          <i class="ti ti-pencil f-18"></i>
                        </router-link>
                      </li>
                      <li class="list-inline-item m-0">
                        <button @click="confirmDelete(contract.id)" type="button"
                          class="delete_user avtar avtar-s btn btn-danger">
                          <i class="ti ti-trash f-18" style="color: #ffffffee"></i>
                        </button>
                      </li>
                    </ul>
                  </td>
                </tr>
                <tr v-if="filteredContracts.length === 0">
                  <td colspan="6" class="text-center text-muted p-4">
                    No se encontraron clientes que coincidan con los filtros aplicados.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            <button class="btn btn-success d-inline-flex align-items-center" @click="generatePDF">
              <i class="ti ti-file-text me-1"></i> Imprimir lista
            </button>
            <button class="btn btn-light-success d-inline-flex align-items-center ms-2" @click="exportToExcel">
              <i class="ti ti-table me-1"></i> Exportar Excel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Previa del Reporte de Clientes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <iframe v-if="pdfUrl" :src="pdfUrl" id="pdfPreview" width="100%" height="650px"
            style="border: none;"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

// Estado Reactivo
const contracts = ref([]);
const search = ref('');
const loading = ref(true);
const pdfUrl = ref(null);

const orderBy = ref('recent');

// Cabecera de Autorización reutilizable
const getAuthHeaders = () => ({
  headers: {
    'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
    'Accept': 'application/json'
  }
});

// Método para cargar los clientes
const fetchUsers = async () => {
  loading.value = true;
  try {
    const response = await axios.get(`${CONFIG.API_BASE_URL}/contracts`, getAuthHeaders());
    contracts.value = response.data;
  } catch (error) {
    console.error("Error al obtener clientes:", error);
    if (window.swal) swal("Error", "No se pudo obtener la lista de clientes", "error");
  } finally {
    setTimeout(() => {
      loading.value = false;
    }, 500);
  }
};


onMounted(() => {
  fetchUsers();
});

// Lógica unificada de búsqueda y ordenamiento por fecha
const filteredContracts = computed(() => {
  let result = [...contracts.value];

  // 1. Filtrado por barra de búsqueda
  if (search.value) {
    const term = search.value.toLowerCase();
    result = result.filter(user =>
      (user.folio && user.folio.toLowerCase().includes(term)) ||
      (user.apellidos && user.apellidos.toLowerCase().includes(term))
    );
  }

  // 2. Ordenamiento (Usa 'created_at' o 'id' por defecto)
  result.sort((a, b) => {
    const dateA = new Date(a.created_at || a.id);
    const dateB = new Date(b.created_at || b.id);
    return orderBy.value === 'recent' ? dateB - dateA : dateA - dateB;
  });

  return result;
});

// Método para eliminar usuario de la API
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

// Confirmación estética con SweetAlert
const confirmDelete = (id) => {
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

const formatNumber = (val) => {
  return isNaN(parseFloat(val)) ? '0.00' : parseFloat(val).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
};

// Generación de reportes en PDF con jsPDF y AutoTable
const generatePDF = () => {
  if (!window.jspdf) {
    console.error("jsPDF no está cargado globalmente.");
    return;
  }
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'mm', 'a4');
  const primaryColor = [41, 128, 185];
  const businessName = "FUNERARIA DE MASCOTAS GRUPO ESPINO";

  doc.setFont("helvetica", "bold");
  doc.setFontSize(14);
  doc.setTextColor(primaryColor[0], primaryColor[1], primaryColor[2]);
  doc.text(businessName, 14, 20);
  doc.setProperties({ title: "Lista de clientes" });

  doc.setFontSize(10);
  doc.setTextColor(100);
  doc.setFont("helvetica", "normal");
  doc.text("Reporte administrativo de contratos registrados", 14, 26);
  doc.text(`Generado el: ${new Date().toLocaleString()}`, 14, 31);

  doc.setDrawColor(primaryColor[0], primaryColor[1], primaryColor[2]);
  doc.line(14, 35, 196, 35);

  const columns = ["Folio", "Cliente", "Monto total", "Total pagado", "Estado"];
  const rows = filteredContracts.value.map(u => [
    u.folio,
    u.client.nombre + " " + u.client.apellidos || 'N/A',
    "$ " + formatNumber(u.total_price) || 'N/A',
    "$ " + formatNumber(u.total_paid) || u.celular || 'N/A',
    u.status || 'N/A',
  ]);

  doc.autoTable({
    head: [columns],
    body: rows,
    startY: 40,
    theme: 'striped',
    headStyles: { fillColor: primaryColor, textColor: 255 },
    styles: { fontSize: 8 },
    didDrawPage: (data) => {
      doc.setFontSize(8);
      doc.text(`Página ${doc.internal.getNumberOfPages()}`, data.settings.margin.left, doc.internal.pageSize.height - 10);
    }
  });

  const blobString = doc.output('bloburl');
  pdfUrl.value = blobString;

  const modalElement = document.getElementById('pdfModal');
  if (modalElement && window.bootstrap) {
    const bsModal = new bootstrap.Modal(modalElement);
    bsModal.show();
  } else {
    window.open(blobString, '_blank');
  }
};

// Exportar a Excel usando la biblioteca XLSX
const exportToExcel = () => {
  if (!window.XLSX) {
    console.error("SheetJS (XLSX) no está cargado.");
    return;
  }
  const dataToExport = filteredContracts.value.map(u => ({
    "Folio": u.folio,
    "Cliente": u.client.nombre + " " + u.client.apellidos,
    "Nombre de mascota": u.pet_name || 'N/A',
    "Celular": u.client.celular || 'N/A',
    "Telefono": u.client.Telefono || 'N/A',
    "Servicios": u.subtotal_services || 'N/A',
    "Servicios extras": u.subtotal_extras || 'N/A',
    "Total a pagar": u.total_price || 'N/A',
    "Total pagado": u.total_paid || 'N/A',
  }));

  const worksheet = XLSX.utils.json_to_sheet(dataToExport);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "Clientes");

  const wscols = [
    { wch: 6 },  // FOLIO
    { wch: 20 }, // CLIENTE
    { wch: 20 }, // MASCOTA
    { wch: 15 }, // CELULAR
    { wch: 15 }, // Servicios
    { wch: 15 }, // Servicios extra
    { wch: 15 }, // Total a pagar
    { wch: 15 }, // Total pagado
  ];
  worksheet['!cols'] = wscols;

  const fecha = new Date().toISOString().slice(0, 10);
  XLSX.writeFile(workbook, `Reporte_Clientes_${fecha}.xlsx`);
};
</script>

<style scoped>
.custom-scroll-container {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.table-hover tbody tr:hover {
  background-color: rgba(var(--bs-primary-rgb), 0.04);
  transition: background-color 0.2s ease;
}
</style>