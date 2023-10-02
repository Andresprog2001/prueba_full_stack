import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/components',
      name: 'components',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/ComponentsView.vue')
    },
    // Ruta del formulario de registro
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue')
    },
    ,
    // Ruta del lsitado de registros
    {
      path: '/consult',
      name: 'consult',
      component: () => import('../views/ConsultView.vue')
    },
    // {
    //   path: '/schedule',
    //   name: 'schedule',
    //   component: () => import('../views/ScheduleView.vue')
    // }
  ]
})

export default router
