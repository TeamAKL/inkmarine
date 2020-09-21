<template>
    <div>
        <form action="">
            <div class="form-group">
                <label for="crewcode">Crew Code</label>
                <input type="text" id="crewcode" name="crewcode" v-model.trim="crewcode" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" v-model.trim="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" id="nationality" name="nationality" v-model.trim="nationality" class="form-control">
            </div>

            <div class="form-group prelative">
                <label for="dob">Date Of Birth</label>
                <!-- <input type="date" id="dob" name="dob" v-model.trim="dob" class="form-control"> -->
                <date-picker v-model="dob" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>

            <div class="form-group">
                <label for="pob">Place Of Birth</label>
                <input type="text" id="pob" name="pob" v-model.trim="pob" class="form-control">
            </div>

            <div class="form-group">
                <label for="edulevel">Education Level</label>
                <input type="text" id="edulevel" name="edulevel" v-model.trim="edulevel" class="form-control">
            </div>
        </form>
    </div>
</template>
<style scoped>
.prelative {
    position: relative !important;
}
.date-picker {
    display: block;
    width: 100%;
}
</style>
<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment'

export default {
    components: {
        DatePicker
    },
    data() {
        return {
            user_token: "eyJpdiI6IjlaSHRCM1d4V0ZDd3RoNXpNUnF4MUE9PSIsInZhbHVlIjoiUkRoQm1BdTV6ZFoxcEdkaTlqcU5uOUlrZDRKdDUza0RGVHoybXNjUDlXanVIV2NsdFVpenVWSmpaWDBIdGc0a09uc2k0Qzl4cEhWbUl3UjJaTmcyOTc2UTRWSmp0RVoxdTR5YXdCelwvNmRWbUM3Z0p4T25oRzVyUnFoWmRueFRLIiwibWFjIjoiN2VhZDdkYjYzMzk1YzU2NjVmZDM1ZDQ1NjM0MzA0YmE4ZmNlOWM3MTNkNWZhZDI5ZDgxOWQyNDM4YzJlYzQ5MSJ9",
            crewcode: '',
            name: '',
            nationality: '',
            dob: '',
            pob: '',
            edulevel: ''
        }
    },
    created() {
        const date = new Date();
        this.dob = moment(date).format('DD-MM-YYYY');
    },
    methods: {
        validate() {
            var response = axios.post('/api/save-form-one', {
                'crewcode': this.crewcode,
                'name': this.name,
                'nationality': this.nationality,
                'dob': this.dob,
                'pob': this.pob,
                'edulevel': this.edulevel
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then((result) => {
                return true;
            }).catch((err) => {
                if (err.response.status == 400) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please fill all required fields!'
                    });
                    $.each(err.response.data.error, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
                return false;
                // return true;
            });

            this.$emit('on-validate', this.$data, response)
            return response;
        }
    }
}
</script>
