import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: "/stores/:store",
    name: 'Store',
    component: () => import(/* webpackChunkName: "store" */ '../views/Store.vue'),
    props(route) {
      const props = { ...route.params }
      props.id = +props.id
      return props
    },
  },
  {
    path: '/import',
    name: 'Import',
    component: () => import(/* webpackChunkName: "import" */ '../views/Import.vue')
  },
  {
    path: '/about',
    name: 'About',
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
