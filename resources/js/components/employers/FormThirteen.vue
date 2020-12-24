<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="content">Content</label>
                <input type="text" id="content" name="content" v-model.trim="content" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="successor">Successor</label>
                <input type="text" id="successor" name="successor" v-model.trim="successor" class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="disembarkation_remark">Remark</label>
                <textarea name="remark" id="disembarkation_remark" cols="30" rows="10" v-model.trim="disembarkation_remark" class="form-control"></textarea>
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
    data() {
        return {
            user_token: `${process.env.MIX_APP_TOKEN}`,
            content: '',
            successor: '',
            disembarkation_remark: '',
            apply_disembarkation_id: ''
        }
    },
    methods: {
        async validate() {
            var isValid;
            await axios.post('/api/save-apply-disembarkation', {
                'contents': this.content,
                'successor': this.successor,
                'disembarkation_remark': this.disembarkation_remark,
                'apply_disembarkation_id': this.apply_disembarkation_id,
                'user_id':this.employerId,
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then((result) => {
                this.apply_disembarkation_id = result.data.apply.id;
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
        }
    },
    props: ['employerId']
}
</script>
