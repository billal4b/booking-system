<template>
    <div class="card">
        <div class="card-header">
            <h4>
                Add Booking
            </h4>
        </div>
        <div class="card-body">

            <ul v-if="Object.keys(this.errorList).length > 0" class="alert alert-warning">
                <li v-for="(error, index) in this.errorList" :key="index" class="mb-0 ms-3">
                    <strong>{{ error[0] }}</strong>
                </li>
            </ul>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                <input v-model="model.booking.meeting_title" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text">Details</span>
                <textarea v-model="model.booking.description" class="form-control" aria-label="With textarea"></textarea>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
                <input v-model="model.booking.booking_date" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Start time</span>
                <input v-model="model.booking.start_time" type="time" class="form-control" aria-label="Username">
                <span class="input-group-text">End time</span>
                <input v-model="model.booking.end_time" type="time" class="form-control" aria-label="Server">
            </div>

            <div class="input-group mb-3">
               <button @click="saveBooking" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'addBooking',
    data() {
        return {
            errorList: '',
            model: {
                booking: {
                    meeting_title: '',
                    description: '',
                    booking_date: '',
                    start_time: '',
                    end_time: ''
                }
            }
        }
    },
    methods: {
        saveBooking() {
            var mythis = this;
            axios.post('http://localhost:8000/api/booking', this.model.booking)
                .then(response => {
                    console.log(response.data);
                    alert(response.data.message);
                    this.model.booking = {
                        meeting_title: '',
                        description: '',
                        booking_date: '',
                        start_time: '',
                        end_time: ''
                    }
                    this.errorList = '';
                })
                .catch(function(error) {

                    if(error.response.status == 422) {
                        mythis.errorList = error.response.data.errors;
                    } else {
                        mythis.errorList = [['Something went wrong']];
                    }

                })
        }
    },
}
</script>


