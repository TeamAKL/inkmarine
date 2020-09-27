<template>
    <div>
        <input type="text" v-model="employerId">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone_number">Phone Number </label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" v-model.trim="phone_number">
            </div>

            <div class="form-group col-md-6">
                <label for="cell_phone_number">Cell Phone Number</label>
                <input type="text" class="form-control" id="cell_phone_number" name="cell_phone_number" v-model.trim="cell_phone_number">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="drinking">Drinking</label>
                <input type="text" class="form-control" id="drinking" name="drinking" v-model.trim="drinking">
            </div>

            <div class="form-group col-md-6">
                <label for="smoking">Smoking</label>
                <input type="text" class="form-control" id="smoking" name="smoking" v-model.trim="smoking">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="deperature_date">Deperature Date</label>
                <date-picker v-model.trim="deperature_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>

            <div class="form-group col-md-6">
                <label for="rank">Rank</label>
                <input type="text" class="form-control" id="rank" name="rank" v-model.trim="rank">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" v-model.trim="company">
            </div>

            <div class="form-group col-md-5">
                <label for="basic_salary">Basic Salary</label>
                <input type="text" class="form-control" id="basic_salary" name="basic_salary" v-model.trim="basic_salary">
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="basicsalary_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="home_allowance">Home Allowance</label>
                <input type="text" class="form-control" id="home_allowance" name="home_allowance" v-model.trim="home_allowance" >
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="home_allowance_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="total_salary">Total Salary</label>
                <input type="text" class="form-control" id="total_salary" name="total_salary" v-model.trim="total_salary">
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="total_salary_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="fixed_pay">Fixed Pay</label>
                <input type="text" class="form-control" id="fixed_pay" name="fixed_pay" v-model.trim="fixed_pay">
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="fixpay_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="leave_pay">Leave Pay</label>
                <input type="text" class="form-control" id="leave_pay" name="leave_pay" v-model.trim="leave_pay">
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="leavepay_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="onbroad_pay">Onbroad Pay</label>
                <input type="text" class="form-control" id="onbroad_pay" name="onbroad_pay" v-model.trim="onbroad_pay">
            </div>
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <select class="form-control" v-model="onbroadpay_currency">
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                    <option value="SGD">SGD</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="code">Code</label>
                <input type="text" class="form-control" id="code" name="code" v-model.trim="code">
            </div>

            <div class="form-group col-md-4">
                <label for="pan">Pan</label>
                <input type="text" class="form-control" id="pan" name="pan" v-model.trim="pan">
            </div>

            <div class="form-group col-md-4">
                <label for="shoe">Shoe</label>
                <input type="text" class="form-control" id="shoe" name="shoe" v-model.trim="shoe">
            </div>
        </div>

    </div>
</template>

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
            phone_number: '',
            cell_phone_number: '',
            drinking: '',
            smoking: '',
            deperature_date: '',
            rank: '',
            company: '',
            basic_salary: '',
            home_allowance: '',
            total_salary: '',
            fixed_pay: '',
            leave_pay: '',
            onbroad_pay: '',
            code: '',
            shoe: '',
            pan: '',
            basicsalary_currency: 'MMK',
            onbroadpay_currency: 'MMK',
            fixpay_currency: 'MMK',
            leavepay_currency: 'MMK',
            home_allowance_currency: 'MMK',
            total_salary_currency: 'MMK',
            employer_detail_id: null
        }
    },
    created() {
        const date = new Date();
        this.deperature_date = moment(date).format('DD-MM-YYYY');
    },
    methods: {
        async validate() {
            var isValid;
            await axios.post('/api/save-form-two', {
                'basic_salary': this.basic_salary
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
                console.log(result);
                isValid = true;
            }).catch(err => {
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

            return isValid
        }
    },
    props: ['employerId'],
}
</script>
