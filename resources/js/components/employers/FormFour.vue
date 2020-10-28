<!--=================== Family Member Vue ==================================-->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Family Member</button>
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
                    <td class="text-left">{{item.name}}</td>
                    <td class="text-left">{{item.relationship}}</td>
                    <td class="text-left">{{item.phone_number}}</td>
                    <td class="text-left">{{item.dob}}</td>
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
		<modal name="family_member_modal" :clickToClose="false" height="auto" class="family_member_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Family Member</h5>
				</div>
				<div class="modal-body">
					<form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="member_name" name="member_name"  v-model.trim="member_name">
                        </div>

                        <div class="form-group">
                            <label for="relation">Relationship</label>
                            <input type="text" class="form-control" id="member_relation" name="member_relation" v-model.trim="member_relation" >
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="member_phone_number" name="member_phone_number" v-model.trim="member_phone_number" >
                        </div>

                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <date-picker v-model="member_dob" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="member_remark" id="member_remark" v-model.trim="member_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success" @click="save">Add</button>
                </div>
			</div>
		</modal>
    </div>
</template>
<style scoped>
.family_member_modal {
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
            member_name: '',
            member_relation: '',
            member_phone_number: '',
            member_dob: '',
            member_remark: '',
            family_member_id: null,

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
                        label: 'Name',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Relationship',
                        name: 'relationship',
                    },
                      {
                        label: 'Phone Numbers',
                        name: 'phone_number',
                    },
                      {
                        label: 'Date of Birth',
                        name: 'dob',
                    },
                    {
                        label: 'Action'
                    }
                ]
        }
    },
    created() {
        const date = new Date();
        this.member_dob = moment(date).format('DD-MM-YYYY');
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
           this.$modal.show('family_member_modal');
            },

            hideModal() {
                this.$modal.hide('family_member_modal');
                this.clearForm();
                },

        save() {
             axios.post('/api/save-family-member', {
                'member_name': this.member_name,
                'member_relation': this.member_relation,
                'member_phone_number': this.member_phone_number,
                'member_dob': this.member_dob,
                'member_remark': this.member_remark,
                'family_member_id': this.family_member_id,
                'user_id':this.employerId,
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
               this.hideModal();
               $(document).find('span[class="validate-message"]').remove();
               this.getData();
               this.family_member_id = null;
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
            this.member_name = '',
            this.member_relation = '',
            this.member_phone_number = '',
            this.member_dob = moment(new Date()).format('DD-MM-YYYY');
            this.member_remark = ''

        },
         getData() {
                axios.post('/api/get_all_family_members_by_employer', {
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
               this.member_name = item.name;
               this.member_relation = item.relationship;
               this.member_phone_number = item.phone_number;
               this.member_dob = moment(item.dob).format('DD-MM-YYYY');
               this.member_remark = item.remark;
               this.user_id = item.employerId;
               this.family_member_id = item.id;
            }, 

         // Delete Family Members
        onDeleteItem(member) {
            const vm = this;
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + member.name,
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.post('/api/delete-family-member', {
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
