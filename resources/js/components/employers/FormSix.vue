<!--=========================== Other Company Information ============================-->
<template>
    <div>
        <!-- Button trigger cmodal -->
        <button class="btn btn-primary" @click="showModal">Add Family Member</button>
        <!-- CModal -->
        <!-- =============================== -->
        <c-modal :style="{visibility: cvisibility, zIndex: czindex}">
            <div class="cmodal-content" :style="{transform: cstyle, opacity: copacity}">
                <div class="cmodal-header">Add Family Member</div>
                <div class="cmodal-body">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="">Rank</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">GRT</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="">KW</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="typo__label" for="">Company</label>
                            <multiselect v-model="company" :max-height="200" :options="companies" placeholder="Select one" label="name" track-by="name" ></multiselect>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="typo__label" for="">Ship Name</label>
                            <multiselect v-model="ship" :max-height="200" :options="ships" placeholder="Select one" label="name" track-by="name" ></multiselect>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="typo__label" for="">Ship Name</label>
                            <multiselect v-model="shiptype" :max-height="200" :options="shiptypes" placeholder="Select one" label="name" track-by="name" ></multiselect>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Boarding Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Leaving Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Area</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Remark</label>
                        <textarea name="" id="" cols="30" rows="8" class="form-control"></textarea>
                    </div>

                </div>
                <div class="cmodal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success">Add</button>
                </div>
            </div>
        </c-modal>
    </div>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Multiselect from 'vue-multiselect'
export default {
    components: {
        Multiselect
    },
    data() {
        return {
            //Modal
            czindex: -100,
            copacity: 0,
            cvisibility: 'hidden',
            cstyle:  'translateY(-100%)',
            company: { name: 'AKL', language: 'JavaScript' },
            companies: [
                { name: 'Mycareers', language: 'JavaScript' },
                { name: 'AKL', language: 'Ruby' },
                { name: 'ITVISIONHUB', language: 'Ruby' },
                { name: 'Laravel', language: 'PHP' },
                { name: 'Laravel', language: 'PHP' },
                { name: 'Laravel', language: 'PHP' },
                { name: 'Phoenix', language: 'Elixir' }
            ],

            ship: { name: 'Titanic', language: 'english'},
            ships: [
                { name: 'Titanic', language: 'english'}
            ],

            shiptype: { name: 'motor', language: 'english'},
            shiptypes: [
                { name: 'hello', language: 'lsls'}
            ]
        }
    },
    methods: {
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
    }
}
</script>

<style scoped>

</style>
