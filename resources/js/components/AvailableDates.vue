<template>
    <section>
        <h3 class="text-center text-3xl mb-6 font-sans">Available Dates</h3>
        <hr class="my-6">
        <table class="table table-auto text-center mx-auto w-2/4">
                <thead>
                    <tr>
                        <th class="w-2/6">Date</th>
                        <th class="w-2/6">Max Slot</th>
                        <th class="w-2/6">Booked Slot</th>
                        <th class="w-2/6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(availableDate, index) in allAvailableDates" :key="index">
                        <td>{{availableDate.available_date}}</td>
                        <td>{{availableDate.max_slots}}</td>
                        <td>{{availableDate.booked_slots}}</td>
                        <td>
                            <!-- :disabled="availableDate.max_slots == availableDate.booked_slots" -->
                            <button 
                                @click="createBooking({available_date_id: availableDate.id, user_id: 1})" 
                                class="bg-indigo-600 px-2 rounded-xl text-white hover:bg-indigo-800"
                                disabled
                            >Book</button>
                        </td>
                    </tr>
                </tbody>
        </table>
    </section>
</template>

<script>

import { mapGetters, mapActions } from 'vuex'

export default {
 created() {
        Echo.channel('notifications')
        .listen('BookingAddedNotification', (event) => {
            this.getAvailableDates()
        })
  },
  mounted() {
    this.getAvailableDates()
  },
  computed: {
    ...mapGetters(['allAvailableDates'])},
  methods: {
    ...mapActions(['getAvailableDates', 'createBooking']),
  },
    
}
</script>