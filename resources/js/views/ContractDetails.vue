<template>
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                                <li class="breadcrumb-item"><router-link to="/contratos">Lista de
                                        contratos</router-link>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de contrato</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de contrato</h2>
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
                    <p class="mt-2 text-muted">Consultando la información del contrato...</p>
                </div>


                <div v-else class="col-12">
                    <div class="row mb-4">

                        <div class="col-md-4 col-xl-4 mb-3 mb-md-0">
                            <div class="card statistics-card-1 h-100">
                                <div class="card-header d-flex align-items-center justify-content-between py-3">
                                    <h5 class="mb-0">Tipo de financiamiento</h5>

                                    <div class="avtar avtar-s bg-light-primary text-primary">
                                        <i class="ti ti-report-money f-18"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img :src="'/assets/images/widget/img-status-1.svg'" alt="img"
                                        class="img-fluid img-bg h-100" />
                                    <div class="d-flex align-items-center">
                                        <h3 class="f-w-300 d-flex align-items-center m-b-0">{{ paid_payments }} <small
                                                class="text-muted">/{{ contract.total_payments }}</small></h3>
                                        <span class="ms-2">Estatus</span>
                                        <span v-if="total_remaining > 0" class="badge bg-light-warning ms-2">{{
                                            contract_status }}</span>
                                        <span v-else class="badge bg-light-success ms-2">{{ contract_status }}</span>
                                    </div>
                                    <p class="text-muted mb-2 text-sm mt-3">Progreso de pagos</p>
                                    <div class="progress" style="height: 7px">
                                        <div class="progress-bar bg-brand-color-1" role="progressbar"
                                            :style="{ width: progress_bar_value + '%' }" aria-valuenow="75"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4 mb-3 mb-md-0">
                            <div class="card statistics-card-1 h-100">
                                <div class="card-header d-flex align-items-center justify-content-between py-3">
                                    <h5 class="mb-0">Tipo de financiamiento</h5>

                                    <div class="avtar avtar-s bg-light-primary text-primary">
                                        <i class="ti ti-cash f-18"></i>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column justify-content-center">
                                    <div class="text-center mt-2 mb-4">
                                        <p class="text-muted mb-1 text-sm">Modalidad del contrato</p>

                                        <h3 v-if="contract.payment_scheme === '2'"
                                            class="fw-bold d-flex align-items-center justify-content-center mb-0">
                                            <span class="text-primary me-2">
                                                <i class="ti ti-credit-card"></i>
                                            </span>
                                            Crédito
                                        </h3>

                                        <h3 v-else
                                            class="fw-bold d-flex align-items-center justify-content-center mb-0 text-success">
                                            <span class="me-2">
                                                <i class="ti ti-wallet"></i>
                                            </span>
                                            Contado
                                        </h3>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4 mb-3 mb-md-0">
                            <div class="card statistics-card-1 h-100">

                                <div class="card-header d-flex align-items-center justify-content-between py-3">
                                    <h5 class="mb-0">Monto de enganche</h5>

                                    <div class="avtar avtar-s bg-light-success text-success">
                                        <i class="ti ti-coin f-18"></i>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column justify-content-center">
                                    <div class="text-center mt-2 mb-4">
                                        <p class="text-muted mb-1 text-sm">Pago inicial registrado</p>

                                        <h3
                                            class="fw-bold d-flex align-items-center justify-content-center mb-0 text-dark">
                                            ${{ formatCurrency(contract.down_payment) }}
                                        </h3>
                                    </div>

                                    <div
                                        class="alert alert-success bg-light-success border-0 py-2 px-3 text-center mb-0 mt-auto">
                                        <small>Abonado al saldo total</small>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="badge bg-light-primary text-primary mb-0">Folio: #{{ contract.folio }}
                                    </h5>
                                    <button class="btn btn-primary btn-sm" @click="prepararPago">
                                        <i class="ti ti-plus me-1"></i>
                                        Agregar pago
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-scroll-container">
                                                <table class="table table-sm table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Folio de recibo</th>
                                                            <th scope="col">Fecha de pago</th>
                                                            <th scope="col">Concepto</th>
                                                            <th scope="col">Método</th>
                                                            <th scope="col">Monto</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="payment in processedPayments" :key="payment.id">
                                                            <td class="fw-bold">#{{ payment.id }}</td>
                                                            <td>{{ formatDate(payment.payment_date) }}</td>

                                                            <td>
                                                                <span class="badge bg-light-primary text-primary">{{
                                                                    payment.covered_text }}</span>
                                                            </td>

                                                            <td>{{ payment.payment_type }}</td>
                                                            <td class="fw-bold">${{ formatCurrency(payment.amount) }}
                                                            </td>

                                                            <td>
                                                                <ul class="list-inline mb-0 d-flex gap-1">
                                                                    <li class="list-inline-item m-0">
                                                                        <button type="button"
                                                                            @click="mostrarObservaciones(payment.id)"
                                                                            class="avtar avtar-s btn btn-info"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter">
                                                                            <i class="ti ti-eye f-18"></i>
                                                                        </button>
                                                                    </li>
                                                                    <li class="list-inline-item m-0">
                                                                        <button type="button"
                                                                            class="avtar avtar-s btn btn-danger"
                                                                            @click="confirmDeleteContract(payment.id)">
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
                                    <!-- INICIO: FECHAS DEL CONTRATO -->
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">Fecha de venta:</span>
                                        <span class="fw-bold">{{ formatDate(contract.sale_date) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1"
                                        v-if="contract.payment_scheme === '2'">
                                        <span class="text-muted small">Fecha de primer pago:</span>
                                        <span class="fw-bold">{{ formatDate(contract.first_payment_date)
                                            }}</span>
                                    </div>
                                    <hr class="border-secondary opacity-25 my-2">
                                    <!-- FIN: FECHAS DEL CONTRATO -->
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">Total de contrato:</span>
                                        <span class="fw-bold text-success">${{ formatCurrency(contract.total_price) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted small">Total pagado:</span>
                                        <span class="fw-bold text-danger">${{ formatCurrency(total_paid +
                                            contract.down_payment)
                                        }}</span>
                                    </div>
                                    <hr class="border-secondary opacity-25 my-3">

                                    <!-- Saldo Restante Destacado (Color Rojo y texto más grande) -->
                                    <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap">
                                        <span class="fw-bold text-dark">Saldo pendiente:</span>
                                        <span class="fw-bolder text-success fs-5">${{
                                            formatCurrency(total_remaining) }}</span>
                                    </div>

                                    <!-- Texto de ayuda miniatura -->
                                    <div class="text-end">
                                        <small class="text-muted" style="font-size: 0.7rem;">Monto pendiente de
                                            cobro</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Registrar pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Monto</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" v-model.number="paymentForm.amount">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha (mm-dd-yy)</label>
                        <input type="date" class="form-control" v-model="paymentForm.payment_date">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Método</label>
                        <select class="form-select" v-model="paymentForm.payment_type">
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Tarjeta">Tarjeta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notas</label>
                        <textarea rows="3" class="form-control" v-model="paymentForm.notes">
                    </textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancelar
                    </button>

                    <button class="btn btn-success" @click="guardarPago" :disabled="savingPayment">

                        <span v-if="savingPayment" class="spinner-border spinner-border-sm me-1">
                        </span>

                        Guardar Pago
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Observaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ observacionesById }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToastPayments" class="toast text-white bg-danger fade" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"> El contrato ya ha sido liquidado. </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch, onBeforeUnmount } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import PizZip from 'pizzip';
import Docxtemplater from 'docxtemplater';
import JSZipUtils from 'jszip-utils';


const route = useRoute();

// Estados estructurales
const loading = ref(true);
const contract = ref({});
const savingPayment = ref(false);

const hoy = new Date();
const yyyy = hoy.getFullYear();
const mm = String(hoy.getMonth() + 1).padStart(2, '0'); // Los meses van de 0 a 11
const dd = String(hoy.getDate()).padStart(2, '0');

const fechaActual = `${yyyy}-${mm}-${dd}`;

const observacionesById = ref("");

import { computed } from 'vue';

const amount = computed(() => {
    // Si es Contado, el monto es SIEMPRE el saldo pendiente completo
    if (contract.value.payment_scheme !== '2') {
        return total_remaining.value;
    }

    // Lógica para Crédito: Si es el último pago, ajusta el monto
    if (paid_payments.value === contract.value.total_payments - 1) {
        return contract.value.total_price - (total_paid.value + contract.value.down_payment);
    }

    return contract.value.payment_amount;
});
const total_paid = computed(() => {
    // Solo sumamos los recibos, asumiendo que el enganche ya está aquí adentro
    return (contract.value.payments || []).reduce(
        (total, payment) => total + Number(payment.amount),
        0
    );
});
const total_remaining = computed(() => {
    return Number((contract.value.total_price || 0) - total_paid.value - (contract.value.down_payment));
});
const paid_payments = computed(() => {
    // Si ya no hay saldo, mostramos el máximo de pagos realizados
    if (total_remaining.value <= 0) {
        return contract.value.payment_scheme !== '2' ? 1 : contract.value.total_payments;
    }

    // Si es de Contado y aún debe, lleva 0 pagos
    if (contract.value.payment_scheme !== '2') {
        return 0;
    }

    // Lógica para Crédito (protegiendo contra divisiones por cero)
    if (!contract.value.payment_amount) return 0;
    return Math.ceil(total_paid.value / contract.value.payment_amount);
});
const contract_status = computed(() => {
    let status = contract.value.status;
    if (total_remaining.value == 0) {
        status = "Liquidado"
    }
    return String(status);
});
const progress_bar_value = computed(() => {
    // Definimos el total de pagos reales (1 si es contado, o los plazos si es crédito)
    const total = contract.value.payment_scheme !== '2' ? 1 : contract.value.total_payments;

    if (!total || total === 0) return 0; // Evitamos dividir por 0
    return Number((paid_payments.value * 100) / total);
});
const processedPayments = computed(() => {
    // Si aún no hay pagos o no han cargado, devolvemos un arreglo vacío
    if (!contract.value.payments) return [];

    let accumulated = 0; // Nuestra "alcancía" cronológica
    const quota = Number(contract.value.payment_amount);
    const isCredit = contract.value.payment_scheme === '2';

    // Lo que realmente debe en total (Precio - Enganche)
    const targetTotal = Number(contract.value.total_price || 0) - Number(contract.value.down_payment || 0);

    return contract.value.payments.map(payment => {
        const amount = Number(payment.amount);

        // Si es de contado, no hay cuotas
        if (!isCredit) {
            return { ...payment, covered_text: 'Pago único' };
        }

        // 1. Calculamos cuántas cuotas ESTABAN completas antes de este recibo
        // (Usamos un pequeño redondeo interno para evitar errores de decimales en JavaScript)
        const completelyPaidBefore = Math.floor(Math.round(accumulated * 100) / 100 / quota);
        let startPayment = completelyPaidBefore + 1;

        // Entra el dinero de este recibo a la alcancía
        accumulated += amount;

        // 2. Calculamos cuántas cuotas QUEDARON completas después de este recibo
        let completelyPaidAfter = Math.floor(Math.round(accumulated * 100) / 100 / quota);

        // Regla de oro: Si el acumulado ya cubre la deuda total, forzamos a que cierre en la última cuota
        if (Math.round(accumulated * 100) / 100 >= Math.round(targetTotal * 100) / 100) {
            completelyPaidAfter = contract.value.total_payments;
        }

        let endPayment = completelyPaidAfter;

        // Lógica para armar el texto que verá el usuario
        let text = '';
        if (startPayment > endPayment) {
            // Ejemplo: Cuota de 200, pero dio 50. No completó nada nuevo.
            text = `Abono a #${startPayment}`;
        } else if (startPayment === endPayment) {
            // Ejemplo: Dio 200 exactos. Se llenó 1 sola cuota.
            text = `Pago #${startPayment}`;
        } else {
            // Ejemplo: Dio 500. Cubrió múltiples cuotas.
            text = `Pagos #${startPayment} al #${endPayment}`;
        }

        // Retornamos el pago original, pero le inyectamos nuestro nuevo texto
        return {
            ...payment,
            covered_text: text
        };
    });
});
const paymentForm = ref({
    amount: 0,
    payment_date: fechaActual,
    payment_type: 'Efectivo',
    notes: ''
});
const prepararPago = () => {
    // 1. Verificamos si ya está liquidado
    if (total_remaining.value <= 0) {
        mostrarToast(); // Disparamos el toast
        return; // El "return" detiene la función aquí mismo para que no haga lo de abajo
    }

    // 2. Si aún hay deuda, preparamos el formulario
    paymentForm.value.amount = amount.value;
    paymentForm.value.payment_date = fechaActual;
    paymentForm.value.payment_type = 'Efectivo';
    paymentForm.value.notes = '';

    // 3. Abrimos el modal manualmente usando la instancia de Bootstrap
    const modalEl = document.getElementById('paymentModal');
    if (modalEl) {
        const modal = window.bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }
};
// Captura de ID desde la ruta de Vue Router (/detallesCliente/:id)
const contractId = route.params.id;


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
        const response = await axios.get(`${CONFIG.API_BASE_URL}/contracts/${contractId}`, getAuthHeaders());
        contract.value = response.data;

        // Si no trae observaciones la API, forzamos un string por defecto para mantener diseño
    } catch (error) {
        console.error("Error al recuperar los detalles de la base de datos:", error);
        if (window.swal) swal("Error", "No se pudo obtener la ficha del cliente.", "error");
    } finally {
        loading.value = false;
    }

});

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
                nombre: contract.value.nombre || 'N/A',
                apellidos: contract.value.apellidos || 'N/A',
                celular: contract.value.celular || 'N/A',
                telefono: contract.value.telefono || 'N/A',
                ciudad: contract.value.ciudad || 'La Paz',
                colonia: contract.value.colonia || 'N/A',
                codigo_postal: contract.value.codigo_postal || 'N/A',
                calle: contract.value.calle || 'N/A',
                entre_calles: contract.value.entre_calles || 'N/A',
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
            const fileName = `Caratula_${contract.value.nombre}_${contract.value.id}.docx`;
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

const deletePayment = async (id) => {
    try {

        const response = await axios.delete(`${CONFIG.API_BASE_URL}/payments/${id}`, getAuthHeaders());
        if (response.status === 200 || response.status === 204) {
            contract.value.payments = contract.value.payments.filter(payment => payment.id !== id);
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
            title: "¿Deseas eliminar este pago?",
            text: "Esta acción no puede revertirse.",
            icon: "warning",
            buttons: ["Cancelar", "Sí, remover"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                deletePayment(id);
                swal("Eliminado", "El pago ha sido retirado.", "success");
            }
        });
    }
};

// Formateador estándar para moneda mexicana (MXN)
const formatCurrency = (val) => {
    return parseFloat(val).toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
};

const formatDate = (date) => {
    if (!date) return 'Sin asignar';
    return date.split('T')[0];
};
const guardarPago = async () => {
    try {

        savingPayment.value = true;

        paymentForm.value.contract_id = contract.value.id;

        const response = await axios.post(
            `${CONFIG.API_BASE_URL}/payments`,
            paymentForm.value,
            getAuthHeaders()
        );

        contract.value.payments.push(response.data.payment);

        // Cerrar modal sin importar bootstrap
        document.querySelector('#paymentModal .btn-close').click();

        swal(
            "Pago registrado",
            "El pago fue agregado correctamente",
            "success"
        );

    } catch (error) {

        swal(
            "Error",
            error.response?.data?.message || "No se pudo registrar el pago",
            "error"
        );

    } finally {
        savingPayment.value = false;
    }
};

const mostrarObservaciones = (id) => {
    const observacion = contract.value.payments.find(
        payment => payment.id === id
    );

    if (observacion.notes == null) {
        observacionesById.value = "Sin observaciones"
    }

    else if (observacion) {
        observacionesById.value = observacion.notes;
    }
};

const mostrarToast = () => {
    // Buscamos el elemento directamente cuando se hace clic (aquí Vue ya renderizó todo)
    const toastEl = document.getElementById('liveToastPayments');
    if (toastEl) {
        // Usamos window.bootstrap para asegurarnos de que Vue encuentre la librería global
        const toast = window.bootstrap.Toast.getOrCreateInstance(toastEl);
        toast.show();
    }
};

onBeforeUnmount(() => {
    // 1. Quitar la clase que bloquea el scroll en el body
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';

    // 2. Buscar y eliminar cualquier fondo oscuro (backdrop) que haya quedado en el DOM
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(backdrop => backdrop.remove());
});
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