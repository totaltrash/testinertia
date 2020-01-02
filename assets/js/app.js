import('../css/app.scss');

import Vue from 'vue'
import vuetify from './plugins/vuetify'
import './plugins/routing'
import InertiaApp from './plugins/inertia'

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
