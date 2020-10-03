<template>
    <div>
        <h1 class="text-center">Employeer Registeration</h1>
        <form-wizard shape="circle" color="#20a0ff">
            <!-- <tab-content title="Personal details" icon="ti-user" :before-change="()=>validateStep('form-one')">
                <form-one ref="form-one" @on-validate="mergePartialModels"></form-one>
            </tab-content> -->

            <!-- <tab-content title="Additional Info" icon="ti-settings" :before-change="()=>validateStep('form-two')">
                <form-two ref="form-two" :employerId="employerId"></form-two>
            </tab-content> -->

            <!-- <tab-content title="Family Member" icon="ti-id-badge" :before-change="()=>validateStep('form-four')">
                <form-four ref="form-four" :employerId="employerId"></form-four>
            </tab-content> -->

            <!-- <tab-content title="Certificate" icon="ti-files" :before-change="()=>validateStep('form-three')">
                <form-three ref="form-three"  :employerId="employerId"></form-three>
            </tab-content>

            <tab-content title="Medical Checkup" icon="ti-clipboard" :before-change="()=>validateStep('form-five')">
                <form-five ref="form-five" ></form-five>
            </tab-content> -->

            <tab-content title="Other Company Careers" icon="ti-briefcase" :before-change="()=>validateStep('form-six')">
                <form-six ref="form-six" @on-validate="mergePartialModels" :employerId="employerId"></form-six>
            </tab-content>

            <tab-content title="Last step" icon="ti-check">
                Here is your final model:
            <pre>{{finalModel}}</pre>
            </tab-content>
        </form-wizard>
    </div>
</template>

<script>
import ThemifyIcon from "vue-themify-icons";
import FormOne from './FormOneComponent'
import FormTwo from './FormTwoComponent'
import FormThree from './FormThreeComponent'
import FormFour from './FormFour'
import FormFive from './FormFive'
import FormSix from './FormSix'

export default {
    components: {
        ThemifyIcon,
        "form-one": FormOne,
        "form-two": FormTwo,
        "form-three": FormThree,
        "form-four": FormFour,
        "form-five": FormFive,
        "form-six": FormSix
    },
    data() {
        return {
            employerId: 1,
            finalModel: {},
        }
    },
    methods: {
        validateStep(name) {
            var refToValidate = this.$refs[name];
            return refToValidate.validate();
        },
        mergePartialModels(isValid){
            console.log(isValid);
            if(isValid){
                this.employerId = isValid;
            }
        },
    },

}
</script>

<style>
.wizard-header {
    display: none;
}

</style>
