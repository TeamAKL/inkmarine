<template>

	<div>
		<div id="accordion">
			<div class="card">
				<div class="card-header" id="headingOne" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Person Detail
					</h5>
				</div>

				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<table class="table table-hover" v-else>
							<tbody>
								<tr>
									<td class="wd-70">Crew_Code:</td>
									<td>{{person_detail.crew_code}}</td>
								</tr>
								<tr>
									<td class="wd-70">Name:</td>
									<td>{{person_detail.name}}</td>
								</tr>
								<tr>
									<td class="wd-70">Nationality:</td>
									<td>{{person_detail.nationality}}</td>
								</tr>
								<tr>
									<td class="wd-70">Date Of Birth:</td>
									<td>{{dob}}</td>
								</tr>
								<tr>
									<td class="wd-70">Place Of Birth:</td>
									<td>{{person_detail.place_of_birth}}</td>
								</tr>
								<tr>
									<td class="wd-70">Education Level:</td>
									<td>{{person_detail.education_level}}</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingTwo">
					<h5 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" @click="familyMember">
						Family Member
					</h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
					<div class="card-body">
						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<table class="table table-hover" v-else>
							<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">Relationship</th>
									<th scope="col">Phone Number</th>
									<th scope="col">Date Of Birth</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr :key="members.id" v-for="members in family_members">
									<td>{{members.name}}</td>
									<td>{{members.relationship}}</td>
									<td>{{members.phone_number}}</td>
									<td>{{members.date_of_birth}}</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editFamilyMember(members)">Edit</a>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteFamilyMember(members)">Delete</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="certificate">
					<h5 class="mb-0" data-toggle="collapse" data-target="#certificate_card" aria-expanded="false" aria-controls="certificate_card" @click="certificate">
						Certificate
					</h5>
				</div>
				<div id="certificate_card" class="collapse" aria-labelledby="certificate" data-parent="#accordion">
					<div class="card-body">
						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<table class="table table-hover" v-else>
							<thead>
								<tr>
									<th scope="col">Name</th>
									<th scope="col">License Number</th>
									<th scope="col">Training Date</th>
									<th scope="col">Expire Date</th>
									<th>Image</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr :key="certificate.id" v-for="certificate in certificates">
									<td>{{certificate.name}}</td>
									<td>{{certificate.licine_number}}</td>
									<td>{{certificate.training_date}}</td>
									<td>{{certificate.expire_date}}</td>
									<td>
										<img :src="certificate.image" alt="Certificate Image" class="certificate-image"> 
									</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editCertificate(certificate)">Edit</a>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteCertificate(certificate)">Delete</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingmedicalcheck">
					<h5 class="mb-0" data-toggle="collapse" data-target="#medicalcheckup" aria-expanded="false" aria-controls="medicalcheckup" @click="medicalC">
						Medical Checkup
					</h5>
				</div>
				<div id="medicalcheckup" class="collapse" aria-labelledby="headingmedicalcheck" data-parent="#accordion">
					<div class="card-body">
						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<div v-else>
							<table class="table table-hover">
								<tbody>
									<tr>
										<th>Date:</th>
										<td>{{medicalcheckup.med_date}}</td>
										<th>Height:</th>
										<td>{{medicalcheckup.height}}</td>
										<th>Weight:</th>
										<td>{{medicalcheckup.weight}}</td>
									</tr>
									<tr>
										<th>Checst:</th>
										<td>{{medicalcheckup.checst}}</td>
										<th>Tooth:</th>
										<td>{{medicalcheckup.tooth}}</td>
										<th>Tooth State:</th>
										<td>{{medicalcheckup.tooth_state}}</td>
									</tr>
									<tr>
										<th>Color Blindness:</th>
										<td>{{medicalcheckup.color_blindness}}</td>
										<th>Blood Type:</th>
										<td>{{medicalcheckup.blood_type}}</td>
										<th>XRay:</th>
										<td>{{medicalcheckup.xray}}</td>
									</tr>
									<tr>
										<th>Hospital: </th>
										<td>{{medicalcheckup.hospital}}</td>
										<th>Decision:</th>
										<td>{{medicalcheckup.decision}}</td>
										<th>Sight (Left):</th>
										<td>{{medicalcheckup.sight_left}}</td>
									</tr>
									<tr>
										<th>Hearing (Left)</th>
										<td>{{medicalcheckup.hearing_left}}</td>
										<th>Hearing (Right)</th>
										<td>{{medicalcheckup.hearing_right}}</td>
										<th>Sight (Right):</th>
										<td>{{medicalcheckup.sight_right}}</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<div class="image-show-area">
								<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" v-for="image in medical_images">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingotherCompany" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#otherCompany" aria-expanded="true" aria-controls="otherCompany" @click="otherCompanyCareer">
						Other Company Careers
					</h5>
				</div>

				<div id="otherCompany" class="collapse" aria-labelledby="headingotherCompany" data-parent="#accordion">
					<div class="card-body">

						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<table class="table table-hover" v-else>
							<thead>
								<tr>
									<th>Rank</th>
									<th>Company Name</th>
									<th>Ship Name</th>
									<th>Area</th>
									<th>Boarding Date</th>
									<th>Leaving Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr :key="other_comapny.id" v-for="other_comapny in othercompanies">
									<td>{{other_comapny.rank}}</td>
									<td>{{other_comapny.company_name}}</td>
									<td>{{other_comapny.ship_name}}</td>
									<td>{{other_comapny.area}}</td>
									<td>{{other_comapny.boarding_date}}</td>
									<td>{{other_comapny.leaving_date}}</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editOtherCompany(other_company)">Edit</a>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteOtherCompany(other_company)">Delete</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingseman" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#seaman" aria-expanded="true" aria-controls="seaman" @click="seamanBook">
						Seaman Book
					</h5>
				</div>

				<div id="seaman" class="collapse" aria-labelledby="headingseman" data-parent="#accordion">
					<div class="card-body">

						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<div v-else>
							<table class="table table-hover">
								<tbody>
									<tr>
										<th class="wd-70">SeaMan Book:</th>
										<td>{{seamanbook.cbn}}</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<div class="image-show-area">
								<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" v-for="image in seamanImages">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingpassport" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#passport" aria-expanded="true" aria-controls="passport" @click="getPassport">
						Passport
					</h5>
				</div>

				<div id="passport" class="collapse" aria-labelledby="headingpassport" data-parent="#accordion">
					<div class="card-body">

						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<div v-else>
							<table class="table table-hover">
								<tbody>
									<tr>
										<th class="wd-70">Passport Number:</th>
										<td>{{passports.passport_no}}</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<div class="image-show-area">
								<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" v-for="image in passport_images">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingallinone" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#allinone" aria-expanded="true" aria-controls="allinone" @click="getAllinone">
						Allinone
					</h5>
				</div>

				<div id="allinone" class="collapse" aria-labelledby="headingallinone" data-parent="#accordion">
					<div class="card-body">

						<div class="d-flex justify-content-center" v-if="loading">
							<img src="../../../public/loading/dataload.gif">
						</div>
						<div v-else>
							<table class="table table-hover">
								<tbody>
									<tr>
										<th class="wd-70">C.O.C:</th>
										<td>{{allinone.coc}}</td>
									</tr>
									<tr>
										<th class="wd-70">GMBSS:</th>
										<td>{{allinone.gmbss}}</td>
									</tr>
								</tbody>
							</table>
							<hr>
							<div class="image-show-area">
								<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" v-for="image in allinone_images">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--Family member Modal -->
		<modal name="family_member" :clickToClose="false" height="auto" class="family_member_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Family Member</h5>
					<button type="button" class="close" @click="hide" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form >
						<div class="form-group row">
							<label for="fam_name" class="col-sm-4 col-form-label">Name :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="fam_name" name="fam_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="relationship" class="col-sm-4 col-form-label">Relationship :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="relationship" name="relationship">
							</div>
						</div>
						<div class="form-group row">
							<label for="fam_phone_no" class="col-sm-4 col-form-label">Phone no :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="fam_phone_no" name="fam_phone_no">
							</div>
						</div>
						<div class="form-group row">
							<label for="fam_date_birth" class="col-sm-4 col-form-label">Date Of Birth :</label>
							<div class="col-sm-8">
                            <date-picker v-model="fam_date_birth" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="hide" >Close</button>
					<button type="button" class="btn btn-success" id="create-certificate" @click="hide" >Save</button>
				</div>
			</div>

		</modal>
		<!--Certificates Modal -->
		<modal name="certificate" :clickToClose="false" height="auto" class="certificate_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Certificate</h5>
					<button type="button" class="close" @click="hide" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form >
						<div class="form-group row">
							<label for="certificate_name" class="col-sm-4 col-form-label">Certificate Name :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="certificate_name" name="certificate_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="license_no" class="col-sm-4 col-form-label">License Number :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="license_no" name="license_no">
							</div>
						</div>
						<div class="form-group row">
							<label for="training_date" class="col-sm-4 col-form-label">Training Date :</label>
							<div class="col-sm-8">
                            <date-picker v-model="training_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
						</div>
						<div class="form-group row">
							<label for="expired_date" class="col-sm-4 col-form-label">Expired Date :</label>
							<div class="col-sm-8">
                            <date-picker v-model="expired_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
						</div>
						<div class="form-group row">
							<div class="custom-file col-sm-4">
								<p>Choose Image</p>
								<input type="file" class="custom-file-input" id="customFile" @change="fileChange" >
								<label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>
								
							</div>
							<div class="loading-container col-sm-8" v-show="showLoading">
									<!-- <img src="../../../../public/loading/small_loading.gif" alt="ll" > -->
							</div>
							<div class="image-container col-sm-8" v-if="certificateImage" @click="viewImage(certificateImage)">
								<img :src="certificateImage" alt="img" class="img-thumbnail">
								<div class="image-overlay">
									<i class="wizard-icon ti-eye eye-icon"></i>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="hide" >Close</button>
					<button type="button" class="btn btn-success" id="create-certificate" @click="hide" >Save</button>
				</div>
			</div>

		</modal>
		<!--Other company career Modal -->
		<modal name="other_company" :clickToClose="false" height="auto" class="company_career_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Other Company Career</h5>
					<button type="button" class="close" @click="hide" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group row">
							<label for="other_rank" class="col-sm-4 col-form-label">Rank :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="other_rank" name="other_rank">
							</div>
						</div>
						<div class="form-group row">
							<label for="other_company_name" class="col-sm-4 col-form-label">Company Name :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="company_name" name="company_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="other_ship_name" class="col-sm-4 col-form-label">Ship Name :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="ship_name" name="ship_name">
							</div>
						</div>
						<div class="form-group row">
							<label for="other_area" class="col-sm-4 col-form-label">Area :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="other_area" name="other_area">
							</div>
						</div>
						<div class="form-group row">
							<label for="other_boarding_date" class="col-sm-4 col-form-label">Boarding Date :</label>
							<div class="col-sm-8">
                            <date-picker v-model="other_boarding_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
						</div>
						<div class="form-group row">
							<label for="other_leaving_date" class="col-sm-4 col-form-label">Leaving Date :</label>
							<div class="col-sm-8">
                            <date-picker v-model="other_leaving_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="hide" >Close</button>
					<button type="button" class="btn btn-success" id="create-certificate" @click="hide" >Save</button>
				</div>
			</div>

		</modal>
		
	</div>

</template>

<style lang="scss" scoped>
// .family_member_modal,.certificate_modal,.company_career_modal {
//     overflow: auto !important;
// }
// .date-picker{
// 	position:relative;
// }
.certificate-image {
	width: 166px;
	height: 64px;
}
.card-header {
	h5 {
		cursor: pointer;
	}
}
.wd-70 {
	width: 70%;
}
.image-show-area {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(180px, 200px));
	grid-template-rows: repeat(auto-fit, minmax(180px, 200px));
	grid-auto-rows: 200px;
	grid-gap: 10px;
	img {
		height: 100% !important;
	}
}
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

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>


<script>
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'
    import Multiselect from 'vue-multiselect'
	import DatePicker from 'vue2-datepicker';
	import 'vue2-datepicker/index.css';
	import moment from 'moment'

	export  default{
		components: {
		DatePicker,
		Multiselect,
        },
		data() {
			return {
				loading: true,
				id: '',
				user_token: `${process.env.MIX_APP_TOKEN}`,
				person_detail: {},
				dob: '',
				family_members: {},
				certificates: {},
				medicalcheckup: {},
				medical_images: {},
				othercompanies: {},
				seamanbook: {},
				seamanImages: {},
				passports: {},
				passport_images: {},
				allinone: {},
				allinone_images: {},

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
			var route = window.location.pathname;
			var arr = route.split('/');
			this.id = arr[2];
			this.personDetail();

			const date = new Date();
			this.fam_date_birth = moment(date).format('DD-MM-YYYY');
			this.training_date = moment(date).format('DD-MM-YYYY');
			this.expired_date = moment(date).format('DD-MM-YYYY');
			this.other_boarding_date = moment(date).format('DD-MM-YYYY');
			this.other_leaving_date = moment(date).format('DD-MM-YYYY');
			this.getData();
		},
		methods: {
			personDetail(evn) {
				this.loading = true;
				axios.post('/api/get-person-detail', {
					id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.person_detail = result.data.person_detail;
					this.dob = moment(this.person_detail.date_of_birth).format('DD-MM-YYYY');
				});
			},

			familyMember(evn) {
				this.loading = true;
				axios.post('/api/get-familymember', {
					user_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.family_members = result.data.family_members;
				});
			},

			editFamilyMember(member) {
				console.log(member);
				this.$modal.show('family_member');
			},

			hide() {
				this.$modal.hide('family_member');
				this.$modal.hide('certificate');
				this.$modal.hide('other_company');

			},

			certificate(evn) {
				this.loading = true;
				axios.post('/api/get-employer-certificate', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.certificates = result.data.certificates;
				});
			},
			editCertificate(certificate) {
				console.log(certificate);
				this.$modal.show('certificate');
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

			medicalC() {
				this.loading = true;
				axios.post('/api/get-meidicalcheckup', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.medicalcheckup = result.data.medicalcheckup;
					this.medical_images = JSON.parse(result.data.medicalcheckup.images);
				});
			},

			otherCompanyCareer() {
				this.loading = true;
				axios.post('/api/get-other-company', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.othercompanies = result.data.othercompanies;
				});
			},
			editOtherCompany(other_company) {
				console.log(other_company);
				this.$modal.show('other_company');
			},

			seamanBook() {
				this.loading = true;
				axios.post('/api/get-seaman-book', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.seamanbook = result.data.seamanbook;
					this.seamanImages = JSON.parse(result.data.seamanbook.images);
				});
			},

			getPassport() {
				this.loading = true;
				axios.post('/api/get-passport', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.passports = result.data.passports;
					this.passport_images = JSON.parse(result.data.passports.images);
				});
			},

			getAllinone() {
				this.loading = true;
				axios.post('/api/get-allinone', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.allinone = result.data.allinone;
					this.allinone_images = JSON.parse(result.data.allinone.images);
				});
			}
		}
	}
</script>
