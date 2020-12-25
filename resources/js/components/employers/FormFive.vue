<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Date</label>
                <date-picker v-model.trim="med_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
            </div>
            <div class="form-group col-md-4">
                <label for="">Height</label>
                <input type="text" class="form-control"  name="height" v-model.trim="height">
            </div>
            <div class="form-group col-md-4">
                <label for="">Weight</label>
                <input type="text" class="form-control" name="weight" v-model.trim="weight">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Checst</label>
                <input type="text" class="form-control" name="checst" v-model="checst">
            </div>

            <div class="form-group col-md-4">
                <label for="">Tooth</label>
                <input type="text" class="form-control" name="tooth" v-model="tooth">
            </div>

            <div class="form-group col-md-4">
                <label for="">Tooth State</label>
                <input type="text" class="form-control" name="tooth_state" v-model="tooth_state">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Color Blindness</label>
                <input type="text" class="form-control" name="color_blindness" v-model="color_blindness">
            </div>

            <div class="form-group col-md-4">
                <label for="">Blood Type</label>
                <input type="text" class="form-control" name="blood_type" v-model="blood_type">
            </div>

            <div class="form-group col-md-4">
                <label for="">Xray</label>
                <input type="text" class="form-control" name="xray" v-model="xray">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Sight ( Left )</label>
                <input type="text" class="form-control" name="sight_left" v-model="sight_left">
            </div>

            <div class="form-group col-md-6">
                <label for="">Sight ( Right )</label>
                <input type="text" class="form-control" name="sight_right" v-model="sight_right">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Hearing ( Left )</label>
                <input type="text" class="form-control" name="hearing_left" v-model="hearing_left">
            </div>

            <div class="form-group col-md-6">
                <label for="">Hearing ( Right )</label>
                <input type="text" class="form-control" name="hearing_right" v-model="hearing_right">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Hospital</label>
                <input type="text" class="form-control" name="hospital" v-model="hospital">
            </div>

            <div class="form-group col-md-6">
                <label for="">Decision</label>
                <input type="text" class="form-control" name="decision" v-model="decision">
            </div>
        </div>
    </div>
</template>
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
            showLoading: false,
            user_token: `${process.env.MIX_APP_TOKEN}`,
            fileMaxLenght: 23,
            fileLoopCount: 0,
            images: [],
            med_date: '',
            height: '',
            weight: '',
            checst: '',
            tooth: '',
            tooth_state: '',
            color_blindness: '',
            blood_type: '',
            xray: '',
            sight_left: '',
            sight_right: '',
            hearing_left: '',
            hearing_right: '',
            hospital: '',
            decision: '',
            medicalCheckupId: null
        }
    },
    created() {
        const date = new Date();
        this.med_date = moment(date).format('DD-MM-YYYY');
    },
    computed: {
        imageMedical: function() {
                var mimages = this.images;
                var array = [];
                var imagearray = [];
                var imagext = [];
                $.each(mimages, function(key, value) {
                    var object = {};
                    imagearray = value.split('/');
                    imagext = imagearray[5].split('.');
                    object = {
                        img: value,
                        ext: imagext[1]
                    }
                    array.push(object);
                });
                return array;
            }
    },
    methods: {
        async validate() {
            var isValid;
            await axios.post('/api/save-medical-checkup', {
                'employerId': this.employerId,
                'images': this.images,
                'med_date': this.med_date,
                'height': this.height,
                'weight': this.weight,
                'checst': this.checst,
                'tooth': this.tooth,
                'tooth_state': this.tooth_state,
                'color_blindness': this.color_blindness,
                'blood_type': this.blood_type,
                'xray': this.xray,
                'sight_right': this.sight_right,
                'sight_left': this.sight_left,
                'hearing_right': this.hearing_right,
                'hearing_left': this.hearing_left,
                'hospital': this.hospital,
                'decision': this.decision,
                'medicalCheckupId': this.medicalCheckupId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
                console.log(result.data);
                this.medicalCheckupId = result.data.mde.id;
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

        // uploadFile(e) {
        //     var files = e.target.files || e.dataTransfer.files;
        //     if (!files.length)
        //         return;
        //     this.createImage(files)
        // },

        // createImage(files) {
        //     var vm = this;
        //     for (var index = 0; index < files.length; index++) {
        //         if (!files[index].type.match('application/pdf') && !files[index].type.match('image.*')) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'Please only select Image!',
        //                 allowOutsideClick: false,
        //             })
        //             return;
        //         } else {
        //             if(vm.fileLoopCount < vm.fileMaxLenght) {
        //                 var reader = new FileReader();
        //                     reader.onload = function(event) {
        //                     const imageUrl = event.target.result;
        //                     vm.showLoading = true;
        //                     axios.post('/api/image-upload', {
        //                         'image': imageUrl,
        //                         'folder': 'medicalcheckup/'
        //                     }, {
        //                         headers: {'Authorization': 'Bearer '+ this.user_token}
        //                     }).then((res) => {
        //                         vm.showLoading = false;
        //                         vm.images.push(res.data.url);
        //                     });
        //                 }
        //                 reader.readAsDataURL(files[index]);
        //             } else {
        //                 return false;
        //             }
        //             vm.fileLoopCount++;
        //         }
        //     }
        // },

        // onDrop: function(e) {
        //     e.stopPropagation();
        //     e.preventDefault();
        //     var files = e.target.files || e.dataTransfer.files;
        //     this.createImage(files)
        // },

        // deleteImage(index) {
        //     axios.post('/api/image-delete', {
        //         'image': this.images[index],
        //     }).then(res => {
        //         this.images.splice(index, 1);
        //         this.fileLoopCount--;
        //     });
        // },

        // editImage(index, e) {
        //     var vm = this;
        //     var files = e.target.files || e.dataTransfer.files;
        //     var reader = new FileReader();
        //         reader.onload = function(event) {
        //         const imageUrl = event.target.result;
        //         vm.showLoading = true;
        //         axios.post('/api/image-upload-edit', {
        //             'image': imageUrl,
        //             'oldImage': vm.images[index],
        //             'folder': 'medicalcheckup/'
        //         }, {
        //             headers: {'Authorization': 'Bearer '+ this.user_token}
        //         }).then((res) => {
        //             vm.showLoading = false;
        //             vm.images.splice(index, 1, res.data.url);
        //         });
        //     }
        //     reader.readAsDataURL(files[0]);
        // },

        // pdfopen(pdf) {
        //     window.open(pdf);
        // }
    },

    props: ['employerId']
}
</script>

