<template>

	<div>
		<div id="accordion">
			<div class="card">
				<div class="card-header bgColor" id="headingOne">
					<h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" @click="personDetail($event)">
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
						<div v-else>
							<div class="d-flex justify-content-end mb-3">
									<button type="button" class="btn btn-success" id="add-member" @click="showFamilyMember" >Add</button>
							</div>
							<table class="table table-hover">
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
						<div v-else>
							<div class="d-flex justify-content-end mb-3">
								<button class="btn btn-success" @click="addCertificate">Add</button>
							</div>
							
							<table class="table table-hover">
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
			</div>
			<div class="card">
				<div class="card-header" id="headingmedicalcheck">
					<h5 class="mb-0" data-toggle="collapse" data-target="#medicalcheckup" aria-expanded="false" aria-controls="medicalcheckup" @click="medicalC">
						Medical Checkup
					</h5>
				</div>
				<div id="medicalcheckup" class="collapse" aria-labelledby="headingmedicalcheck" data-parent="#accordion">
					<div class="card-body">
						<div v-show="medicalcheckup">
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
									<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" :key="image" v-for="image in medical_images">
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-success" @click="createMedicalCheckup(medical_checkup)">Create</button>
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
						<div v-show="seamanbook">
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
									<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" :key="image" v-for="image in seamanImages">
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-success" @click="createSeamanBook(seaman_book)">Create</button>
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
						<div v-show="passports">
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
									<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" :key="image" v-for="image in passport_images">
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-success" @click="createPassport(passport)">Create</button>
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
						<div v-show="allinone">
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
									<img :src="image" alt="medicalcheckupImage" class="img-thumbnail" :key="image" v-for="image in allinone_images">
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<button class="btn btn-success" @click="createAllInOne(allinone)">Create</button>
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
					<button type="button" class="close" @click="hideFamilyMember" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="member_name" name="member_name"  v-model.trim="member_name">
                        </div>

                        <div class="form-group">
                            <label for="relation">Relationship</label>
                            <input type="text" class="form-control" id="member_relation" name="member_relation" v-model.trim="member_relation" >
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="member_phone_number" name="member_phone_number" v-model.trim="member_phone_number" >
                        </div>

                        <div class="form-group">
                            <label for="dob">Date Of Birth</label>
                            <date-picker v-model="member_dob" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="member_remark" id="member_remark" v-model.trim="member_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="hideFamilyMember" >Close</button>
					<button type="button" class="btn btn-success" id="create-certificate" @click="saveFamilyMember" >Save</button>
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
						<div class="form-group">
							<label class="typo__label" for="certificate">Certificate</label>
							<multiselect v-model="value" :max-height="200" :options="options" placeholder="Select one" label="name" track-by="name" id="certificate" ></multiselect>
						</div>
						<div class="form-group">
							<label for="licine_number">License Number</label>
							<input type="text" class="form-control" name="licine_number" id="licine_number" v-model.trim="licine_number">
						</div>
						<div class="form-group">
							<label for="training_date">Training Date</label>
							<date-picker v-model.trim="training_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
						</div>
						<div class="form-group">
							<label for="expire_date">Expire Date</label>
							<date-picker v-model.trim="expire_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
						</div>
						<div class="form-group">
							<label for="remark">Remark</label>
							<textarea name="remark" id="remark" cols="30" rows="10" v-model.trim="remark" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<div class="custom-file">
								<p>Choose Image</p>
								<input type="file" class="custom-file-input" id="customFile" @change="fileChange" >
								<label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>

							</div>
							<div class="loading-container " v-show="showLoading">
								<img src="../../../public/loading/small_loading.gif" alt="ll" >
							</div>
							<div class="image-container " v-if="certificateImage" @click="viewImage(certificateImage)">
								<img :src="certificateImage" alt="img" class="img-thumbnail">
								<div class="image-overlay">
									<i class="wizard-icon ti-eye eye-icon"></i>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="hideCertificate" >Close</button>
					<button type="button" class="btn btn-success" id="create-certificate" @click="saveCertificate" >Save</button>
				</div>
			</div>

		</modal>
		<!-- medical checkup -->
		<modal name="medical_checkup" :clickToClose="false" height="auto" class="medical_checkup">
			<div class="modal-dialog modal-fluid">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Medical Checkup</h5>
						<button type="button" class="close" @click="hide" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="date">Date</label>
								<date-picker v-model.trim="med_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
							</div>
							<div class="form-group col-sm-6">
								<label for="">Height</label>
								<input type="text" class="form-control"  name="height" v-model.trim="height">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Chest</label>
								<input type="text" class="form-control" name="chest" v-model="checst">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Tooth</label>
								<input type="text" class="form-control" name="tooth" v-model="tooth">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Tooth State</label>
								<input type="text" class="form-control" name="tooth_state" v-model="tooth_state">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Color Blindness</label>
								<input type="text" class="form-control" name="color_blindness" v-model="color_blindness">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Blood Type</label>
								<input type="text" class="form-control" name="blood_type" v-model="blood_type">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Xray</label>
								<input type="text" class="form-control" name="xray" v-model="xray">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Sight ( Left )</label>
								<input type="text" class="form-control" name="sight_left" v-model="sight_left">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Sight ( Right )</label>
								<input type="text" class="form-control" name="sight_right" v-model="sight_right">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Hearing ( Left )</label>
								<input type="text" class="form-control" name="hearing_left" v-model="hearing_left">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Hearing ( Right )</label>
								<input type="text" class="form-control" name="hearing_right" v-model="hearing_right">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-sm-6">
								<label for="">Hospital</label>
								<input type="text" class="form-control" name="hospital" v-model="hospital">
							</div>
							<div class="form-group col-sm-6">
								<label for="">Decision</label>
								<input type="text" class="form-control" name="decision" v-model="decision">
							</div>
						</div>
						<div class="form-group">
							<div class="image-holder" v-show="images.length == 0">
								<div class="loading-area-one" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<label for="medical-checkup" class="medicalcheckup" @dragover.prevent @drop="onDrop">
									<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
									<span class="image-lable-text" v-show="!showLoading">Choose File Here</span>
								</label>
							</div>

							<div class="grid-container" @dragover.prevent @drop="onDrop" v-show="images.length >= 1">
								<div class="loading-area" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<div class="gird-item-image " :key="index" v-for="(image, index) in images">
									<img :src="image" alt="image" class="images-img img-thumbnail">
									<div class="image-overlay">
										<div class="ed-holder">
											<div class="edit-delete-area">
												<label style="cursor: pointer">
													<input type="file" @change="editImage(index, $event)" class="d-none" accept="image/*, .pdf">
													<i class="wizard-icon ti-pencil icon-holder edit"></i>
												</label>
												<i class="wizard-icon ti-trash icon-holder delete" @click="deleteImage(index)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gird-item-image final-grid" v-show="fileLoopCount < fileMaxLenght">
									<label for="medical-checkup" class="medicalcheckup" @dragover.prevent @drop="onDrop">
										<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
										<span class="image-lable-text">Choose File Here</span>
									</label>
								</div>
							</div>
						</div>
						<input type="file" multiple draggable="true" id="medical-checkup" @change="uploadFile" accept="image/*, .pdf">
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" @click="hide" >Close</button>
							<button type="button" class="btn btn-success" id="create_medical_checkup" @click="hide" >Save</button>
						</div>
						
					</div>
				</div>
			</div>
		</modal>
		<!-- seaman book -->
		<modal name="seaman_book" :clickToClose="false" height="auto" class="seaman_book">
			<div class="modal-dialog modal-fluid">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Seaman Book </h5>
						<button type="button" class="close" @click="hide" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
						<div class="form-group row">
							<label for="seaman" class="col-sm-4 col-form-label">Seanam Book No :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="seaman_no" name="seaman_no">
							</div>
						</div>
						<div class="form-group">
							<div class="image-holder" v-show="cbn_images.length == 0">
								<div class="loading-area-one" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<label for="ctc" class="medicalcheckup" @dragover.prevent @drop="onDropSeaman">
									<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
									<span class="image-lable-text" v-show="!showLoading">Choose File Here</span>
								</label>
							</div>

							<div class="grid-container" @dragover.prevent @drop="onDropSeaman" v-show="cbn_images.length >= 1">
								<div class="loading-area" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<div class="gird-item-image " :key="index" v-for="(image, index) in cbn_images">
									<img :src="image" alt="image" class="images-img img-thumbnail">
									<div class="image-overlay">
										<div class="ed-holder">
											<div class="edit-delete-area">
												<label style="cursor: pointer">
													<input type="file" @change="editImageSeaman(index, $event)" class="d-none" accept="image/*, .pdf">
													<i class="wizard-icon ti-pencil icon-holder edit"></i>
												</label>
												<i class="wizard-icon ti-trash icon-holder delete" @click="deleteImageSeaman(index)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gird-item-image final-grid" v-show="countfile < fileMaxLenght">
									<label for="ctc" class="medicalcheckup" @dragover.prevent @drop="onDropSeaman">
										<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
										<span class="image-lable-text">Choose File Here</span>
									</label>
								</div>
							</div>
						</div>
						<input type="file" multiple draggable="true" id="ctc" @change="uploadFileFormSeven" accept="image/*, .pdf">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="hide" >Close</button>
						<button type="button" class="btn btn-success" id="create-seamanbook" @click="hide" >Save</button>
					</div>
				</div>
			</div>
		</modal>
		<!-- passport -->
		<modal name="passport" :clickToClose="false" height="auto" class="passport">
			<div class="modal-dialog modal-fluid">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Passport </h5>
						<button type="button" class="close" @click="hide" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
						<div class="form-group row">
							<label for="passport" class="col-sm-4 col-form-label">Passport No :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="passport" name="passport">
							</div>
						</div>
						<div class="form-group">
							<div class="image-holder" v-show="passport_images.length == 0">
								<div class="loading-area-one" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<label for="ppt" class="medicalcheckup" @dragover.prevent @drop="onDropPassport">
									<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
									<span class="image-lable-text" v-show="!showLoading">Choose File Here</span>
								</label>
							</div>

							<div class="grid-container" @dragover.prevent @drop="onDropPassport" v-show="passport_images.length >= 1">
								<div class="loading-area" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<div class="gird-item-image " :key="index" v-for="(image, index) in passport_images">
									<img :src="image" alt="image" class="images-img img-thumbnail">
									<div class="image-overlay">
										<div class="ed-holder">
											<div class="edit-delete-area">
												<label style="cursor: pointer">
													<input type="file" @change="editPassportImage(index, $event)" class="d-none" accept="image/*, .pdf">
													<i class="wizard-icon ti-pencil icon-holder edit"></i>
												</label>
												<i class="wizard-icon ti-trash icon-holder delete" @click="deletePassportImage(index)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gird-item-image final-grid" v-show="fileLoopCount < fileMaxLenght">
									<label for="ppt" class="medicalcheckup" @dragover.prevent @drop="onDropPassport">
										<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
										<span class="image-lable-text">Choose File Here</span>
									</label>
								</div>
							</div>
						</div>
						<input type="file" multiple draggable="true" id="ppt" @change="uploadPassportFile" accept="image/*, .pdf">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="hide" >Close</button>
						<button type="button" class="btn btn-success" id="create-seamanbook" @click="hide" >Save</button>
					</div>
				</div>
			</div>
		</modal>
		<!-- all_in_one -->
		<modal name="all_in_one" :clickToClose="false" height="auto" class="all_in_one">
			<div class="modal-dialog modal-fluid">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">All In One </h5>
						<button type="button" class="close" @click="hide" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
						<div class="form-group row">
							<label for="coc" class="col-sm-4 col-form-label">C.O.C :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="coc" name="coc">
							</div>
						</div>
						<div class="form-group row">
							<label for="gmbss" class="col-sm-4 col-form-label">GMBSS :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="gmbss" name="gmbss">
							</div>
						</div>
						<div class="form-group">
							<div class="image-holder" v-show="all_images.length == 0">
								<div class="loading-area-one" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<label for="all-in-one" class="medicalcheckup" @dragover.prevent @drop="onDropAllInOne">
									<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
									<span class="image-lable-text" v-show="!showLoading">Choose File Here</span>
								</label>
							</div>

							<div class="grid-container" @dragover.prevent @drop="onDropAllInOne" v-show="all_images.length >= 1">
								<div class="loading-area" v-show="showLoading">
									<!-- <img src="../../../../public/loading/loading.gif" alt=""> -->
								</div>
								<div class="gird-item-image " :key="index" v-for="(image, index) in all_images">
									<img :src="image" alt="image" class="images-img img-thumbnail">
									<div class="image-overlay">
										<div class="ed-holder">
											<div class="edit-delete-area">
												<label style="cursor: pointer">
													<input type="file" @change="editAllInOneImage(index, $event)" class="d-none" accept="image/*, .pdf">
													<i class="wizard-icon ti-pencil icon-holder edit"></i>
												</label>
												<i class="wizard-icon ti-trash icon-holder delete" @click="deleteAllInOneImage(index)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gird-item-image final-grid" v-show="fileLoopCount < fileMaxLenght">
									<label for="all-in-one" class="medicalcheckup" @dragover.prevent @drop="onDropAllInOne">
										<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
										<span class="image-lable-text">Choose File Here</span>
									</label>
								</div>
							</div>
						</div>
						<input type="file" multiple draggable="true" id="all-in-one" @change="uploadAllInOneFile" accept="image/*, .pdf">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="hide" >Close</button>
						<button type="button" class="btn btn-success" id="create-seamanbook" @click="hide" >Save</button>
					</div>
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
.bgcolor {
	background: red;
}
.medical_checkup,.seaman_book,
.passport,.all_in_one, .certificate_modal
{
	overflow-y: auto;
}
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

.bgColor {
	background: #6574cd;
	color: #fff;
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

				//Modal Certificate
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

				//medicalcheckup_photo
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
				medicalCheckupId: null,
				//seaman book
				seaman_no: '',
				cbn_id: null,
				user_token: `${process.env.MIX_APP_TOKEN}`,
				cbn_images: [],
				showLoading: false,
				fileMaxLenght: 20,
				countfile: 0,
				//passport
				passport: '',
				passport_id: null,
				user_token: `${process.env.MIX_APP_TOKEN}`,
				passport_images: [],
				showLoading: false,
				fileMaxLenght: 27,
				fileLoopCount: 0,
				//allinone
				coc: '',
				gmbss: '',
				all_in_one_id: null,
				user_token: `${process.env.MIX_APP_TOKEN}`,
				all_images: [],
				showLoading: false,
				fileMaxLenght: 15,
				fileLoopCount: 0,
				//FamilyMember
				user_token: `${process.env.MIX_APP_TOKEN}`,
                member_name: '',
                member_relation: '',
                member_phone_number: '',
                member_dob: '',
                member_remark: '',
                family_member_id: null,
			}
		},
		created() {
			var route = window.location.pathname;
			var arr = route.split('/');
			this.id = arr[2];
			this.personDetail();

			const date = new Date();
			this.member_dob = moment(date).format('DD-MM-YYYY');
			this.training_date = moment(date).format('DD-MM-YYYY');
			this.expired_date = moment(date).format('DD-MM-YYYY');
			this.other_boarding_date = moment(date).format('DD-MM-YYYY');
			this.other_leaving_date = moment(date).format('DD-MM-YYYY');
			this.med_date = moment(date).format('DD-MM-YYYY');

		},
		methods: {
			personDetail() {
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

			familyMember() {
				//this.addClass(evn.target);
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

			certificate() {
				// this.addClass(evn.target);
				this.loading = true;
				axios.post('/api/get-employer-certificate-detail', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.loading = false;
					this.certificates = result.data.certificates;
				});
			},

			medicalC(evn) {
				this.addClass(evn.target);
				this.loading = true;
				axios.post('/api/get-meidicalcheckup', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					if(result.data.medicalcheckup != null) {
						this.loading = false;
						this.medicalcheckup = result.data.medicalcheckup;
						this.medical_images = JSON.parse(result.data.medicalcheckup.images);
					} else {
						this.medicalcheckup = false;
					}
				});
			},

			otherCompanyCareer(evn) {
				this.addClass(evn.target);
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

			seamanBook(evn) {
				this.addClass(evn.target);
				this.loading = true;
				axios.post('/api/get-seaman-book', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					if(result.data.seamanbook != null) {
						this.loading = false;
						this.seamanbook = result.data.seamanbook;
						this.seamanImages = JSON.parse(result.data.seamanbook.images);
					} else {
						this.seamanbook = false;
					}
				});
			},

			getPassport(evn) {
				this.addClass(evn.target);
				this.loading = true;
				axios.post('/api/get-passport', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					if(result.data.passports != null) {
						this.loading = false;
						this.passports = result.data.passports;
						this.passport_images = JSON.parse(result.data.passports.images);
					} else {
						this.passports = false;
					}
					
				});
			},

			getAllinone(evn) {
				this.addClass(evn.target);
				this.loading = true;
				axios.post('/api/get-allinone', {
					employer_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					if(result.data.allinone != null) {
						this.loading = false;
						this.allinone = result.data.allinone;
						this.allinone_images = JSON.parse(result.data.allinone.images);
					} else {
						this.allinone = false;
					}
					
				});
			},
            //Family Member
			editFamilyMember(item) {
				console.log(item.employerId);
			   this.showFamilyMember();
			   this.$modal.show('family_member');
			   this.member_name = item.name;
               this.member_relation = item.relationship;
               this.member_phone_number = item.phone_number;
               this.member_dob = moment(item.dob).format('DD-MM-YYYY');
               this.member_remark = item.remark;
               this.user_id = this.id;
               this.family_member_id = item.id;
			},
			saveFamilyMember(){
				axios.post('/api/save-family-member', {
                'member_name': this.member_name,
                'member_relation': this.member_relation,
                'member_phone_number': this.member_phone_number,
                'member_dob': this.member_dob,
                'member_remark': this.member_remark,
                'family_member_id': this.family_member_id,
                'user_id':this.id,
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {

               this.hideFamilyMember();
               $(document).find('span[class="validate-message"]').remove();
               this.familyMember();
               this.family_member_id = null;
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

			},
			hideFamilyMember(){

            this.member_name = '',
            this.member_relation = '',
            this.member_phone_number = '',
            this.member_dob = moment(new Date()).format('DD-MM-YYYY');
			this.member_remark = '',
			this.$modal.hide('family_member');
			},
			showFamilyMember() {
		    this.$modal.show('family_member');
            },
			createMedicalCheckup(medical_checkup) {
				console.log(medical_checkup);
				this.$modal.show('medical_checkup');
			},
			uploadFile(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createImage(files)
			},

			createImage(files) {
				var vm = this;
				for (var index = 0; index < files.length; index++) {
					if (!files[index].type.match('application/pdf') && !files[index].type.match('image.*')) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please only select Image!',
							allowOutsideClick: false,
						})
						return;
					} else {
						if(vm.fileLoopCount < vm.fileMaxLenght) {
							var reader = new FileReader();
							reader.onload = function(event) {
								const imageUrl = event.target.result;
								vm.showLoading = true;
								axios.post('/api/image-upload', {
									'image': imageUrl,
									'folder': 'medicalcheckup/'
								}, {
									headers: {'Authorization': 'Bearer '+ this.user_token}
								}).then((res) => {
									vm.showLoading = false;
									vm.images.push(res.data.url);
								});
							}
							reader.readAsDataURL(files[index]);
						} else {
							return false;
						}
						vm.fileLoopCount++;
					}
				}
			},

			onDrop: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createImage(files)
			},

			deleteImage(index) {
				axios.post('/api/image-delete', {
					'image': this.images[index],
				}).then(res => {
					this.images.splice(index, 1);
					this.fileLoopCount--;
				});
			},

			editImage(index, e) {
				var vm = this;
				var files = e.target.files || e.dataTransfer.files;
				var reader = new FileReader();
				reader.onload = function(event) {
					const imageUrl = event.target.result;
					vm.showLoading = true;
					axios.post('/api/image-upload-edit', {
						'image': imageUrl,
						'oldImage': vm.images[index],
						'folder': 'medicalcheckup/'
					}, {
						headers: {'Authorization': 'Bearer '+ this.user_token}
					}).then((res) => {
						vm.showLoading = false;
						vm.images.splice(index, 1, res.data.url);
					});
				}
				reader.readAsDataURL(files[0]);
			},


			hide() {
				this.$modal.hide('other_company');
				this.$modal.hide('medical_checkup');
				this.$modal.hide('seaman_book');
				this.$modal.hide('passport');
				this.$modal.hide('all_in_one');

			},

			editOtherCompany(other_company) {
				console.log(other_company);
				this.$modal.show('other_company');
			},
			createSeamanBook(seaman_book) {
				console.log(seaman_book);
				this.$modal.show('seaman_book');
			},
			uploadFileSeaman(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createImageFormSeven(files)
			},

			createImageSeaman(files) {
				var vm = this;
				for (var index = 0; index < files.length; index++) {
					if (!files[index].type.match('application/pdf') && !files[index].type.match('image.*')) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please only select Image!',
							allowOutsideClick: false,
						})
						return;
					} else {
						if(vm.countfile < vm.fileMaxLenght) {
							var reader = new FileReader();
							reader.onload = function(event) {
								const imageUrl = event.target.result;
								vm.showLoading = true;
								axios.post('/api/image-upload-form-seven', {
									'image': imageUrl,
									'folder': 'cemanbookno/'
								}, {
									headers: {'Authorization': 'Bearer '+ this.user_token}
								}).then((res) => {
									vm.showLoading = false;
									vm.cbn_images.push(res.data.url);
								});
							}
							reader.readAsDataURL(files[index]);
						} else {
							return false;
						}
						vm.countfile++;
					}
				}
			},

			onDropSeaman: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createImageSeaman(files)
			},

			deleteImageSeaman(index) {
				axios.post('/api/image-delete', {
					'image': this.cbn_images[index],
				}).then(res => {
					this.cbn_images.splice(index, 1);
					this.fileLoopCount--;
				});
			},

			editImageSeaman(index, e) {
				var vm = this;
				var files = e.target.files || e.dataTransfer.files;
				var reader = new FileReader();
				reader.onload = function(event) {
					const imageUrl = event.target.result;
					vm.showLoading = true;
					axios.post('/api/image-upload-edit', {
						'image': imageUrl,
						'oldImage': vm.cbn_images[index],
						'folder': 'cemanbookno/'
					}, {
						headers: {'Authorization': 'Bearer '+ this.user_token}
					}).then((res) => {
						vm.showLoading = false;
						vm.cbn_images.splice(index, 1, res.data.url);
					});
				}
				reader.readAsDataURL(files[0]);
			},
			createPassport(passport) {
				console.log(passport);
				this.$modal.show('passport');
			},
			uploadPassportFile(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createImages(files)
			},

			createImagesPassport(files) {
				var vm = this;
				for (var index = 0; index < files.length; index++) {
					if (!files[index].type.match('application/pdf') && !files[index].type.match('image.*')) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please only select Image!',
							allowOutsideClick: false,
						})
						return;
					} else {
						if(vm.fileLoopCount < vm.fileMaxLenght) {
							var reader = new FileReader();
							reader.onload = function(event) {
								const imageUrl = event.target.result;
								vm.showLoading = true;
								axios.post('/api/image-upload', {
									'image': imageUrl,
									'folder': 'passports/'
								}, {
									headers: {'Authorization': 'Bearer '+ this.user_token}
								}).then((res) => {
									console.log('helo');
									vm.showLoading = false;
									vm.passport_images.push(res.data.url);
								});
							}
							reader.readAsDataURL(files[index]);
						} else {
							return false;
						}
						vm.fileLoopCount++;
					}
				}
			},

			onDropPassport: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createImagesPassport(files)
			},

			deletePassportImage(index) {
				axios.post('/api/image-delete', {
					'image': this.passport_images[index],
				}).then(res => {
					this.passport_images.splice(index, 1);
					this.fileLoopCount--;
				});
			},

			editPassportImage(index, e) {
				var vm = this;
				var files = e.target.files || e.dataTransfer.files;
				var reader = new FileReader();
				reader.onload = function(event) {
					const imageUrl = event.target.result;
					vm.showLoading = true;
					axios.post('/api/image-upload-edit', {
						'image': imageUrl,
						'oldImage': vm.passport_images[index],
						'folder': 'passports/'
					}, {
						headers: {'Authorization': 'Bearer '+ this.user_token}
					}).then((res) => {
						vm.showLoading = false;
						vm.passport_images.splice(index, 1, res.data.url);
					});
				}
				reader.readAsDataURL(files[0]);
			},
			createAllInOne(allinone) {
				console.log(allinone);
				this.$modal.show('all_in_one');
			},
			uploadAllInOneFile(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createAllInOneImages(files)
			},

			createImagesAllInOne(files) {
				var vm = this;
				for (var index = 0; index < files.length; index++) {
					if (!files[index].type.match('application/pdf') && !files[index].type.match('image.*')) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please only select Image!',
							allowOutsideClick: false,
						})
						return;
					} else {
						if(vm.fileLoopCount < vm.fileMaxLenght) {
							var reader = new FileReader();
							reader.onload = function(event) {
								const imageUrl = event.target.result;
								vm.showLoading = true;
								axios.post('/api/image-upload', {
									'image': imageUrl,
									'folder': 'allInOne/'
								}, {
									headers: {'Authorization': 'Bearer '+ this.user_token}
								}).then((res) => {
									vm.showLoading = false;
									vm.all_images.push(res.data.url);
								});
							}
							reader.readAsDataURL(files[index]);
						} else {
							return false;
						}
						vm.fileLoopCount++;
					}
				}
			},

			onDropAllInOne: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createImages(files)
			},

			deleteAllInOneImage(index) {
				axios.post('/api/image-delete', {
					'image': this.all_images[index],
				}).then(res => {
					this.all_images.splice(index, 1);
					this.fileLoopCount--;
				});
			},

			editAllInOneImage(index, e) {
				var vm = this;
				var files = e.target.files || e.dataTransfer.files;
				var reader = new FileReader();
				reader.onload = function(event) {
					const imageUrl = event.target.result;
					vm.showLoading = true;
					axios.post('/api/image-upload-edit', {
						'image': imageUrl,
						'oldImage': vm.all_images[index],
						'folder': 'allInOne/'
					}, {
						headers: {'Authorization': 'Bearer '+ this.user_token}
					}).then((res) => {
						vm.showLoading = false;
						vm.all_images.splice(index, 1, res.data.url);
					});
				}
				reader.readAsDataURL(files[0]);
			},

			addClass(current) {
				$(".card-header").removeClass("bgColor");
				$(current).parent().toggleClass("bgColor");
			},

			// CERTIFICATE BY TT
			hideCertificate() {
				this.$modal.hide('certificate');
				this.value = {},
				this.licine_number = '',
				this.training_date = moment(new Date()).format('DD-MM-YYYY');
				this.expire_date = moment(new Date()).format('DD-MM-YYYY');
				this.certificateImage = '';
				this.remark = '';
				this.employer_certificate_id = null;
				$(document).find('span[class="validate-message"]').remove();
			},

			addCertificate() {
				this.getCertificate();
				this.$modal.show('certificate');
			},

			editCertificate(certificate) {
				this.value = {id: certificate.certificate_id, name: certificate.name},
				this.licine_number = certificate.licine_number,
				this.training_date = certificate.training_date;
				this.expire_date = certificate.expire_date;
				this.certificateImage = certificate.image;
				this.remark = certificate.remark;
				this.employer_certificate_id = certificate.id;
				this.$modal.show('certificate');
			},

			saveCertificate() {
				axios.post('/api/save-certificate', {
					'certificate_name': this.value.id,
					'licine_number': this.licine_number,
					'training_date': this.training_date,
					'expire_date': this.expire_date,
					'image': this.certificateImage,
					'remark': this.remark,
					'employer_id': this.id,
					'id': this.employer_certificate_id
				}, {
					headers: {'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.employer_certificate_id = null;
					this.hideCertificate();
					this.certificate();
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
		}
	}
</script>
