import AddAsset from './components/Admin/AddAsset';
import AddSupervisor from './components/Admin/AddSupervisor';
import AddTechnician from './components/Admin/AddTechnician';
import Asset from './components/Admin/Asset';
import AdminDashboard from './components/Admin/Dashboard';
import EditAsset from './components/Admin/EditAsset';
import EditSupervisor from './components/Admin/EditSupervisor';
import EditTechnician from './components/Admin/EditTechnician';
import Supervisor from './components/Admin/Supervisor';
import Technician from './components/Admin/Technician';

import SupervisorDashboard from './components/Supervisor/Dashboard';
import AssetStatus from './components/Supervisor/AssetStatus';
import WorkOrderHistory from './components/Supervisor/WorkOrderHistory';

import NotFound from './components/NotFound';
import Register from './components/Register';

import { createRouter, createWebHistory } from 'vue-router';


const routes = [
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: "/admin/dashboard",
        component: AdminDashboard,
        name: "dashboard",
    },
    {
        path: '/admin/asset-management',
        component: Asset,
        name: 'asset'
    },
    {
        path: '/admin/supervisor-management',
        component: Supervisor,
        name: 'supervisor'
    },
    {
        path: '/admin/technician-management',
        component: Technician,
        name: 'technician'
    },
    {
        path: '/admin/asset-management/add-asset',
        component: AddAsset,
        name: 'addAsset'
    },
    {
        path: '/admin/asset-management/edit-asset/:id',
        component: EditAsset,
        name: 'editAsset'
    },
    {
        path: '/admin/supervisor-management/add-supervisor',
        component: AddSupervisor,
        name: 'addSupervisor'
    },
    {
        path: '/admin/supervisor-management/edit-supervisor/:id',
        component: EditSupervisor,
        name: 'editSupervisor'
    },
    {
        path: '/admin/technician-management/add-technician',
        component: AddTechnician,
        name: 'addTechnician'
    },
    {
        path: '/admin/technician-management/edit-technician/:id',
        component: EditTechnician,
        name: 'editTechnician'
    },
    {
        path: '/supervisor/dashboard',
        component: SupervisorDashboard,
        name: 'supervisorDashboard'
    },
    {
        path: '/supervisor/asset-status/:id',
        name: 'assetStatus',
        component: AssetStatus
    },
    {
        path: '/supervisor/work-order-history',
        name: 'workOrderHistory',
        component: WorkOrderHistory
    },

];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'font-bold underline',
    routes
});

export default router;
