import('../css/app.scss');

import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import vuetify from './plugins/vuetify'

Vue.use(InertiaApp)

const app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./pages/${name}`).default,
    },
  }),
  vuetify,
}).$mount(app)
