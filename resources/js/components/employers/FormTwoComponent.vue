<template>
    <div>
        <input type="hidden" v-model="employerId">
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
                <!-- <input type="text" class="form-control" id="code" name="code" v-model.trim="code"> -->
                <select name="code" id="code" v-model.trim="code" class="form-control">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    <option value="xl">XL</option>
                    <option value="xxl">XXL</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="pants">Pants</label>
                <!-- <input type="text" class="form-control" id="pants" name="pants" v-model.trim="pants"> -->
                <multiselect v-model="pants" :max-height="200" :options="pan" placeholder="Select one" label="size" track-by="size" ></multiselect>
            </div>

            <div class="form-group col-md-4">
                <label for="shoe">Shoe</label>
                <input type="text" class="form-control" id="shoe" name="shoe" v-model.trim="shoe">
            </div>
        </div>

    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
import Multiselect from 'vue-multiselect'
export default {
    components: {
        DatePicker,
        Multiselect
    },
    data() {
        return {
            user_token: `${process.env.MIX_APP_TOKEN}`,
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
            code: 'small',
            shoe: '',
            pants: {
                size: 28
            },
            pan: [
                {size: 28},{size: 29},
                {size: 30},{size: 31},{size: 32},{size: 33},{size: 34},{size: 35},{size: 36},{size: 37},{size: 38},{size: 39},{size: 40},
            ],
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
                'basic_salary': this.basic_salary,
                'phone_number': this.phone_number,
                'cell_phone_number': this.cell_phone_number,
                'drinking': this.drinking,
                'smoking': this.smoking,
                'deperature_date': this.deperature_date,
                'rank': this.rank,
                'company': this.company,
                'home_allowance': this.home_allowance,
                'total_salary': this.total_salary,
                'fixed_pay': this.fixed_pay,
                'leave_pay': this.leave_pay,
                'onbroad_pay': this.onbroad_pay,
                'code': this.code,
                'shoe': this.shoe,
                'pants': this.pants.size,
                'employer_detail_id': this.employer_detail_id,
                'employerId': this.employerId,
                'basicsalary_currency': this.basicsalary_currency,
                'onbroadpay_currency': this.onbroadpay_currency,
                'fixpay_currency': this.fixpay_currency,
                'leavepay_currency': this.leavepay_currency,
                'home_allowance_currency': this.home_allowance_currency,
                'total_salary_currency': this.total_salary_currency
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
                     $(document).find('span[class="validate-message"]').remove();
                    $.each(err.response.data.error, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                          el.after($('<span style="color: red;" class="validate-message" >'+error[0]+'</span>'));
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
