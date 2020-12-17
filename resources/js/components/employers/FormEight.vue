<!-- ==================== InJuery ===================== -->
<!-- Image 27 -->
<template>
	<div>
		<div class="form-group">
			<label for="illness">Lllness</label>
			<input type="text" name="illness" id="illness" v-model="illness" class="form-control">
		</div>
		<div class="form-group">
			<label for="medical_name">Medical Name</label>
			<input type="text" name="medical_name" id="medical_name" v-model="medical_name" class="form-control">
		</div>
		<div class="form-group">
			<label for="hospital_name">Hospital Name</label>
			<input type="text" name="hospital_name" id="hospital_name" v-model="hospital_name" class="form-control">
		</div>
		<div class="form-group">
			<label for="start_date">Start Date</label>
            <date-picker v-model.trim="start_date" valueType="format" class="date-picker" format="DD-MM-YYYY" ></date-picker>
		</div>

		<div class="form-group">
			<label for="recovery_date">Recovery Date</label>
            <date-picker v-model.trim="recovery_date" valueType="format" class="date-picker" format="DD-MM-YYYY" ></date-picker>
		</div>
		<div class="form-group">
            <label for="hospital_type">Hospital Type</label>
            <multiselect v-model="hospital_type" :options="options" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="Select hospital type"></multiselect>
		</div>
		<div class="form-group">
			<label for="expenses_won">Expenses Won</label>
			<input type="text" name="expenses_won" id="expenses_won" v-model="expenses_won" class="form-control">
		</div>
		<div class="form-group">
			<label for="expenses_ex">Expenses Ex</label>
			<input type="text" name="expenses_ex" id="expenses_ex" v-model="expenses_ex" class="form-control">
		</div>
		<div class="form-group">
			<label for="remark">Remark</label>
			<textarea name="remark" id="remark" cols="30" rows="10" v-model.trim="remark" class="form-control"></textarea>
		</div>

	</div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
	import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'

    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import moment from 'moment'

    import Multiselect from 'vue-multiselect'

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
	export default {
        components: {
            DatePicker,
            Multiselect,
        },
		data() {
			return {
				illness: '',
                injury_id: null,
                medical_name: '',
                hospital_name: '',
                start_date: '',
                recovery_date: '',
                hospital_type: 'Public',
                expenses_won: '',
                expenses_ex: '',
                remark: '',
                user_token: `${process.env.MIX_APP_TOKEN}`,
                options: ['Public', 'Private']
			}
        },
        created() {
            const date = new Date();
            this.start_date = moment(date).format('DD-MM-YYYY');
            this.recovery_date = moment(date).format('DD-MM-YYYY');
        },
		methods: {
			async validate() {
				var isValid;
				await axios.post('/api/save-injury', {
					"illness": this.illness,
                    'injury_id': this.injury_id,
                    'medical_name': this.medical_name,
                    'hospital_name': this.hospital_name,
                    'start_date': this.start_date,
                    'recovery_date': this.recovery_date,
                    'hospital_type': this.hospital_type,
                    'expenses_won': this.expenses_won,
                    'expenses_ex': this.expenses_ex,
                    'remark': this.remark,
					'employer_id': this.employerId
				}, {
					headers: {'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.injury_id = result.data.injury.id;
					isValid = true;
					$(document).find('span[class="validate-message"]').remove();
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

				return isValid;
			},
		},
		props: ['employerId']
	}
</script>
