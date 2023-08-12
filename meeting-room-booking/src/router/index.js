import { createRouter, createWebHistory } from 'vue-router'

// Import components
import BookingList from '../components/BookingList.vue';
import BookingForm from '../components/BookingForm.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'bookingList',
      component: BookingList
    },
    {
        path: '/booking/create',
        name: 'addBooking',
        component: BookingForm
    }
  ]
})

export default router
