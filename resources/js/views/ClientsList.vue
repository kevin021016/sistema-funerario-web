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

      <div class="row">
        <div v-if="loading" class="text-center p-5">
          <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Cargando...</span>
          </div>
          <p class="mt-2 text-muted">Cargando lista de clientes...</p>
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
                <input type="text" class="form-control border-start-0" placeholder="Buscar por nombre..."
                  v-model="search">
              </div>

              <!-- Filtro de Orden -->
              <div style="min-width: 160px;">
                <select class="form-select" v-model="orderBy">
                  <option value="recent">Más reciente</option>
                  <option value="oldest">Más antiguo</option>
                </select>
              </div>

              <!-- Filtro de Colonia (Cargado desde la Base de Datos) -->
              <div style="min-width: 180px;">
                <select class="form-select" v-model="selectedColonia">
                  <option value="">Todas las colonias</option>
                  <!-- Iteramos sobre el nuevo array extraído de la BD -->
                  <option v-for="colonia in colonias" :key="colonia.id || colonia" :value="colonia.nombre || colonia">
                    {{ colonia.nombre || colonia }}
                  </option>
                </select>
              </div>

            </div>

            <div class="d-flex gap-2">
              <router-link to="/crearCliente" class="btn btn-primary d-inline-flex align-items-center">
                <i class="ti ti-plus me-1"></i> Agregar cliente
              </router-link>
            </div>
          </div>

          <div class="custom-scroll-container">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Teléfono</th>
                  <th>Colonia</th>
                  <th>C.P</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in filteredClients" :key="user.id">
                  <td>
                    <div class="d-inline-block">
                      <h6 class="m-b-0">{{ user.nombre }}</h6>
                      <p class="m-b-0 text-primary">{{ user.celular || 'S/N' }}</p>
                    </div>
                  </td>
                  <td>{{ user.apellidos }}</td>
                  <td>{{ user.telefono || 'N/A' }}</td>
                  <td>{{ user.colonia || 'N/A' }}</td>
                  <td>{{ user.codigo_postal || 'N/A' }}</td>
                  <td>
                    <ul class="list-inline mb-0 d-flex gap-2">
                      <li class="list-inline-item m-0">
                         <router-link :to="`/detallesCliente/${user.id}`" class="avtar avtar-s btn btn-info">
                          <i class="ti ti-eye f-18"></i>
                        </router-link>
                      </li>
                      <li class="list-inline-item m-0">
                        <router-link :to="`/editarCliente/${user.id}`" class="avtar avtar-s btn btn-warning">
                          <i class="ti ti-pencil f-18"></i>
                        </router-link>
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
                <tr v-if="filteredClients.length === 0">
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
const clients = ref([]);
const colonias = ref([]); // <-- Almacenará las colonias traídas desde tu Base de Datos
const search = ref('');
const loading = ref(true);
const pdfUrl = ref(null);

const orderBy = ref('recent');
const selectedColonia = ref('');

// Cabecera de Autorización reutilizable
const getAuthHeaders = () => ({
  headers: {
    'Authorization': `Bearer ${localStorage.getItem(CONFIG.STORAGE_KEYS.TOKEN)}`,
    'Accept': 'application/json'
  }
});

// Método para cargar los clientes
const fetchClients = async () => {
  loading.value = true;
  try {
    const response = await axios.get(`${CONFIG.API_BASE_URL}/clients`, getAuthHeaders());
    clients.value = response.data;
  } catch (error) {
    console.error("Error al obtener clientes:", error);
    if (window.swal) swal("Error", "No se pudo obtener la lista de clientes", "error");
  } finally {
    setTimeout(() => {
      loading.value = false;
    }, 500);
  }
};

// ==========================================
// PLACEHOLDER API: Cargar Colonias desde la BD
// ==========================================
const fetchColonias = async () => {
  try {
    // Cuando crees tu endpoint en Laravel, descomenta y adapta la línea de abajo:
    const response = await axios.get(`${CONFIG.API_BASE_URL}/colonias`, getAuthHeaders());
    colonias.value = response.data;

    // Datos hardcodeados de respaldo mientras creas la BD para que no se vea vacío:
 
  } catch (error) {
    console.error("Error al obtener las colonias:", error);
  }
};

onMounted(() => {
  fetchClients();
  fetchColonias(); // <-- Ejecutamos el llamado al montar el componente
});

// Lógica unificada de búsqueda, filtrado por colonia y ordenamiento por fecha
const filteredClients = computed(() => {
  let result = [...clients.value];

  // 1. Filtrado por barra de búsqueda
  if (search.value) {
    const term = search.value.toLowerCase();
    result = result.filter(user =>
      (user.nombre && user.nombre.toLowerCase().includes(term)) ||
      (user.apellidos && user.apellidos.toLowerCase().includes(term))
    );
  }

  // 2. Filtrado por Colonia elegida
  if (selectedColonia.value) {
    result = result.filter(user => user.colonia === selectedColonia.value);
  }

  // 3. Ordenamiento (Usa 'created_at' o 'id' por defecto)
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
    const response = await axios.delete(`${CONFIG.API_BASE_URL}/clients/${id}`, getAuthHeaders());
    if (response.status === 200 || response.status === 204) {
      clients.value = clients.value.filter(user => user.id !== id);
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
  doc.text("Reporte administrativo de clientes registrados", 14, 26);
  doc.text(`Generado el: ${new Date().toLocaleString()}`, 14, 31);

  doc.setDrawColor(primaryColor[0], primaryColor[1], primaryColor[2]);
  doc.line(14, 35, 196, 35);

  const columns = ["Folio", "Nombre", "Apellidos", "Teléfono", "Colonia", "C.P."];
  const rows = filteredClients.value.map(u => [
    u.id,
    u.nombre || 'N/A',
    u.apellidos || 'N/A',
    u.telefono || u.celular || 'N/A',
    u.colonia || 'N/A',
    u.codigo_postal || 'N/A'
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
  const dataToExport = filteredClients.value.map(u => ({
    "ID": u.id,
    "Nombre": u.nombre,
    "Apellidos": u.apellidos || 'N/A',
    "Teléfono": u.telefono || 'N/A',
    "Celular": u.celular || 'N/A',
    "Colonia": u.colonia || 'N/A',
    "Código Postal": u.codigo_postal || 'N/A'
  }));

  const worksheet = XLSX.utils.json_to_sheet(dataToExport);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "Clientes");

  const wscols = [
    { wch: 6 },  // ID
    { wch: 20 }, // Nombre
    { wch: 20 }, // Apellidos
    { wch: 15 }, // Teléfono
    { wch: 15 }, // Celular
    { wch: 20 }, // Colonia
    { wch: 12 }  // C.P
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