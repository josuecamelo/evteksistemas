import Vue from 'vue'
import VueRouter from 'vue-router'
import AdminComponent from "../components/admin/AdminComponent";
import DashBoardComponent from "../components/admin/pages/dashboard/DashBoardComponent";
import PacientesComponent from "../components/admin/pages/pacientes/PacientesComponent";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: AdminComponent,
        children: [
            {path: '', component: DashBoardComponent, name: 'admin.dashboard'},
            {path: 'pacientes', component: PacientesComponent, name: 'admin.pacientes'},
        ]
    },
]

const router = new VueRouter({
    routes
})

export default router
