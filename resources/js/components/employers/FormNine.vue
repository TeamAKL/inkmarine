<!-- ==================== Crew Evaluation =============== -->
<template>
    <div>
        <div class="form-group">
            <label for="date">Date</label>
            <date-picker v-model.trim="date" valueType="format" class="date-picker" format="DD-MM-YYYY" ></date-picker>
        </div>

        <div class="form-group">
            <label for="score">Score</label>
            <input type="number" name="score" id="score" v-model="score" class="form-control">
        </div>

        <div class="form-group">
            <label for="re_use">Re Use</label>
            <multiselect v-model="re_use" :options="options" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="---- Select Re Use -----"></multiselect>
        </div>

        <div class="form-group">
            <label for="rate">Rate</label>
            <input type="text" name="rate" id="rate" v-model="rate" class="form-control">
        </div>

        <div class="form-group">
            <label for="detail">Detail</label>
            <textarea name="detail" id="detail" cols="30" rows="10" v-model.trim="detail" class="form-control"></textarea>
        </div>
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
                date: '',
                score: null,
                re_use: '',
                options: ['Recommendation', 'Re-use', 'Improvement', 'Impossible'],
                rate: '',
                detail: '',
                evaluation_id: null,
            }
        },
        created() {
            const date = new Date();
            this.date = moment(date).format('DD-MM-YYYY');
        },
        methods: {
            async validate() {
                var isValid;
                await axios.post('/api/save-crew-evoluation', {
                    'date': this.date,
                    'score': this.score,
                    're_use': this.re_use,
                    'rate': this.rate,
                    'detail': this.detail,
                    'employer_id': this.employerId,
                    'evaluation_id': this.evaluation_id,
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.evaluation_id = result.data.evaluation.id;
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
        },
        props: ['employerId']
    }
</script>
