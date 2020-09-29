<!--========================= Certificate Vue ========================-->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" @click="showModal">Add Certificate</button>
        </div>

        <div class="container">
            <data-table
                :columns="columns"
                :data = "users"
                :per-page="perPage"
            >
                <div slot="filters" slot-scope="{ perPage }">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <select class="form-control" v-model="tableProps.length" @change="reloadTable">
                                <option :key="page" v-for="page in perPage">{{ page }}</option>
                            </select>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <input
                                @keyup="reloadTable"
                                class="form-control"
                                v-model="tableProps.search"
                                placeholder="Search Email or Name">
                        </div>
                    </div>
                </div>
                <tbody slot="body" slot-scope="{ data }">
                <tr
                    :key="item.id"
                    v-for="item in data">
                    <td class="text-left">{{ item.id }}</td>
                    <td class="text-left">{{ item.name }}</td>
                    <td class="text-left">{{ item.email }}</td>
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
            <c-modal :style="{visibility: cvisibility, zIndex: czindex}" >
                <div class="cmodal-content" :style="{transform: cstyle, opacity: copacity}">
                    <div class="cmodal-header">Add Certificate</div>
                    <div class="cmodal-body">
                        <form>
                            <input type="hidden" name="employerId" v-model="employerId">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="typo__label" for="certificate">Certificate</label>
                                    <multiselect v-model="value" :max-height="200" :options="options" placeholder="Select one" label="name" track-by="name" id="certificate"></multiselect>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="licine_number">Licine Number</label>
                                    <input type="text" class="form-control" name="licine_number" id="licine_number" v-model.trim="licine_number">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="training_date">Training Date</label>
                                    <date-picker v-model.trim="training_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="expire_date">Expire Date</label>
                                    <date-picker v-model.trim="expire_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="custom-file col-md-6">
                                    <p>Choose Image</p>
                                    <input type="file" class="custom-file-input" id="customFile" @change="fileChange">
                                    <label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>
                                    <div class="loading-container" v-show="showLoading">
                                        <img src="../../../../public/loading/small_loading.gif" alt="ll" >
                                    </div>
                                    <div class="image-container" v-if="certificateImage" @click="viewImage(certificateImage)">
                                        <img :src="certificateImage" alt="img" class="img-thumbnail">
                                        <div class="image-overlay">
                                            <i class="wizard-icon ti-eye eye-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="remark">Remark</label>
                                    <textarea name="remark" id="remark" cols="30" rows="10" v-model.trim="remark" class="form-control"></textarea>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="cmodal-footer d-flex justify-content-end">
                        <button class="btn btn-primary" @click="hideModal">Cancel</button>
                        <button class="btn btn-success" @click="saveCertificate">Add</button>
                    </div>
                </div>
            </c-modal>
        <!-- End CModal -->
        <!-- =============================== -->
    </div>
</template>

<style lang="scss" scoped>
    .eye-icon {
        color: #fff;
        position: absolute;
        top: 46%;
        left: 46%;
        font-size: 50px;
    }
    .image-container, .loading-container {
        width: 100%;
        height: 180px;
        border: 1px solid gray;
        position: relative;
        cursor: pointer;
    }

    .loading-container img {
        position: absolute;
        top: 43%;
        left: 40%;
    }

    .image-container img {
        width: 100%;
        height: 100%;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #000000bf;
        opacity: 0;
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }
</style>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'


import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment'
export default {
    components: {
        Multiselect,
        DatePicker,
    },
    data () {
        return {
            url: '/api/get-all-user',
            user_token: "eyJpdiI6IjlaSHRCM1d4V0ZDd3RoNXpNUnF4MUE9PSIsInZhbHVlIjoiUkRoQm1BdTV6ZFoxcEdkaTlqcU5uOUlrZDRKdDUza0RGVHoybXNjUDlXanVIV2NsdFVpenVWSmpaWDBIdGc0a09uc2k0Qzl4cEhWbUl3UjJaTmcyOTc2UTRWSmp0RVoxdTR5YXdCelwvNmRWbUM3Z0p4T25oRzVyUnFoWmRueFRLIiwibWFjIjoiN2VhZDdkYjYzMzk1YzU2NjVmZDM1ZDQ1NjM0MzA0YmE4ZmNlOWM3MTNkNWZhZDI5ZDgxOWQyNDM4YzJlYzQ5MSJ9",
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
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Name',
                    name: 'name',
                    orderable: true,
                },
                {
                    label: 'Email',
                    name: 'email',
                    orderable: true,
                },
                {
                    label: 'Action'
                }
            ],

            //Modal
            czindex: -100,
            copacity: 0,
            cvisibility: 'hidden',
            cstyle:  'translateY(-100%)',
            value: { name: 'Vue.js', id: 'JavaScript' },
            options: [
                { name: 'Vue.js', id: 'JavaScript' },
                { name: 'Rails', id: 'Ruby' },
                { name: 'Sinatra', id: 'Ruby' },
                { name: 'Laravel', id: 'PHP' },
                { name: 'Laravel', id: 'PHP' },
                { name: 'Laravel', id: 'PHP' },
                { name: 'Phoenix', id: 'Elixir' }
            ],
            licine_number: '',
            training_date: '',
            certificateImage: '',
            expire_date: '',
            remark: '',
            imglabel: 'Choose Image..',
            showLoading: false,
            certificatId: null,
        }
    },
    created() {
        this.getData(this.url);
        const date = new Date();
        this.training_date = moment(date).format('DD-MM-YYYY');
        this.expire_date = moment(date).format('DD-MM-YYYY');
    },
    methods: {
        validate() {
            // var isValid = true;
            // this.$emit('on-validate', this.$data, isValid)
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
            document.querySelector('body').style.overflow = 'hidden';
        },

        hideModal() {
            document.querySelector('body').style.overflow = 'auto';
            this.cstyle = 'translateY(-100%)';
            this.copacity = 0;
            let that = this;
            this.certificateImage = '';
            this.imglabel = 'Choose Image..';
            setTimeout(function(){ that.cvisibility = 'hidden'; that.czindex= -100;}, 500)
        },

        getData(url = this.url, options = this.tableProps) {
            axios.post(url, {
                ...options
            }, {
                headers:{'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
                this.users = result.data;
            });
        },

        reloadTable(){
            this.getData(this.url);
        },

        fileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) {
                return;
            }
            let label = $(document).find('[id="changeLabel"]');
            var reader = new FileReader();
            var that = this;
            reader.onload = (e) => {
                // that.certificateImage = e.target.result;
                that.showLoading = true;
                axios.post('/api/image-upload', {
                    'image': e.target.result
                }, {
                    headers: {'Authorization': 'Bearer '+ that.user_token}
                }).then((res) => {
                    that.certificateImage = res.data.url;
                    that.showLoading = false;
                });
            }
            reader.readAsDataURL(files[0]);
            this.imglabel = files[0].name;
        },

        viewImage(image) {
            var img = image;
            Swal.fire({
                imageUrl: img,
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                width: 80 + '%',
                imageWidth: null,
                imageHeight: null,
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false
            })
        },

        saveCertificate() {
            axios.post('/api/save-certificate', {
                'certificate_name': this.value.id,
                'licine_number': this.licine_number,
                'training_date': this.training_date,
                'expire_date': this.expire_date,
                'image': this.certificateImage,
                'remark': this.remark,
                'employer_id': this.employerId,
                'certificate_id': this.certificatId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
                console.log(result);
            }).catch(err => {

            })
        }
    },
    props: ['employerId']
}
</script>
