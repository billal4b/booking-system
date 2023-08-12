<template>

    <div class="card">
        <div class="card-header">
            <h4>
                Booking List
                <router-link to="/booking/create" class="btn btn-primary float-end">
                    Add Booking
                </router-link>
            </h4>
        </div>
        <div class="card-body">
            <div v-if="this.success.length > 0" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ this.success }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Details</th>
                        <th>Booking Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody v-if="this.booking.length > 0">
                    <tr v-for="(data, index) in this.booking" :key="index">
                        <td> {{ data.id }}</td>
                        <td> {{ data.meeting_title }}</td>
                        <td> {{ data.description }}</td>
                        <td> {{ data.booking_date }}</td>
                        <td> {{ data.start_time }}</td>
                        <td> {{ data.end_time }}</td>
                        <td>

                            <button @click="deleteBooking(data.id )" type="button" class="btn btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="7"> <strong>Loading..........</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
import axios from 'axios'
export default {
    name: 'booking',
    data() {
        return {
            booking: [],
            success: ''
        }
    },
    mounted() {
        this.getBooking();
    },
    methods: {
        getBooking(){
            axios.get('http://localhost:8000/api/booking').then((response) => {
                this.booking = response.data.data.data
                // console.log(this.booking)
            })
        },
        deleteBooking(bookingID) {
            if(confirm('Are you sure, you want to delete this data?')) {
              //  console.log(bookingID)
                axios.delete(`http://localhost:8000/api/booking/${bookingID}/delete`)
                    .then((response) => {
                       // alert(response.data.message);
                        this.success = response.data.message;
                        this.getBooking();
                })
                .catch(function(error) {

                    if(error.response.status == 404) {
                        alert(error.response.data.errors)

                    }

                });

            }
        },
    },
}
</script>


