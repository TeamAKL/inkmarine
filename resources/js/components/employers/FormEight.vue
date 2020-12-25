<!-- ==================== InJuery ===================== -->
<!-- Image 27 -->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Injury</button>
        </div>

        <!-- DataTable -->
        <div class="container">
            <data-table
                :columns="columns"
                :data = "users"
                :per-page="perPage"
                @onTablePropsChanged="reloadTable"
            >
                <div slot="filters" slot-scope="{ tableData, perPage }">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <select class="form-control" v-model="tableData.length">
                                <option :key="page" v-for="page in perPage">{{ page }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <input
                                class="form-control"
                                v-model="tableData.search"
                                placeholder="Search Injury">
                        </div>
                    </div>
                </div>
                <tbody slot="body" slot-scope="{ data }">
                <tr
                    :key="item.id"
                    v-for="item in data">
                    <td class="text-left">{{item.illness}}</td>
                    <td class="text-left">{{item.medical_name}}</td>
                    <td class="text-left">{{item.hospital_name}}</td>
                    <td class="text-left">{{item.start_date}}</td>
                    <td class="text-left">{{item.recovery_date}}</td>
                    <!-- <td class="text-left">{{item.hospital_type}}</td> -->
                    <td class="text-left">{{item.expenses_won}} {{item.expenses_won_currency}}</td>
					<td class="text-left">{{item.expenses_ex}} {{item.expenses_ex_currency}}</td>
                    <!-- <td class="text-left">{{item.remark}}</td> -->
                    <td class="text-left">
                        <button :class="'btn btn-md btn-primary'" @click="EditItem(item)" title="Edit">
                            <span>
                                <i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
                            </span>
                            &nbsp;
                            Edit
                        </button>
                        <button :class="'btn btn-md btn-danger'" @click="onDeleteItem(item)" title="Delete">
                            <span>
                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                            </span>
                            &nbsp;
                            Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </data-table>
        </div>

        <!-- Modal -->
		<modal name="injury_modal" :clickToClose="false" height="auto" class="injury_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Injury</h5>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="injury_illness">Illness</label>
                            <input type="text" class="form-control" id="injury_illness" name="injury_illness"  v-model.trim="injury_illness">
                        </div>

						<div class="form-group">
                            <label for="injury_medical_name">Medical Name</label>
                             <input type="text" class="form-control" id="injury_medical_name" name="injury_medical_name"  v-model.trim="injury_medical_name">
                        </div>

						<div class="form-group">
                            <label for="injury_hospital_name">Hospital Name</label>
                             <input type="text" class="form-control" id="injury_hospital_name" name="injury_hospital_name"  v-model.trim="injury_hospital_name">
                        </div>

                        <div class="form-group">
                            <label for="injury_start_date">Start Date</label>
                            <date-picker v-model="injury_start_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="injur_recovery_date">Recovery Date</label>
                            <date-picker v-model="injury_recovery_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="injury_hospital_type">Hospital Type</label>
                            <multiselect v-model="injury_hospital_type" :options="options" :searchable="false" :close-on-select="true" :show-labels="false"></multiselect>               
					    </div>

                        <div class="form-group">
                            <label for="injury_expense_won">Expenses Won</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="injury_expense_won" name="injury_expense_won" v-model.trim="injury_expenses_won" >
                                
                                    <select class="form-control col-4" v-model="injury_expenses_won_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="injury_expense_ex">Expense Ex</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="injury_expense_ex" name="injury_expense_ex" v-model.trim="injury_expenses_ex" >
                                
                                    <select class="form-control col-4" v-model="injury_expenses_ex_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="injury_remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="injury_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success" @click="saveInjury">Add</button>
                </div>
			</div>
		</modal>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
	.injury_modal {
		overflow: auto !important;
	}
</style>
<script>
	import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'

    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import moment from 'moment';
    import Multiselect from 'vue-multiselect';

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
				injury_illness: '',
                injury_id: null,
                injury_medical_name: '',
                injury_hospital_name: '',
                injury_start_date: '',
                injury_recovery_date: '',
                injury_hospital_type: 'Public',
				injury_expenses_won: '',
				injury_expenses_won_currency:'MMK',
				injury_expenses_ex: '',
				injury_expenses_ex_currency:'MMK',
                injury_remark: '',
                user_token: `${process.env.MIX_APP_TOKEN}`,
				options: ['Public', 'Private'],
				
				 perPage: [10, 25, 100],
                users: {},
                default_order_column:'id',
                default_order_dir:'desc',
                tableProps: {
                    search: '',
                    length: 10,
                    column: 'id',
                    dir: 'desc',
                },
                columns: [
                    {
                        label: 'Illness',
						name: 'illness',
                    },
                    {
                        label: 'Medical Name',
						name: 'medical_name',			
                    },
                      {
                        label: 'Hospital Name',
						name: 'hospital_name',
                    },
                      {
                        label: 'Start Date',
						name: 'start_date',
					},
					 {
                        label: 'Recovery Date',
						name: 'recovery_date',
					},
					//  {
                    //     label: 'Hospital Type',
					// 	name: 'hospital_type',
                    // },
					 {
                        label: 'Expense Won',
						name: 'expense_won',
					},
					 {
                        label: 'Expense Ex',
						name: 'expense_ex',
					},
					//  {
                    //     label: 'Remark',
					// 	name: 'remark',
                    // },
                    {
						label: 'Action',
                    }
                ]
			}
        },
        created() {
            const date = new Date();
            this.injury_start_date = moment(date).format('DD-MM-YYYY');
            this.injury_recovery_date = moment(date).format('DD-MM-YYYY');
        },
		  methods: {
      validate() {
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to go next step ",
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if(result.isConfirmed) {
                    return true;
                } else {
                    return false;
                }
            });
        },
         showModal() {
           this.$modal.show('injury_modal');
            },

            hideModal() {
                this.$modal.hide('injury_modal');
                this.clearForm();
                },

        saveInjury() {

			 axios.post('/api/save-injury', {
                'employer_id': this.employerId,
                'illness': this.injury_illness,
				'medical_name': this.injury_medical_name,
				'hospital_name': this.injury_hospital_name,
				'start_date': this.injury_start_date,
				'recovery_date': this.injury_recovery_date,
				'hospital_type': this.injury_hospital_type,
                'expenses_won': this.injury_expenses_won,
                'expenses_won_currency':this.injury_expenses_won_currency,
                'expenses_ex': this.injury_expenses_ex,
                'expenses_ex_currency': this.injury_expenses_ex_currency,
                'remark': this.injury_remark,
				'injury_id': this.injury_id
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
               this.hideModal();
               $(document).find('span[class="validate-message"]').remove();
               this.getData();
               this.injury_id = null;
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
            });
        
        },
        clearForm(){
			this.injury_start_date = moment(new Date()).format('DD-MM-YYYY');
			this.injury_recovery_date = moment(new Date()).format('DD-MM-YYYY');
            this.injury_illness = '',
            this.injury_medical_name = '',
            this.injury_hospital_name = '',
            this.injury_hospital_type = 'Public',
            this.injury_expenses_won = '',
            this.injury_expenses_won_currency='MMK',
            this.injury_expenses_ex = '',
            this.injury_expenses_ex_currency = 'MMK',
            this.injury_remark = ''
        },
         getData() {
                axios.post('/api/all-injury', {
                    ...this.tableProps,
                    'user_id' : this.employerId
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.users = result.data;
                });
            },

            reloadTable(tableProps){
               this.tableProps = tableProps;
                this.getData(tableProps);
            },
            EditItem(item){
                this.injury_start_date = item.start_date,
				this.injury_recovery_date = item.recovery_date,
				this.injury_illness = item.illness,
				this.injury_medical_name = item.medical_name,
				this.injury_hospital_name = item.hospital_name,
				this.injury_hospital_type =item.hospital_type,
				this.injury_expenses_won = item.expenses_won,
				this.injury_expenses_won_currency=item.expenses_won_currency,
				this.injury_expenses_ex = item.expenses_ex,
				this.injury_expenses_ex_currency = item.expenses_ex_currency,
				this.injury_remark = item.remark
            }, 

         // Delete Family Members
        onDeleteItem(member) {
            const vm = this;
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + member.type,
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.post('/api/delete-injury', {
                        id: member.id,
                        employer_id: this.employerId
                    }, {
                        headers: {'Authorization': 'Bearer '+ this.user_token}
                    }).then(response => {
                        vm.getData();
                    })
                }
            });
        },
    },
		props: ['employerId']
	}
</script>
