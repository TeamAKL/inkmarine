<!-- ==================== Crew Evaluation =============== -->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Crew Evaluation</button>
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
                                placeholder="Search Crew Evaluation">
                        </div>
                    </div>
                </div>
                <tbody slot="body" slot-scope="{ data }">
                <tr
                    :key="item.id"
                    v-for="item in data">
                    <td class="text-left">{{item.date}}</td>
                    <td class="text-left">{{item.score}}</td>
                    <td class="text-left">{{item.re_use}}</td>
                    <td class="text-left">{{item.rate}}</td>
                    <td class="text-left">{{item.detail}}</td>
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
		<modal name="crew_evaluate_modal" :clickToClose="false" height="auto" class="crew_evaluate_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Crew Evaluation</h5>
				</div>
				<div class="modal-body">
					<form>

                        <div class="form-group">
                            <label for="crew_date">Date</label>
                            <date-picker v-model="crew_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="crew_score">Score</label>
                            <input type="text" class="form-control" id="crew_score" name="crew_score"  v-model.trim="crew_score">
                        </div>

						<div class="form-group">
                            <label for="crew_re_use">Re-use</label>
                            <multiselect v-model="crew_re_use" :options="options" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="---- Select Re Use -----"></multiselect>
                        </div>

                        <div class="form-group">
                            <label for="crew_rate">Rate</label>
                            <input type="text" class="form-control" id="crew_rate" name="crew_rate" v-model.trim="crew_rate" >
                        </div>

                        <div class="form-group">
                            <label for="crew_detail">Detail</label>
                            <input type="text" class="form-control" id="crew_detail" name="crew_detail" v-model.trim="crew_detail" >
                        </div>
                           
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success" @click="saveCrewEvaluate">Add</button>
                </div>
			</div>
		</modal>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'

    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import moment from 'moment';

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

    import Multiselect from 'vue-multiselect'

    export default {
        components: {
            DatePicker,
            Multiselect
        },
        data() {
            return {
                user_token: `${process.env.MIX_APP_TOKEN}`,
                crew_date: '',
                crew_score: null,
                crew_re_use: '',
                options: ['Recommendation', 'Re-use', 'Improvement', 'Impossible'],
                crew_rate: '',
                crew_detail: '',
                crew_evaluation_id: null,

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
                        label: 'Date',
						name: 'date',
                    },
                    {
                        label: 'Scoe',
						name: 'score',

						
                    },
                      {
                        label: 'Re-use',
						name: 're_use',
                    },
                      {
                        label: 'Rate',
						name: 'rate',
					},
					 {
                        label: 'Detail',
						name: 'detail',
                    },
                    
                    {
						label: 'Action',
                    }
                ]
            }
        },
        created() {
            const date = new Date();
            this.crew_date = moment(date).format('DD-MM-YYYY');
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
            this.$modal.show('crew_evaluate_modal');
                },

            hideModal() {
                    this.$modal.hide('crew_evaluate_modal');
                    this.clearForm();
                    },

            saveCrewEvaluate() {

                axios.post('/api/save-crew-evaluation', {
                    'employer_id': this.employerId,
                    'date': this.crew_date,
                    'score': this.crew_score,
                    're_use': this.crew_re_use,
                    'rate': this.crew_rate,
                    'detail': this.crew_detail,
                    'evaluation_id': this.crew_evaluation_id
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                this.hideModal();
                $(document).find('span[class="validate-message"]').remove();
                this.getData();
                this.crew_evaluation_id = null;
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
                this.crew_date = moment(new Date()).format('DD-MM-YYYY');
                this.crew_score = '',
                this.crew_re_use = '',
                this.crew_rate = '',
                this.crew_detail = ''
            },
            getData() {
                    axios.post('/api/get-all-crew-evaluation', {
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
                    this.crew_date = moment(item.date).format('DD-MM-YYYY');
                    this.crew_score = item.score;
                    this.crew_re_use = item.re_use;
                    this.crew_rate = item.rate;
                    this.crew_detail = item.detail;
                    this.employerId = item.user_id;
                    this.crew_evaluation_id = item.id;
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
                        axios.post('/api/delete-crew-evaluation', {
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
