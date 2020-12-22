<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="crewcode">Crew Code</label>
                <input type="text" id="crewcode" name="crewcode" v-model.trim="crewcode" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" v-model.trim="name" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="nationality">Nationality</label>
                <input type="text" id="nationality" name="nationality" v-model.trim="nationality" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="dob">Date Of Birth</label>
                <date-picker v-model.trim="dob" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>

            <div class="form-group col-md-12">
                <label for="pob">Place Of Birth</label>
                <input type="text" id="pob" name="pob" v-model.trim="pob" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="edulevel">Education Level</label>
                <input type="text" id="edulevel" name="edulevel" v-model.trim="edulevel" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="ship">Ship</label>
                <input type="text" id="ship" name="ship" v-model.trim="ship" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <p>Choose Image</p>
                <div class="custom-file col-md-12">
                    <input type="file" class="custom-file-input" id="customFile" @change="fileChange" >
                    <label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>
                    <div class="loading-container" v-show="showLoading">
                        <img src="../../../../public/loading/small_loading.gif" alt="ll" >
                    </div>
                    <div class="image-container" v-if="image" @click="viewImage(image)">
                        <img :src="image" alt="img" class="img-thumbnail">
                        <div class="image-overlay">
                            <i class="wizard-icon ti-eye eye-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.image-container {
    cursor: pointer;
    width: 200px;
    height: 200px;
    position: relative;
}

.image-container > img{
    width: 100%;
    height: 100%;
}

.image-container:hover .image-overlay {
    visibility: visible;
}

.image-overlay .eye-icon {
    position: absolute;
    top: 50%;
    right: 50%;
    color: #143c0b;
}

.image-overlay {
    visibility: hidden;
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: #a9a4a475;
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
    export default {
        components: {
            DatePicker
        },
        data() {
            return {
                user_token: `${process.env.MIX_APP_TOKEN}`,
                crewcode: '',
                name: '',
                nationality: '',
                dob: '',
                pob: '',
                edulevel: '',
                ship: '',
                result: '',
                personId: '',
                image: '',
                showLoading: false,
                imglabel: 'Choose image...'
            }
        },
        created() {
            const date = new Date();
                this.dob = moment(date).format('DD-MM-YYYY');
            },
            methods: {
                async validate() {
                    var isValid;
                    await axios.post('/api/save-form-one', {
                        'crewcode': this.crewcode,
                        'name': this.name,
                        'nationality': this.nationality,
                        'dob': this.dob,
                        'pob': this.pob,
                        'edulevel': this.edulevel,
                        'ship': this.ship,
                        'personId': this.personId,
                        'image': this.image
                    }, {
                        headers: {'Authorization': 'Bearer '+ this.user_token}
                    }).then((result) => {
                        this.personId = result.data.employeer.id;
                        isValid = true;
                    }).catch((err) => {
                        if (err.response.status == 400) {
                            Toast.fire({
                                icon: 'error',
                                title: 'Please fill all required fields!'
                            });
                            $.each(err.response.data.error, function (i, error) {
                                var el = $(document).find('[name="'+i+'"]');
                                el.after($('<span style="color: red;">'+error[0]+'</span>'));
                            });
                        }
                        isValid = false;
                    });
                    this.$emit('on-validate', this.personId);
                    return isValid;
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
                            'folder': 'profile/'
                        }, {
                            headers: {'Authorization': 'Bearer '+ that.user_token}
                        }).then((res) => {
                            that.image = res.data.url;
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
            }
        }
    </script>
