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
const Subscribe = () => import('@/components/SubscribeComponent.vue')
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
        path: "/subscribe",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "subscribe",
                path: "/subscribe",
                component: Subscribe,
                meta: {
                    middleware: "auth",
                    title: `Subscribe`
                }
            }
        ]
    },
    {
        path: "/advanced",
        component: DahboardLayout,
        meta: {
            middleware: "paid"
        },
        children: [
            {
                name: "advanced",
                path: "/",
                component: AdvancedStats,
                meta: {
                    title: `Advanced Stats`
                }
            }
        ]
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
            next()
        } else {
            next({ name: "login" })
        }
    } else if (to.meta.middleware == "paid") {
        if (store.state.auth.paid) {
            next()
        } else {
            next({ name: "dashboard" })
        }
    }
})

export default router