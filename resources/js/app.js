/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('sidebar-component', require('./components/Sidebar.vue').default);

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//excel exp
import JsonExcel from 'vue-json-excel'
Vue.component('downloadExcel', JsonExcel)

//sidebar
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
Vue.use(VueSidebarMenu)

import VueRouter from 'vue-router'
import Apps from './components/Sidebar.vue'

import AkuntansiD3 from './components/datas-views/AkuntansiD3.vue'
import PajakD3 from './components/datas-views/PajakD3.vue'
import PajakD1 from './components/datas-views/PajakD1.vue'
import PbbD3 from './components/datas-views/PbbD3.vue'
import BeacukaiD3 from './components/datas-views/BeacukaiD3.vue'
import BeacukaiD1 from './components/datas-views/BeacukaiD1.vue'
import KbnD3 from './components/datas-views/KbnD3.vue'
import KbnD1 from './components/datas-views/KbnD1.vue'
import MansetD3 from './components/datas-views/MansetD3.vue'

Vue.use(VueRouter)
Vue.use(VueSidebarMenu)

const router = new VueRouter({
  routes: [
    {
      path: '/akuntansiD3',
      name: 'D III Akuntansi',
      component: AkuntansiD3
    },
    {
      path: '/pajakD3',
      name: 'PajakD3',
      component: PajakD3
    },
    {
      path: '/pajakD1',
      name: 'PajakD1',
      component: PajakD1
    },
    {
      path: '/pbbD3',
      name: 'PbbD3',
      component: PbbD3
    },
    {
      path: '/beacukaiD3',
      name: 'BeacukaiD3',
      component: BeacukaiD3
    },
    {
      path: '/pajakD1',
      name: 'BeacukaiD1',
      component: BeacukaiD1
    },
    {
      path: '/kbnD3',
      name: 'KbnD3',
      component: KbnD3
    },
    {
      path: '/kbnD1',
      name: 'KbnD1',
      component: KbnD1
    },
    {
      path: '/mansetD3',
      name: 'MansetD3',
      component: MansetD3
    }
  ]
})

const app =new Vue({ // eslint-disable-line no-new
  el: '#content',
  router,
  render: h => h(Apps)
})

