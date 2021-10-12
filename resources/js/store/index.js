import Vue from 'vue'
import Vuex from 'vuex'
import availableDates from './modules/availableDates'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        availableDates
    }
})