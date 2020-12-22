<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Accident</button>
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
                    <td class="text-left">{{item.ship_name}}</td>
                    <td class="text-left">{{item.rank}}</td>
                    <td class="text-left">{{item.date}}</td>
                    <td class="text-left">{{item.type}}</td>
                    <td class="text-left">{{item.reason}}</td>
                    <td class="text-left">{{item.cost}} {{item.currency}}</td>
                    <td class="text-left">{{item.re_use}}</td>
                    <td class="text-left">{{item.etc}}</td>
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
		<modal name="accident_modal" :clickToClose="false" height="auto" class="accident_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Accident</h5>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="accident_ship_name">Ship Name</label>
                            <input type="text" class="form-control" id="accident_ship_name" name="accident_ship_name"  v-model.trim="accident_ship_name">
                        </div>

						<div class="form-group">
                            <label for="accident_rank">Rank</label>
                             <input type="text" class="form-control" id="accident_rank" name="accident_rank"  v-model.trim="accident_rank">
                        </div>

                        <div class="form-group">
                            <label for="accident_date">Date</label>
                            <date-picker v-model="accident_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>
                        <div class="form-group">
                            <label for="accident_type">Type</label>
                            <input type="text" class="form-control" id="accident_type" name="accident_type" v-model.trim="accident_type" >
                        </div>

                        <div class="form-group">
                            <label for="accident_reason">Reason</label>
                            <input type="text" class="form-control" id="accident_reason" name="accident_reason" v-model.trim="accident_reason" >
                        </div>

                        <div class="form-group">
                            <label for="accident_cost">Cost</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="accident_cost" name="accident_cost" v-model.trim="accident_cost" >
                                
                                    <select class="form-control col-4" v-model="accident_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>
                                
                            </div>
                        </div>
                        
                           

                        <div class="form-group">
                            <label for="accident_re_use">Re-use</label>
                            <input type="text" class="form-control" id="accident_re_use" name="accident_re_use" v-model.trim="accident_re_use" >
                        </div>

                         <div class="form-group">
                            <label for="accident_etc">Etc</label>
                            <input type="text" class="form-control" id="accident_etc" name="accident_etc" v-model.trim="accident_etc" >
                        </div>

                        <div class="form-group">
                            <label for="accident_remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="accident_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success" @click="saveAccident">Add</button>
                </div>
			</div>
		</modal>
    </div>
</template>
<style scoped>
.accident_modal {
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
            accident_ship_name: '',
			accident_rank: '',
			accident_date:'',
            accident_type: '',
            accident_reason: '',
            accident_cost: '',
            accident_currency:'MMK',
            accident_re_use: '',
            accident_etc: '',
			accident_remark: '',
			accidentId: null,

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
                        label: 'Ship Name',
						name: 'ship_name',
                    },
                    {
                        label: 'Rank',
						name: 'rank',

						
                    },
                      {
                        label: 'Date',
						name: 'date',
                    },
                      {
                        label: 'Type',
						name: 'type',
					},
					 {
                        label: 'Reason',
						name: 'reason',
                    },
                    {
                        label: 'Cost',
						name: 'cost',
					},
					 {
                        label: 'Re-use',
						name: 're_use',
                    },
                    {
                        label: 'Etc',
						name: 'etc',
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
		this.accident_date = moment(date).format('DD-MM-YYYY');
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
           this.$modal.show('accident_modal');
            },

            hideModal() {
                this.$modal.hide('accident_modal');
                this.clearForm();
                },

        saveAccident() {
            //  console.log(this.accident_ship_name);
            //  console.log(this.accident_rank);
            //  console.log(this.accident_date);
            //  console.log(this.accident_type);
            //  console.log(this.accident_reason);
            //  console.log(this.accident_cost);
            //  console.log(this.accident_currency);
            //  console.log(this.accident_re_use);
            //  console.log(this.accident_etc);
            //  console.log(this.accident_remark);


			 axios.post('/api/save-accident', {
                'employerId': this.employerId,
                'ship_name': this.accident_ship_name,
                'rank': this.accident_rank,
				'date': this.accident_date,
				'type': this.accident_type,
                'reason': this.accident_reason,
                'cost': this.accident_cost,
                'currency':this.accident_currency,
                're_use': this.accident_re_use,
                'etc': this.accident_etc,
                'remark': this.accident_remark,
				'accidentId': this.accidentId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
               this.hideModal();
               $(document).find('span[class="validate-message"]').remove();
               this.getData();
               this.accidentId = null;
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
            this.accident_date = moment(new Date()).format('DD-MM-YYYY');
            this.accident_ship_name = '',
            this.accident_rank = '',
            this.accident_type = '',
            this.accident_reason = '',
            this.accident_cost = '',
            this.accident_currency='',
            this.accident_re_use = '',
            this.accident_etc = '',
            this.accident_remark = ''
        },
         getData() {
                axios.post('/api/get-all-accident', {
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
                this.accident_date = moment(item.date).format('DD-MM-YYYY');
                this.accident_ship_name = item.ship_name;
                this.accident_rank = item.rank;
                this.accident_type = item.type;
                this.accident_reason = item.reason;
                this.accident_cost = item.cost;
                this.accident_currency=item.currency
                this.accident_re_use = item.re_use;
                this.accident_etc = item.etc;
                this.accident_remark = item.remark;
                this.employerId = item.employer_id;
                this.accidentId = item.id;
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
                    axios.post('/api/delete-accident', {
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
