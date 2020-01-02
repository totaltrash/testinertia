import Vue from 'vue'
import Router from '~/bundles/fosjsrouting/js/router'
import { Inertia } from '@inertiajs/inertia'

const routes = require('../routes.json');
Router.setRoutingData(routes);
Vue.prototype.$route = function (...args) {
    return Router.generate(...args)
}
Vue.prototype.$visitRoute = function (...args) {
    return Inertia.visit(Router.generate(...args))
}
