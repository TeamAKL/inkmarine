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
                        placeholder="Search...">
                    </div>
                </div>
            </div>
            <tbody slot="body" slot-scope="{ data }">
                <tr
                :key="item.id"
                v-for="item in data">
                <td class="text-left">{{ item.certificate.title }}</td>
                <td class="text-left">{{ item.licine_number }}</td>
                <td class="text-left">{{ item.training_date }}</td>
                <td class="text-left">{{ item.expire_date }}</td>
                <td class="text-left">
                    <button :class="'btn btn-xs btn-primary'" @click="editCertificate(item)" title="Edit">
                        <span>
                            <i class="mdi mdi-grease-pencil" aria-hidden="true"></i>
                        </span>
                        &nbsp;
                        Edit
                    </button>
                    <button :class="'btn btn-xs btn-danger'" @click="deleteCertificate(item)" title="Delete">
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
<modal name="certificate_modal" :clickToClose="false" height="auto" class="certificate_modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Add Certificate</h5>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="employerId" v-model="employerId">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="typo__label" for="certificate">Certificate</label>
                        <multiselect v-model="value" :max-height="200" :options="options" placeholder="Select one" label="name" track-by="name" id="certificate" ></multiselect>
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
                        <input type="file" class="custom-file-input" id="customFile" @change="fileChange" >
                        <label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>
                        <div class="loading-container" v-show="showLoading">
                            <img src="../../../../public/loading/small_loading.gif" alt="ll" >
                        </div>
                        <div class="image-container" v-if="certificateImage" @click="viewImage(certificateImage)">
                            <img :src="certificateImage" alt="img" class="img-thumbnail">
                            <div class="image-overlay">
                                <i class="wizard-icon ti-eye eye-icon"></i>
<!-- <div class="footer-overlay">
<label style="cursor: pointer">
<input type="file" @change="editImage(index, $event)" class="d-none" accept="image/*, .pdf">
<i class="wizard-icon ti-pencil icon-holder edit"></i>
</label>
<i class="wizard-icon ti-trash icon-holder delete" @click="deleteImage(index)"></i>
</div> -->
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
<div class="modal-footer d-flex justify-content-end">
    <button class="btn btn-primary" @click="hideModal">Cancel</button>
    <button class="btn btn-success" @click="saveCertificate">Add</button>
</div>
</div>
</modal>
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
    .footer-overlay {
        background: #ece7e7;
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.certificate_modal {
    overflow: auto !important;
}
</style>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
    import Multiselect from 'vue-multiselect'
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
    export default {
        components: {
            Multiselect,
            DatePicker,
        },
        data () {
            return {
                url: '/api/get-all-user',
                user_token: `${process.env.MIX_APP_TOKEN}`,
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
                    label: 'Certificate',
                    name: 'cetificates.title',
                    orderable: true,
                },
                {
                    label: 'Licine Number',
                    name: 'employer_certificates.licine_number',
                    orderable: true,
                },
                {
                    label: 'Training Date',
                    name: 'employer_certificates.training_date',
                    orderable: true,
                },
                {
                    label: 'Expire Date',
                    name: 'employer_certificates.expire_date',
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
                value: { },
                options: [],
                licine_number: '',
                training_date: '',
                certificateImage: '',
                expire_date: '',
                remark: '',
                imglabel: 'Choose Image..',
                showLoading: false,
                employer_certificate_id: null,
            }
        },
        created() {
            this.getEmployeCertificate();
            const date = new Date();
            this.training_date = moment(date).format('DD-MM-YYYY');
            this.expire_date = moment(date).format('DD-MM-YYYY');
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
                this.getCertificate();
                this.$modal.show('certificate_modal');
            },

            hideModal() {
                this.$modal.hide('certificate_modal');
                this.clearForm();
            },

            getEmployeCertificate() {
                axios.post('/api/get-employer-certificate', {
                    ...this.tableProps,
                    'employer_id': this.employerId
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.users = result.data;
                });
            },

            reloadTable(tableProps){
                this.tableProps = tableProps;
                this.getEmployeCertificate(tableProps);
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
                    that.showLoading = true;
                    axios.post('/api/image-upload', {
                        'image': e.target.result,
                        'folder': 'certificates/'
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

            getCertificate() {
                axios.post('/api/get-certificate', {}, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.options = [];
                    result.data.certificates.forEach(certificate => {
                        const optionGroup = {
                            name: certificate.title,
                            id: certificate.id
                        }
                        this.options.push(optionGroup);
                    })
                }).catch(err => {

                });
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
                    'id': this.employer_certificate_id
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.getEmployeCertificate();
                    this.hideModal();
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


// Edit Certificate
editCertificate(certificate) {
    this.showModal();
    this.value = {id: certificate.certificate_id, name: certificate.certificate.title},
    this.licine_number = certificate.licine_number,
    this.training_date = certificate.training_date;
    this.expire_date = certificate.expire_date;
    this.certificateImage = certificate.image;
    this.remark = certificate.remark;
    this.employer_certificate_id = certificate.id;
},

// Delete Certificate
deleteCertificate(certificate) {
    const vm = this;
    return Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete " + certificate.certificate.title,
        icon: 'warning',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if(result.isConfirmed) {
            axios.post('/api/delete-certificate', {
                id: certificate.id,
                employer_id: this.employerId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(response => {
                vm.getEmployeCertificate();
            })
        }
    });
},

// Clear Form
clearForm() {
    this.value = {},
    this.licine_number = '',
    this.training_date = moment(new Date()).format('DD-MM-YYYY');
    this.expire_date = moment(new Date()).format('DD-MM-YYYY');
    this.certificateImage = '';
    this.remark = '';
    this.employer_certificate_id = null;
    $(document).find('span[class="validate-message"]').remove();
},
},

props: ['employerId']
}
</script>
