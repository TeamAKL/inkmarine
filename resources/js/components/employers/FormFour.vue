<!--=================== Family Member Vue ==================================-->
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
                    <form>
                        <input type="text" v-model="employerId">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="relation">Relationship</label>
                            <input id="relation" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input id="phone_number" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <input id="dob" type="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="" id="remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="cmodal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideModal">Cancel</button>
                    <button class="btn btn-success">Add</button>
                </div>
            </div>
        </c-modal>
    </div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
 export  default {
    data() {
        return {
            //Modal
            czindex: -100,
            copacity: 0,
            cvisibility: 'hidden',
            cstyle:  'translateY(-100%)',
        }
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
    },
    props: ['employerId']
 }
</script>
