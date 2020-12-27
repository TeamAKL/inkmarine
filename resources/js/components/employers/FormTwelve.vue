<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="division">Division</label>
                <!-- <input type="text" id="division" name="division" v-model.trim="division" class="form-control"> -->
                <multiselect v-model="division" :options="options_division" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="---- Select Division -----"></multiselect>
            </div>

            <div class="form-group col-md-12">
                <label for="ship_name">Ship Name</label>
                <input type="text" id="ship_name" name="ship_name" v-model.trim="ship_name" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="rank">Rank</label>
                <input type="text" id="rank" name="rank" v-model.trim="rank" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="app_boarding_date">Boarding Date</label>
                <date-picker v-model.trim="app_boarding_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>

            <div class="form-group col-md-12">
                <label for="app_leaving_date">Leaving Date</label>
                <date-picker v-model.trim="app_leaving_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>

            <div class="form-group col-md-12">
                <label for="boarding_period">Boarding Period</label>
                <input type="text" id="boarding_period" name="boarding_period" v-model.trim="boarding_period" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="place">Place</label>
                <input type="text" id="place" name="place" v-model.trim="place" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="remark">Remark</label>
            <textarea name="remark" id="remark" cols="30" rows="10" v-model.trim="remark" class="form-control"></textarea>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect'
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
        DatePicker,
        Multiselect
    },
    data() {
        return {
            user_token: `${process.env.MIX_APP_TOKEN}`,
            division: '',
            options_division: ['SIGN ON', 'SIGN OFF'],
            ship_name: '',
            rank: '',
            app_boarding_date: '',
            app_leaving_date: '',
            boarding_period: '',
            place: '',
            remark: '',
            appointment_info_id: ''
        }
    },
    created() {
        const date = new Date();
        this.app_boarding_date = moment(date).format('DD-MM-YYYY');
        this.app_leaving_date = moment(date).format('DD-MM-YYYY');
    },
    methods: {
        async validate() {
            var isValid;
            await axios.post('/api/save-appointment-info', {
                'division': this.division,
                'ship_name': this.ship_name,
                'rank': this.rank,
                'app_boarding_date': this.app_boarding_date,
                'app_leaving_date': this.app_leaving_date,
                'boarding_period': this.boarding_period,
                'place': this.place,
                'remark': this.remark,
                'appointment_info_id': this.appointment_info_id,
                'user_id':this.employerId,
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then((result) => {
                this.appointment_info_id = result.data.appointmentInfos.id;
                isValid = true;
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
                isValid = false;
            });
            this.$emit('on-validate', this.personId);
            return isValid;
        }
    },
    props: ['employerId']
}
</script>
