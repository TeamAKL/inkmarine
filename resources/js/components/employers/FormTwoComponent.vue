<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone_number">Phone Number</label>
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
                <input type="text" class="form-control" id="deperature_date" name="deperature_date" v-model.trim="deperature_date">
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

            <div class="form-group col-md-6">
                <label for="basic_salary">Basic Salary</label>
                <input type="text" class="form-control" id="basic_salary" name="basic_salary" v-model.trim="basic_salary">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="home_allowance">Home Allowance</label>
                <input type="text" class="form-control" id="home_allowance" name="home_allowance" v-model.trim="home_allowance">
            </div>

            <div class="form-group col-md-6">
                <label for="total_salary">Total Salary</label>
                <input type="text" class="form-control" id="total_salary" name="total_salary" v-model.trim="total_salary">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="fixed_pay">Fixed Pay</label>
                <input type="text" class="form-control" id="fixed_pay" name="fixed_pay" v-model.trim="fixed_pay">
            </div>

            <div class="form-group col-md-4">
                <label for="leave_pay">Leave Pay</label>
                <input type="text" class="form-control" id="leave_pay" name="leave_pay" v-model.trim="leave_pay">
            </div>

            <div class="form-group col-md-4">
                <label for="onbroad_pay">Onbroad Pay</label>
                <input type="text" class="form-control" id="onbroad_pay" name="onbroad_pay" v-model.trim="onbroad_pay">
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
export default {
    data() {
        return {
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
            pan: ''
        }
    },
    methods: {
        validate() {
            var isValid = true;
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }
    },
    props: ['id'],
}
</script>
