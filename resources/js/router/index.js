import { createRouter, createWebHistory } from 'vue-router';

// Importa tus vistas
const UsersList = () => import('../views/UsersList.vue');
const UserCreate = () => import('../views/UserCreate.vue');
const UserEdit = () => import('../views/UserEdit.vue');

const ClientsList = () => import('../views/ClientsList.vue');
const ClientCreate = () => import('../views/ClientCreate.vue');
const ClientEdit = () => import('../views/ClientEdit.vue');
const ClientDetails = () => import('../views/ClientDetails.vue');
const ContractsList = () => import('../views/ContractsList.vue');
const ContractCreate = () => import('../views/ContractCreate.vue');
const ContractEdit = () => import('../views/ContractEdit.vue');
const ContractDetails = () => import('../views/ContractDetails.vue');

const Dashboard = () => import('../views/Dashboard.vue');

const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/usuarios',
    name: 'usuarios',
    component: UsersList
  },
  {
    path: '/crearUsuario',
    name: 'createUser',
    component: UserCreate
  },
  {
    path: '/editarUsuario/:id',
    name: 'editUser',
    component: UserEdit
  },
  {
    path: '/clientes',
    name: 'clients',
    component: ClientsList
  },
  {
    path: '/crearCliente',
    name: 'Createclient',
    component: ClientCreate
  },
  {
    path: '/editarCliente/:id',
    name: 'editClient',
    component: ClientEdit
  },
  {
    path: '/detallesCliente/:id',
    name: 'detailsClient',
    component: ClientDetails
  },
  {
    path: '/contratos',
    name: 'contracts',
    component: ContractsList
  },
  {
    path: '/crearContrato/',
    name: 'createContract',
    component: ContractCreate
  },
  {
    path: '/editarContrato/:id',
    name: 'editContract',
    component: ContractEdit
  },
   {
    path: '/detallesContrato/:id',
    name: 'detailsContract',
    component: ContractDetails
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// EL GUARDIÁN: Se ejecuta antes de entrar a cualquier ruta
router.beforeEach((to, from, next) => {
  // Obtenemos el item usando la llave centralizada
  const userRaw = localStorage.getItem(CONFIG.STORAGE_KEYS.USER);

  // Si estamos en la URL física /login, no hacemos nada para evitar bucles
  if (window.location.pathname === '/login') {
    return next();
  }

  // Si no hay nada en el storage, mandamos al login físico
  if (!userRaw && to.path !== '/login') {
    window.location.href = '/login';
  } else {
    // Si llegamos aquí es porque hay usuario o estamos logueados
    next();
  }
});

export default router;