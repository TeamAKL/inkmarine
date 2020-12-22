<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Disease</button>
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
                                placeholder="Search Email or Name">
                        </div>
                    </div>
                </div>
                <tbody slot="body" slot-scope="{ data }">
                <tr
                    :key="item.id"
                    v-for="item in data">
                    <td class="text-left">{{item.start_date}}</td>
                    <td class="text-left">{{item.end_date}}</td>
                    <td class="text-left">{{item.illness}}</td>
                    <td class="text-left">{{item.medicine}}</td>
                    <td class="text-left">{{item.other_medicine}}</td>
                    <td class="text-left">{{item.remark}}</td>
                    <td class="text-left">
                        <button :class="'btn btn-xs btn-primary'" @click="EditItem(item)" title="Edit">
                            <span>
                                <i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
                            </span>
                            &nbsp;
                            Edit
                        </button>
                        <button :class="'btn btn-xs btn-danger'" @click="onDeleteItem(item)" title="Delete">
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
		<modal name="disease_modal" :clickToClose="false" height="auto" class="disease_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Disease</h5>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="start_date">Start Date</label>
                            <date-picker v-model="disease_start_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="end_date">End Date</label>
                            <date-picker v-model="disease_end_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="illness">Illness</label>
                            <input type="text" class="form-control" id="illness" name="illness"  v-model.trim="disease_illness">
                        </div>

                        <div class="form-group">
                            <label for="medicine">Medicine</label>
                            <input type="text" class="form-control" id="medicine" name="medicine" v-model.trim="disease_medicine" >
                        </div>

                        <div class="form-group">
                            <label for="other_medicine">Other_medicine</label>
                            <input type="text" class="form-control" id="other_medicine" name="other_medicine" v-model.trim="disease_other_medicine" >
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="disease_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success" @click="saveDisease">Add</button>
                </div>
			</div>
		</modal>
    </div>
</template>
<style scoped>
.disease_modal {
    overflow: auto !important;
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
 export  default {
     components: {
        DatePicker
    },
    data() {
        return {
            //Modal
            czindex: -100,
            copacity: 0,
            cvisibility: 'hidden',
            cstyle:  'translateY(-100%)',

            user_token: `${process.env.MIX_APP_TOKEN}`,
            disease_start_date: '',
			disease_end_date: '',
			disease_illness:'',
            disease_medicine: '',
            disease_other_medicine: '',
			disease_remark: '',
			diseaseId: null,

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
                        label: 'Start Date',
						name: 'start_date',
						width: '10%'
                    },
                    {
                        label: 'End Date',
						name: 'end_date',

						
                    },
                      {
                        label: 'Illness',
						name: 'illness',
                    },
                      {
                        label: 'Medicine',
						name: 'medicine',
					},
					 {
                        label: 'Other Medicine',
						name: 'other_medicine',
					},
					 {
                        label: 'Remark',
						name: 'remark',
                    },
                    {
						label: 'Action',
                    }
                ]
        }
    },
    created() {
        const date = new Date();
		this.disease_start_date = moment(date).format('DD-MM-YYYY');
		this.disease_end_date = moment(date).format('DD-MM-YYYY');
        this.getData();
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
           this.$modal.show('disease_modal');
            },

            hideModal() {
                this.$modal.hide('disease_modal');
                this.clearForm();
                },

        saveDisease() {
			// console.log(this.start_date);
			// console.log(this.end_date);
			// console.log(this.illness);
			// console.log(this.medicine);
			// console.log(this.start_date);
			// console.log(this.start_date);
            
			 axios.post('/api/save-disease', {
                'employerId': this.employerId,
                'start_date': this.disease_start_date,
                'end_date': this.disease_end_date,
				'illness': this.disease_illness,
				'medicine': this.disease_medicine,
                'other_medicine': this.disease_other_medicine,
				'remark': this.disease_remark,
				'diseaseId': this.diseaseId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
               this.hideModal();
               $(document).find('span[class="validate-message"]').remove();
               this.getData();
               this.diseaseId = null;
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
        
        },
        clearForm(){
            this.disease_start_date = moment(new Date()).format('DD-MM-YYYY');
            this.disease_end_date = moment(new Date()).format('DD-MM-YYYY');
			this.disease_illness = '',
			this.disease_medicine = '',
			this.disease_other_medicine = '',
            this.disease_remark = ''

        },
         getData() {
                axios.post('/api/get-all-disease', {
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
               this.showModal();
			   this.disease_start_date = moment(item.start_date).format('DD-MM-YYYY');
               this.disease_end_date = moment(item.end_date).format('DD-MM-YYYY');
			   this.disease_illness = item.illness;
			   this.disease_medicine = item.medicine;
               this.disease_other_medicine = item.other_medicine;
               this.disease_remark = item.remark;
               this.employerId = item.employer_id;
               this.diseaseId = item.id;
            }, 

         // Delete Family Members
        onDeleteItem(member) {
            const vm = this;
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + member.illness,
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.post('/api/delete-disease', {
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
