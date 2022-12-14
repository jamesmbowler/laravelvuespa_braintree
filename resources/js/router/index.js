import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
const Example = () => import('@/components/ExampleComponent.vue')
const AdvancedStats = () => import('@/components/AdvancedStats.vue')

/* Authenticated Component */

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        name: "example",
        path: "/example",
        component: Example,
        meta: {
            middleware: "auth",
            title: `Example`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
            {
                name: "advanced",
                path: '/advanced',
                component: AdvancedStats,
                meta: {
                    middleware: "paid",
                    title: `Advanced Stats`
                }
            }

        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else if (to.meta.middleware == "auth") {
        if (store.state.auth.authenticated) {
            next({ name: "advanced" })
        } else {
            next({ name: "login" })
        }
    } else if (to.meta.middleware == "paid") {
        if (store.state.paid) {
            next({ name: "advanced" })
        } else {
            next({ name: "dashboard" })
        }
    }
})

export default router