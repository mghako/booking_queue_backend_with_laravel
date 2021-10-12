import axios from 'axios'
const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
  });

export default {
    state: () => ({
        availableDates: []
    }),
    
    getters: {
        allAvailableDates: (state) => state.availableDates
    },
    mutations: {
        SET_AVAILABLE_DATES(state, payload) {
            state.availableDates = payload
        }
    },
    actions: {
        saveAvailalbeDates({commit}, data) {
            commit('SET_AVAILABLE_DATES', data)
        },
        async getAvailableDates({commit}) {
            let res = await api.get('/available-dates')
            commit('SET_AVAILABLE_DATES', res.data)
        },
        async createBooking(context, payload) {
            let res = await api.post('/bookings', payload)
            this.dispatch('getAvailableDates')

        }
    }
}
