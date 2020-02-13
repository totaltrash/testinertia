import Vue from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Router from '~/bundles/fosjsrouting/js/router'
import Routes from '~/routes.json'

Router.setRoutingData(Routes);

Vue.prototype.$route = function (...args) {
    return Router.generate(...args)
}

Vue.prototype.$visitRoute = function (...args) {
    return Inertia.visit(Router.generate(...args))
}
