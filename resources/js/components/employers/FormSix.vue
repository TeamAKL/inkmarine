<!--=========================== Other Company Information ============================-->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" @click="showModal">Add Company Career</button>
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
                    <td class="text-left">{{item.rank}}</td>
                    <td class="text-left">{{item.company_name}}</td>
                    <td class="text-left">{{item.ship_name}}</td>
                    <td class="text-left">{{item.boarding_date}}</td>
                     <td class="text-left">{{item.leaving_date}}</td>
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
        <!-- CModal -->
        <!-- =============================== -->
        <c-modal :style="{visibility: cvisibility, zIndex: czindex}">
            <div class="cmodal-content" :style="{transform: cstyle, opacity: copacity}">
                <div class="cmodal-header">Add Company Careers</div>
                <div class="cmodal-body">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="">Rank</label>
                            <input type="text" class="form-control" id="rank" name="rank"  v-model.trim="rank">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">GRT</label>
                            <input type="text" class="form-control" id="grt" name="grt"  v-model.trim="grt">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">KW</label>
                            <input type="text" class="form-control" id="kw" name="kw"  v-model.trim="kw">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="typo__label" for="">Company</label>
                             <input type="text" class="form-control" id="company_name" name="company_name"  v-model.trim="company_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="typo__label" for="">Ship Name</label>
                             <input type="text" class="form-control" id="ship_name" name="ship_name"  v-model.trim="ship_name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Boarding Date</label>
                             <date-picker v-model="boarding_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Leaving Date</label>
                            <date-picker v-model="leaving_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Area</label>
                            <input type="text" class="form-control" id="area" name="area"  v-model.trim="area">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Remark</label>
                        <textarea name="company_remark" id="company_remark" v-model.trim="company_remark" cols="30" rows="6" class="form-control"></textarea>
                    </div>

                </div>
                <div class="cmodal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success"  @click="save">Add</button>
                </div>
            </div>
        </c-modal>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment'
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

export default {
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
            rank: '',
            grt: '',
            kw: '',
            company_name: '',
            ship_name: '',
            boarding_date: '',
            leaving_date: '',
            area: '',
            company_remark: '',
            company_career_id: null,

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
                        label: 'Rank',
                        name: 'rank',
                        orderable: true,
                    },
                    {
                        label: 'Company Name',
                        name: 'company_name',
                    },
                      {
                        label: 'Ship Name',
                        name: 'ship_name',
                    },
                      {
                        label: 'Boarding Date',
                        name: 'boarding_date',
                    },
                      {
                        label: 'Leaving Date',
                        name: 'leaving_date',
                    },
                    {
                        label: 'Action'
                    }
                ]
        }
    },
    created() {
        const date = new Date();
        this.boarding_date = moment(date).format('DD-MM-YYYY');
        this.leaving_date = moment(date).format('DD-MM-YYYY');
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
            this.copacity = 1;
            this.cstyle = 'translateY(0)';
            this.cvisibility = 'visible';
            this.czindex = 3;
        },

        hideModal() {
            this.cstyle = 'translateY(-100%)';
            this.copacity = 0;
            let that = this;
            setTimeout(function(){ that.cvisibility = 'hidden'; that.czindex= -100;}, 500)
        },
        save() {
             axios.post('/api/save-other-company-careers', {
                'rank': this.rank,
                'grt': this.grt,
                'kw': this.kw,
                'company_name': this.company_name,
                'ship_name': this.ship_name,
                'boarding_date': this.boarding_date,
                'leaving_date':this.leaving_date,
                'area': this.area,
                'company_remark':this.company_remark,
                'company_career_id' : this.company_career_id,
                'user_id':this.employerId,
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
                console.log(result);
               this.hideModal();
               this.getData();
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

            this.rank = '',
            this.grt = '',
            this.kw = '',
            this.company_name = '',
            this.ship_name = '',
            this.company_name = '',
            this.boarding_date = moment(new Date()).format('DD-MM-YYYY');
            this.leaving_date = moment(new Date()).format('DD-MM-YYYY');
            this.area = '',
            this.company_remark = ''

        },
         getData() {
                axios.post('/api/get_all_company_careers_by_employerId', {
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
               this.company_career_id = item.id;
               this.rank = item.rank;
               this.grt = item.grt;
               this.kw = item.kw;
               this.ship_name = item.ship_name;
               this.company_name = item.company_name;
               this.boarding_date = moment(item.boarding_date).format('DD-MM-YYYY');
               this.leaving_date = moment(item.leaving_date).format('DD-MM-YYYY');
               this.area = item.area;
               this.company_remark = item.remark;
               this.user_id = item.employerId;
              
            }, 

        // Delete Company Career
        onDeleteItem(company) {
            const vm = this;
            return Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + company.rank,
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.post('/api/delete-company-career', {
                        id: company.id,
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

<style scoped>

</style>
