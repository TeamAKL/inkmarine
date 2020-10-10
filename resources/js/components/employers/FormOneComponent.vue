<template>
    <div>
        <form action="">
            <div class="form-group">
                <label for="crewcode">Crew Code</label>
                <input type="text" id="crewcode" name="crewcode" v-model.trim="crewcode" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" v-model.trim="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" id="nationality" name="nationality" v-model.trim="nationality" class="form-control">
            </div>

            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="date" id="dob" name="dob" v-model.trim="dob" class="form-control">
            </div>

            <div class="form-group">
                <label for="pob">Place Of Birth</label>
                <input type="text" id="pob" name="pob" v-model.trim="pob" class="form-control">
            </div>

            <div class="form-group">
                <label for="edulevel">Education Level</label>
                <input type="text" id="edulevel" name="edulevel" v-model.trim="edulevel" class="form-control">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user_token: `${process.env.MIX_APP_TOKEN}`,
            crewcode: '',
            name: '',
            nationality: '',
            dob: '',
            pob: '',
            edulevel: ''
        }
    },
    methods: {
        validate() {
            var response = axios.post('/api/save-form-one', {
                'crewcode': this.crewcode,
                'name': this.name,
                'nationality': this.nationality,
                'dob': this.dob,
                'pob': this.pob,
                'edulevel': this.edulevel
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then((result) => {
                    return true;
            }).catch((err) => {
                if (err.response.status == 400) {
                    $.each(err.response.data.error, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
                // return false;
                return true;
            })

            this.$emit('on-validate', this.$data, response)
            return response;
        }
    }
}
</script>
