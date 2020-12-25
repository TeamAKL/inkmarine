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

						<div v-else>
							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-primary" id="add-member" @click="editPersonalDdetail(person_detail)" >Edit</button>
							</div>
							<table class="table table-hover">
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
									<tr>
										<td class="wd-70">Image</td>
										<td>
											<img :src="person_detail.image" alt="Certificate Image" class="certificate-image">
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingadditional" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#additionalinfo" aria-expanded="true" aria-controls="additionalinfo" @click="getadditionalinfo">
						Additional Info
					</h5>
				</div>

				<div id="additionalinfo" class="collapse" aria-labelledby="headingadditional" data-parent="#accordion">
					<div class="card-body">
						<div v-if="additional_info_all">
							<div class="d-flex justify-content-center" v-if="loading">
								<img src="../../../public/loading/dataload.gif">
							</div>
							<div v-else>
								<div class="d-flex justify-content-end mb-3">
									<button class="btn btn-primary" @click="editaddinfo(additional_info_all)">Edit</button>
								</div>
								<table class="table table-hover">
									<tbody>
										<tr>
											<th>Phone Number:</th>
											<td>{{additional_info_all.phone_number}}</td>
											<th>Cell Phone Number:</th>
											<td>{{additional_info_all.cell_phone_number}}</td>
										</tr>
										<tr>
											<th>Drinking:</th>
											<td>{{additional_info_all.drinking}}</td>
											<th>Smoking:</th>
											<td>{{additional_info_all.smoking}}</td>
										</tr>
										<tr>
											<th>Deperature Date:</th>
											<td>{{additional_info_all.deperature_date}}</td>
											<th>Rank:</th>
											<td>{{additional_info_all.rank}}</td>
										</tr>
										<tr>
											<th>Company:</th>
											<td>{{additional_info_all.company}}</td>
											<th>Basic Salary:</th>
											<td>{{additional_info_all.basic_salary}} {{additional_info_all.basicsalary_currency}}</td>
										</tr>
										<tr>
											<th>Home Allowance:</th>
											<td>{{additional_info_all.home_allowance}} {{additional_info_all.home_allowance_currency}}</td>
											<th>Total Salary:</th>
											<td>{{additional_info_all.total_salary}} {{additional_info_all.total_salary_currency}}</td>
										</tr>
										<tr>
											<th>Fix Pay:</th>
											<td>{{additional_info_all.fixed_pay}} {{additional_info_all.fixpay_currency}}</td>
											<th>Leave Pay:</th>
											<td>{{additional_info_all.leave_pay}} {{additional_info_all.leavepay_currency}}</td>
										</tr>
										<tr>
											<th>Onboard Pay:</th>
											<td>{{additional_info_all.onbroad_pay}} {{additional_info_all.onbroadpay_currency}}</td>
											<th>Code:</th>
											<td>{{additional_info_all.code}}</td>
										</tr>
										<tr>
											<th>Shoe:</th>
											<td>{{additional_info_all.shoe}}</td>
											<th>Pants:</th>
											<td>{{additional_info_all.pants}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="d-flex justify-content-center" v-else>
							<button class="btn btn-success" @click="createPassport(passport)">Create</button>
						</div>
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
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr :key="certificate.id" v-for="certificate in certificates">
										<td>{{certificate.name}}</td>
										<td>{{certificate.licine_number}}</td>
										<td>{{certificate.training_date}}</td>
										<td>{{certificate.expire_date}}</td>									<td>
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
							<div v-if="medicalcheckup">
								<div class="d-flex justify-content-center" v-if="loading">
									<img src="../../../public/loading/dataload.gif">
								</div>
								<div v-else>
									<div class="d-flex justify-content-end mb-3">
										<button class="btn btn-primary" @click="editMedicateCheckup(medicalcheckup)">Edit</button>
									</div>
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>Date:</th>
												<td>{{medicalcheckup.mdDate}}</td>
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
								</div>
							</div>
							<div class="d-flex justify-content-center" v-else>
								<button class="btn btn-success" @click="createMedicalCheckup">Create</button>
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
						<div v-else>
							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-success" id="add-member" @click="showOtherCompanyCareer" >Add</button>
							</div>
							<table class="table table-hover">
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
									<tr :key="other_company.id" v-for="other_company in othercompanies">
										<td>{{other_company.rank}}</td>
										<td>{{other_company.company_name}}</td>
										<td>{{other_company.ship_name}}</td>
										<td>{{other_company.area}}</td>
										<td>{{other_company.boarding_date}}</td>
										<td>{{other_company.leaving_date}}</td>
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
			</div>
			<div class="card">
				<div class="card-header" id="headingDisease" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#disease" aria-expanded="true" aria-controls="disease" @click="showDisease">
						Diseases
					</h5>
				</div>

				<div id="disease" class="collapse" aria-labelledby="headingDisease" data-parent="#accordion">
					<div class="card-body">


							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-success" id="add-disease" @click="addDisease" >Add</button>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Illness</th>
										<th>Medicine</th>
										<th>Other Medicine</th>
										<th>Remark</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr :key="disease.id" v-for="disease in diseases">
										<td>{{disease.start_date}}</td>
										<td>{{disease.end_date}}</td>
										<td>{{disease.illness}}</td>
										<td>{{disease.medicine}}</td>
										<td>{{disease.other_medicine}}</td>
										<td>{{disease.remark}}</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editDisease(disease)">Edit</a>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteDisease(disease)">Delete</a>
										</td>
									</tr>
								</tbody>
							</table>

					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingInjury" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#injury" aria-expanded="true" aria-controls="injury" @click="showInjury">
						Injuries
					</h5>
				</div>

				<div id="injury" class="collapse" aria-labelledby="headingInjury" data-parent="#accordion">
					<div class="card-body">


							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-success" id="add-injury" @click="addInjury" >Add</button>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Illness</th>
										<th>Medical Name</th>
										<th>Hospital Name</th>
										<th>Start Date</th>
										<th>Recovery Date</th>
										<th>Hospital Type</th>
										<th>Expense Won</th>
										<th>Expense Ex</th>
										<th>Remark</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr :key="injury.id" v-for="injury in injuries">
										<td>{{injury.illness}}</td>
										<td>{{injury.medical_name}}</td>
										<td>{{injury.hospital_name}}</td>
										<td>{{injury.start_date}}</td>
										<td>{{injury.recovery_date}}</td>
										<td>{{injury.hospital_type}}</td>
										<td>{{injury.expenses_won}} {{injury.expenses_won_currency}}</td>
										<td>{{injury.expenses_ex}} {{injury.expenses_ex_currency}}</td>
										<td>{{injury.remark}}</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editInjury(injury)">Edit</a>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteInjury(injury)">Delete</a>
										</td>
									</tr>
								</tbody>
							</table>

					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingEvaluation" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#evaluation" aria-expanded="true" aria-controls="evaluation" @click="showEvaluation">
						Evaluations
					</h5>
				</div>

				<div id="evaluation" class="collapse" aria-labelledby="headingEvaluation" data-parent="#accordion">
					<div class="card-body">


							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-success" id="add-evaluation" @click="addEvaluation" >Add Evaluation</button>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Score</th>
										<th>Re-use</th>
										<th>Rate</th>
										<th>Detail</th>
										<th>Hospital Type</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr :key="evaluation.id" v-for="evaluation in evaluations">
										<td>{{evaluation.date}}</td>
										<td>{{evaluation.score}}</td>
										<td>{{evaluation.re_use}}</td>
										<td>{{evaluation.rate}}</td>
										<td>{{evaluation.detail}}</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editEvaluation(evaluation)">Edit</a>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteEvaluation(evaluation)">Delete</a>
										</td>
									</tr>
								</tbody>
							</table>

					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingAccident" >
					<h5 class="mb-0" data-toggle="collapse" data-target="#accident" aria-expanded="true" aria-controls="accident" @click="showAccident">
						Accidents
					</h5>
				</div>

				<div id="accident" class="collapse" aria-labelledby="headingAccident" data-parent="#accordion">
					<div class="card-body">


							<div class="d-flex justify-content-end mb-3">
								<button type="button" class="btn btn-success" id="add-accident" @click="addAccident" >Add</button>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Ship name</th>
										<th>Rank</th>
										<th>Date</th>
										<th>Type</th>
										<th>Reason</th>
										<th>Cost</th>
										<th>Re-use</th>
										<th>Etc</th>
										<th>Remark</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr :key="accident.id" v-for="accident in accidents">
										<td>{{accident.ship_name}}</td>
										<td>{{accident.rank}}</td>
										<td>{{accident.date}}</td>
										<td>{{accident.type}}</td>
										<td>{{accident.reason}}</td>
										<td>{{accident.cost}} {{accident.currency}}</td>
										<td>{{accident.re_use}}</td>
										<td>{{accident.etc}}</td>
										<td>{{accident.remark}}</td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editAccident(accident)">Edit</a>
											<a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="deleteAccident(accident)">Delete</a>
										</td>
									</tr>
								</tbody>
							</table>

					</div>
				</div>
			</div>

            <!-- View Image Card -->
            <div class="card">
                <div class="card-header" id="headingimageview" >
                    <h5 class="mb-0" data-toggle="collapse" data-target="#viewimages" aria-expanded="true" aria-controls="viewimages" @click="viewimages">
                        View Images
                    </h5>
                </div>
                <div id="viewimages" class="collapse" aria-labelledby="headingimageview" data-parent="#accordion">
                    <div class="card-body">
                        <div class="grid-container mb-3" :key="cert.id" v-for="cert in view_certificate_images">
                            <div class="gird-item-image mb-5" :key="index" v-for="(image, index) in cert.images" @click="downloadImage(image)">
                                <img :src="image" alt="image" class="images-img img-thumbnail">
                                <span class="text-center">{{cert.name}} ({{index + 1}})</span>
                                <div class="image-overlay">
                                    <i class="wizard-icon ti-eye icon-holder eyeicon" @click="downloadImage(image)"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>

		<!-- ==================================== ADDITIONAL INFORMATION ========================== -->
		<modal name="additionalInfo" :clickToClose="false" height="auto" :width="w" class="additional_info">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Additional Info</h5>
					<button type="button" class="close" @click="hideaddinof" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="phone_number">Phone Number </label>
							<input type="text" class="form-control" id="phone_number" name="phone_number" v-model.trim="phone_number">
						</div>

						<div class="form-group col-md-6">
							<label for="cell_phone_number">Cell Phone Number</label>
							<input type="text" class="form-control" id="cell_phone_number" name="cell_phone_number" v-model.trim="cell_phone_number">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="drinking">Drinking</label>
							<input type="text" class="form-control" id="drinking" name="drinking" v-model.trim="drinking">
						</div>

						<div class="form-group col-md-6">
							<label for="smoking">Smoking</label>
							<input type="text" class="form-control" id="smoking" name="smoking" v-model.trim="smoking">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="deperature_date">Deperature Date</label>
							<date-picker v-model.trim="deperature_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
						</div>

						<div class="form-group col-md-6">
							<label for="rank">Rank</label>
							<input type="text" class="form-control" id="rank" name="rank" v-model.trim="rank">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="company">Company</label>
							<input type="text" class="form-control" id="company" name="company" v-model.trim="company">
						</div>

						<div class="form-group col-md-5">
							<label for="basic_salary">Basic Salary</label>
							<input type="text" class="form-control" id="basic_salary" name="basic_salary" v-model.trim="basic_salary">
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="basicsalary_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="home_allowance">Home Allowance</label>
							<input type="text" class="form-control" id="home_allowance" name="home_allowance" v-model.trim="home_allowance" >
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="home_allowance_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>

						<div class="form-group col-md-5">
							<label for="total_salary">Total Salary</label>
							<input type="text" class="form-control" id="total_salary" name="total_salary" v-model.trim="total_salary">
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="total_salary_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="fixed_pay">Fixed Pay</label>
							<input type="text" class="form-control" id="fixed_pay" name="fixed_pay" v-model.trim="fixed_pay">
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="fixpay_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="leave_pay">Leave Pay</label>
							<input type="text" class="form-control" id="leave_pay" name="leave_pay" v-model.trim="leave_pay">
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="leavepay_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="onbroad_pay">Onbroad Pay</label>
							<input type="text" class="form-control" id="onbroad_pay" name="onbroad_pay" v-model.trim="onbroad_pay">
						</div>
						<div class="form-group col-md-1">
							<label>&nbsp;</label>
							<select class="form-control" v-model="onbroadpay_currency">
								<option value="MMK">MMK</option>
								<option value="USD">USD</option>
								<option value="SGD">SGD</option>
							</select>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="code">Code</label>
							<!-- <input type="text" class="form-control" id="code" name="code" v-model.trim="code"> -->
							<select name="code" id="code" v-model.trim="code" class="form-control">
								<option value="small">Small</option>
								<option value="medium">Medium</option>
								<option value="large">Large</option>
								<option value="xl">XL</option>
								<option value="xxl">XXL</option>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="pants">Pants</label>
							<!-- <input type="text" class="form-control" id="pants" name="pants" v-model.trim="pants"> -->
							<multiselect v-model="pants" :max-height="200" :options="pan" placeholder="Select one" label="size" track-by="size" ></multiselect>
						</div>

						<div class="form-group col-md-4">
							<label for="shoe">Shoe</label>
							<input type="text" class="form-control" id="shoe" name="shoe" v-model.trim="shoe">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" @click="hideaddinof">Close</button>
					<button class="btn btn-success" @click="saveaddinfo">Save</button>
				</div>
			</div>
		</modal>
		<!-- ==================================== END ADDITIONAL INFORMATION ========================== -->
		<!-- ==================================== IMAGE SHOW MODAL ================================= -->
		<modal name="show_image" :clickToClose="false" height="auto" :width="w" class="medical_checkup">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" @click="hideshowmodal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<img :src="imagShow" alt="show single image" class="img-thumbnail" style="width:100%">
				</div>
				<div class="modal-footer">
					<a :href="imagShow" class="btn btn-success" download><i class="wizard-icon ti-import"></i> Download</a>
					<button class="btn btn-primary" @click="hideshowmodal">Close</button>
				</div>
			</div>
		</modal>
		<!-- ==================================== END IMAGE SHOW MODAL ================================= -->
		<!-- ==================================== PERSONAL DETAIL MODAL ================================= -->
		<modal name="person_detail" :clickToClose="false" height="auto" class="personal_detail" :width="w">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Personal Detail</h5>
					<button type="button" class="close" @click="hidePerson" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
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

					<div class="form-group col-md-12 mb-5">
						<p>Choose Image</p>
						<div class="custom-file col-md-12">
							<input type="file" class="custom-file-input" id="customFile" @change="fileChange" >
							<label class="custom-file-label" for="customFile" id="changeLabel">{{imglabel}}</label>
							<div class="loading-container" v-show="showLoading">
								<img src="../../../public/loading/small_loading.gif" alt="ll" >
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
				<div class="modal-footer">
					<button class="btn btn-primary" @click="hidePerson">Close</button>
					<button class="btn btn-success" @click="savePerson">Save</button>
				</div>
			</div>
		</modal>
		<!-- ==================================== END PERSONAL DETAIL MODAL ================================= -->

		<!--Family member Modal -->
		<modal name="family_member" :clickToClose="false" height="auto" class="family_member_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Family Member</h5>
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
					<h5 class="modal-title">Certificate</h5>
					<button type="button" class="close" @click="hideCertificate" aria-label="Close">
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
							<div class="image-holder" v-show="all_images.length == 0">
								<div class="loading-area-one" v-show="showLoading">
									<img src="../../../public/loading/loading.gif" alt="">
								</div>
								<label for="all-images" class="medicalcheckup" @dragover.prevent @drop="onDropPassport">
									<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
									<span class="image-lable-text" v-show="!showLoading">Choose File or drag & drop here</span>
								</label>
							</div>
							<div class="grid-container" @dragover.prevent @drop="onDropPassport" v-show="all_images.length >= 1">
								<div class="loading-area" v-show="showLoading">
									<img src="../../../public/loading/loading.gif" alt="">
								</div>
								<div class="gird-item-image " :key="index" v-for="(image, index) in imageAllInOne">
									<img :src="image.img" alt="image" class="images-img img-thumbnail" v-if="image.ext != 'pdf'">
									<img src="../../../public/pdf/pdfimage.png" class="images-img img-thumbnail"  v-else/>
									<div class="image-overlay" v-if="image.ext != 'pdf'">
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

									<div class="image-overlay" v-else>
										<div class="main-ovl">
											<div class="ovly" @click="pdfopen(image.img)"></div>
											<div class="dele-ar">
												<label style="cursor: pointer">
													<input type="file" @change="editImage(index, $event)" class="d-none" accept="image/*, .pdf">
													<i class="wizard-icon ti-pencil icon-holder edit"></i>
												</label>
												<i class="wizard-icon ti-trash icon-holder delete" @click="deleteImage(index, $event)"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="gird-item-image final-grid" v-show="countall < allMaxLength">
									<label for="all-images" class="medicalcheckup" @dragover.prevent @drop="onDropPassport">
										<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
										<span class="image-lable-text">Choose File or drag & drop here</span>
									</label>
								</div>
							</div>
							<input type="file" multiple draggable="true" id="all-images" @change="uploadPassportFile" accept="image/*, .pdf">
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
		<modal name="medical_checkup" :clickToClose="false" height="auto" :width="w" class="medical_checkup">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Medical Checkup</h5>
					<button type="button" class="close" @click="closeMedicalcheckup" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="date">Date</label>
						<date-picker v-model.trim="med_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="">Weight</label>
							<input type="text" class="form-control" name="weight" v-model.trim="weight">
						</div>
						<div class="form-group col-sm-6">
							<label for="">Height</label>
							<input type="text" class="form-control"  name="height" v-model.trim="height">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="">Chest</label>
							<input type="text" class="form-control" name="checst" v-model="checst">
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
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="closeMedicalcheckup" >Close</button>
						<button type="button" class="btn btn-success" id="create_medical_checkup" @click="createNewMedicalCheckup" >Save</button>
					</div>

				</div>
			</div>
		</modal>

		<!--Other company career Modal -->
		<modal name="other_company" :clickToClose="false" height="auto" class="company_career_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Other Company Careers</h5>
					<button type="button" class="close" @click="hideOtherCompanyCareer" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label class="typo__label" for="">Company</label>
							<input type="text" class="form-control" id="company_name" name="company_name"  v-model.trim="company_name">
						</div>
						<div class="form-group col-md-6">
							<label class="typo__label" for="">Ship Name</label>
							<input type="text" class="form-control" id="ship_name" name="ship_name"  v-model.trim="ship_name">
						</div>
					</div>

					<div class="form-row">
						<div class="col-md-4 form-group">
							<label for="">Rank</label>
							<input type="text" class="form-control" id="rank" name="rank"  v-model.trim="rank">
						</div>
						<div class="col-md-4 form-group">
							<label for="">GRT</label>
							<input type="text" class="form-control" id="grt" name="grt"  v-model.trim="grt">
						</div>
						<div class="col-md-4 form-group">
							<label for="">KW</label>
							<input type="text" class="form-control" id="kw" name="kw"  v-model.trim="kw">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="">Boarding Date</label>
							<date-picker v-model="boarding_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
						</div>
						<div class="form-group col-md-4">
							<label for="">Leaving Date</label>
							<date-picker v-model="leaving_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
						</div>
						<div class="form-group col-md-4">
							<label for="">Area</label>
							<input type="text" class="form-control" id="area" name="area"  v-model.trim="area">
						</div>
					</div>

					<div class="form-group">
						<label for="">Remark</label>
						<textarea name="company_remark" id="company_remark" v-model.trim="company_remark" cols="30" rows="6" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-end">
					<button class="btn btn-primary" @click="hideOtherCompanyCareer">Cancel</button>
					<button class="btn btn-success"  @click="saveOtherCompanyCareer">Add</button>
				</div>
			</div>
		</modal>

		<!-- Disease Modal -->
		<modal name="disease_modal" :clickToClose="false" height="auto" class="disease_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Disease</h5>
					<button type="button" class="close" @click="hideDiseaseModal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="start_date">Start Date</label>
                            <date-picker v-model="disease_start_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="end_date">End Date</label>
                            <date-picker v-model="disease_end_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="illness">Illness</label>
                            <input type="text" class="form-control" id="illness" name="illness"  v-model.trim="disease_illness">
                        </div>

                        <div class="form-group">
                            <label for="medicine">Medicine</label>
                            <input type="text" class="form-control" id="medicine" name="medicine" v-model.trim="disease_medicine" >
                        </div>

                        <div class="form-group">
                            <label for="other_medicine">Other_medicine</label>
                            <input type="text" class="form-control" id="other_medicine" name="other_medicine" v-model.trim="disease_other_medicine" >
                        </div>

                        <div class="form-group">
                            <label for="remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="disease_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideDiseaseModal">Cancel</button>
                    <button class="btn btn-success" @click="saveDisease">Add</button>
                </div>
			</div>
		</modal>
		<!-- Accident Modal -->
		<modal name="accident_modal" :clickToClose="false" height="auto" class="accident_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Accident</h5>
					<button type="button" class="close" @click="hideAccidentModal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="accident_ship_name">Ship Name</label>
                            <input type="text" class="form-control" id="accident_ship_name" name="accident_ship_name"  v-model.trim="accident_ship_name">
                        </div>

						<div class="form-group">
                            <label for="accident_rank">Rank</label>
                             <input type="text" class="form-control" id="accident_rank" name="accident_rank"  v-model.trim="accident_rank">
                        </div>

                        <div class="form-group">
                            <label for="accident_date">Date</label>
                            <date-picker v-model="accident_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>
                        <div class="form-group">
                            <label for="accident_type">Type</label>
                            <input type="text" class="form-control" id="accident_type" name="accident_type" v-model.trim="accident_type" >
                        </div>

                        <div class="form-group">
                            <label for="accident_reason">Reason</label>
                            <input type="text" class="form-control" id="accident_reason" name="accident_reason" v-model.trim="accident_reason" >
                        </div>

                        <div class="form-group">
                            <label for="accident_cost">Cost</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="accident_cost" name="accident_cost" v-model.trim="accident_cost" >

                                    <select class="form-control col-4" v-model="accident_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="accident_re_use">Re-use</label>
                            <input type="text" class="form-control" id="accident_re_use" name="accident_re_use" v-model.trim="accident_re_use" >
                        </div>

                         <div class="form-group">
                            <label for="accident_etc">Etc</label>
                            <input type="text" class="form-control" id="accident_etc" name="accident_etc" v-model.trim="accident_etc" >
                        </div>

                        <div class="form-group">
                            <label for="accident_remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="accident_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideAccidentModal">Cancel</button>
                    <button class="btn btn-success" @click="saveAccident">Add</button>
                </div>
			</div>
		</modal>

		<!-- injury -->
		<modal name="injury_modal" :clickToClose="false" height="auto" class="injury_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Injury</h5>
				</div>
				<div class="modal-body">
					<form>

						<div class="form-group">
                            <label for="injury_illness">Illness</label>
                            <input type="text" class="form-control" id="injury_illness" name="injury_illness"  v-model.trim="injury_illness">
                        </div>

						<div class="form-group">
                            <label for="injury_medical_name">Medical Name</label>
                             <input type="text" class="form-control" id="injury_medical_name" name="injury_medical_name"  v-model.trim="injury_medical_name">
                        </div>

						<div class="form-group">
                            <label for="injury_hospital_name">Hospital Name</label>
                             <input type="text" class="form-control" id="injury_hospital_name" name="injury_hospital_name"  v-model.trim="injury_hospital_name">
                        </div>

                        <div class="form-group">
                            <label for="injury_start_date">Start Date</label>
                            <date-picker v-model="injury_start_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="injur_recovery_date">Recovery Date</label>
                            <date-picker v-model="injury_recovery_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

                        <div class="form-group">
                            <label for="injury_hospital_type">Hospital Type</label>
                            <multiselect v-model="injury_hospital_type" :options="options" :searchable="false" :close-on-select="true" :show-labels="false"></multiselect>
					    </div>

                        <div class="form-group">
                            <label for="injury_expense_won">Expenses Won</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="injury_expense_won" name="injury_expense_won" v-model.trim="injury_expenses_won" >

                                    <select class="form-control col-4" v-model="injury_expenses_won_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="injury_expense_ex">Expense Ex</label>
                            <div class="row mx-1">
                                    <input type="text" class="form-control col-8" id="injury_expense_ex" name="injury_expense_ex" v-model.trim="injury_expenses_ex" >

                                    <select class="form-control col-4" v-model="injury_expenses_ex_currency">
                                        <option value="MMK">MMK</option>
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                    </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="injury_remark">Remark</label>
                            <textarea name="remark" id="remark" v-model.trim="injury_remark" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideInjury">Cancel</button>
                    <button class="btn btn-success" @click="saveInjury">Add</button>
                </div>
			</div>
		</modal>

		<!-- evaluation -->
		<modal name="crew_evaluate_modal" :clickToClose="false" height="auto" class="crew_evaluate_modal">
			<div class="modal-content">
				<div class="modal-header">
					<h5>Add Crew Evaluation</h5>
				</div>
				<div class="modal-body">
					<form>

                        <div class="form-group">
                            <label for="crew_date">Date</label>
                            <date-picker v-model="crew_date" valueType="format" class="date-picker" format="DD-MM-YYYY"></date-picker>
                        </div>

						<div class="form-group">
                            <label for="crew_score">Score</label>
                            <input type="text" class="form-control" id="crew_score" name="crew_score"  v-model.trim="crew_score">
                        </div>

						<div class="form-group">
                            <label for="crew_re_use">Re-use</label>
                            <multiselect v-model="crew_re_use" :options="crewoptions" :searchable="false" :close-on-select="true" :show-labels="false" placeholder="---- Select Re Use -----"></multiselect>
                        </div>

                        <div class="form-group">
                            <label for="crew_rate">Rate</label>
                            <input type="text" class="form-control" id="crew_rate" name="crew_rate" v-model.trim="crew_rate" >
                        </div>

                        <div class="form-group">
                            <label for="crew_detail">Detail</label>
                            <input type="text" class="form-control" id="crew_detail" name="crew_detail" v-model.trim="crew_detail" >
                        </div>

                    </form>
				</div>
                <div class="modal-footer d-flex justify-content-end">
                    <button class="btn btn-primary" @click="hideEvaluation">Cancel</button>
                    <button class="btn btn-success" @click="saveCrewEvaluate">Add</button>
                </div>
			</div>
		</modal>

	</div>

</template>

<style lang="scss" scoped>

.bgcolor {
	background: red;
}
.additional_info,.personal_detail,.disease_modal,.accident_modal,.certificate_modal,.injury_modal
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
	cursor: pointer;
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

.grid-container {
	border: none !important;
	min-height: 0 !important;
}

.eyeicon {
	position: absolute;
	left: 45%;
	top: 47%;
	color: #fff;
	font-size: 20px;
}

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
	import Swal from 'sweetalert2/dist/sweetalert2.js'
	import 'sweetalert2/src/sweetalert2.scss'
	import Multiselect from 'vue-multiselect'
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

	export  default{
		components: {
			DatePicker,
			Multiselect,
		},
		data() {
			return {
				h: '50%',
				w: '70%',
				imagShow: '',
				loading: true,
				id: '',
				user_token: `${process.env.MIX_APP_TOKEN}`,
				person_detail: {},
				dob: '',
				family_members: {},
				certificates: {},
				medicalcheckup: {},
				othercompanies: {},
				additional_info_all: {},

                //ADDITIONAL INFO
                phone_number: '',
                cell_phone_number: '',
                drinking: '',
                smoking: '',
                deperature_date: '',
                rank: '',
                company: '',
                basic_salary: '',
                home_allowance: '',
                total_salary: '',
                fixed_pay: '',
                leave_pay: '',
                onbroad_pay: '',
                code: 'small',
                shoe: '',
                pants: {
                    size: 28
                },
                pan: [
                {size: 28},{size: 29},
                {size: 30},{size: 31},{size: 32},{size: 33},{size: 34},{size: 35},{size: 36},{size: 37},{size: 38},{size: 39},{size: 40},
                ],
                basicsalary_currency: 'MMK',
                onbroadpay_currency: 'MMK',
                fixpay_currency: 'MMK',
                leavepay_currency: 'MMK',
                home_allowance_currency: 'MMK',
                total_salary_currency: 'MMK',
                employer_detail_id: null,

                //Modal Certificate
                value: { },
                options: [],
                licine_number: '',
                training_date: '',
                expire_date: '',
                remark: '',
                imglabel: 'Choose Image..',
                // Image
                all_images: [],
                countall: 0,
                allMaxLength: 10,
                // showLoading: false,
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
                diseases:{},
                accidents:{},
                injuries:{},
                evaluations:{},
                additional_info_all: {},

                //MEDICALCHECKUP
                showLoading: false,
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
                //disease
                disease_start_date: '',
                disease_end_date: '',
                disease_illness:'',
                disease_medicine: '',
                disease_other_medicine: '',
                disease_remark: '',
                diseaseId: null,
                //accident
                accident_ship_name: '',
                accident_rank: '',
                accident_date:'',
                accident_type: '',
                accident_reason: '',
                accident_cost: '',
                accident_currency:'MMK',
                accident_re_use: '',
                accident_etc: '',
                accident_remark: '',
                accidentId: null,


                //PERSONAL DETAIL
                crewcode: '',
                name: '',
                nationality: '',
                dob: '',
                pob: '',
                edulevel: '',
                ship: '',
                result: '',
                image: '',
                showLoading: false,
                imglabel: 'Choose image...',

                //FamilyMember
                member_name: '',
                member_relation: '',
                member_phone_number: '',
                member_dob: '',
                member_remark: '',
                family_member_id: null,

                //OtherCompanyCareer
                rank: '',
                grt: '',
                kw: '',
                company_name: '',
                ship_name: '',
                boarding_date: '',
                leaving_date: '',
                area: '',
                company_remark: '',
                company_career_id: null,

                view_certificate_images: [],
                //injury
                injury_illness: '',
                injury_id: null,
                injury_medical_name: '',
                injury_hospital_name: '',
                injury_start_date: '',
                injury_recovery_date: '',
                injury_hospital_type: 'Public',
                injury_expenses_won: '',
                injury_expenses_won_currency:'MMK',
                injury_expenses_ex: '',
                injury_expenses_ex_currency:'MMK',
                injury_remark: '',
                options: ['Public', 'Private'],

                //evaluation
                crew_date: '',
                crew_score: null,
                crew_re_use: '',
                crewoptions: ['Recommendation', 'Re-use', 'Improvement', 'Impossible'],
                crew_rate: '',
                crew_detail: '',
                crew_evaluation_id: null,
		    }
	    },
        computed: {
            imageAllInOne: function() {
                var mimages = this.all_images;
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
            },
            medImage: function() {
                var images = this.medical_images;
                var arr = [];
                var imgarr = [];
                var extimg = [];
                $.each(images, function(key, value) {
                    var obj = {};
                    imgarr = value.split('/');
                    extimg = imgarr[5].split('.');
                    obj = {
                        img: value,
                        ext: extimg[1]
                    }
                    arr.push(obj)
                })
                return arr;
            },
        },
        created() {
            var route = window.location.pathname;
            var arr = route.split('/');
            this.id = arr[2];
            this.personDetail();

            const date = new Date();
            this.member_dob = moment(date).format('DD-MM-YYYY');
            this.training_date = moment(date).format('DD-MM-YYYY');
            this.expire_date = moment(date).format('DD-MM-YYYY');
            this.leaving_date = moment(date).format('DD-MM-YYYY');
            this.boarding_date = moment(date).format('DD-MM-YYYY');
            this.med_date = moment(date).format('DD-MM-YYYY');
            this.disease_start_date= moment(date).format('DD-MM-YYYY');
            this.disease_end_date= moment(date).format('DD-MM-YYYY');
            this.accident_date=moment(date).format('DD-MM-YYYY');
            this.injury_start_date=moment(date).format('DD-MM-YYYY');
            this.injury_recovery_date=moment(date).format('DD-MM-YYYY');

        },


        methods: {
            // ========================= Get Additional Info ============================
            getadditionalinfo() {
                this.loading = true;
                axios.post('/api/get-additional-info', {
                    'employer_id': this.id
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    if(result.data.additionalinfo != null) {
                        this.loading = false;
                        this.additional_info_all = result.data.additionalinfo;
                    } else {
                        this.additional_info_all = false;
                    }
                });
            },

            hideaddinof() {
                this.$modal.hide('additionalInfo');
            },

            editaddinfo(allinfo) {
                this.basic_salary = allinfo.basic_salary;
                this.basicsalary_currency = allinfo.basicsalary_currency;
                this.phone_number = allinfo.phone_number;
                this.cell_phone_number = allinfo.cell_phone_number;
                this.drinking = allinfo.drinking;
                this.smoking = allinfo.smoking;
                this.deperature_date = moment(allinfo.deperature_date).format('DD-MM-YYYY');
                this.rank = allinfo.rank;
                this.company = allinfo.company;
                this.home_allowance = allinfo.home_allowance;
                this.home_allowance_currency = allinfo.home_allowance_currency;
                this.total_salary = allinfo.total_salary;
                this.total_salary_currency = allinfo.total_salary_currency;
                this.fixed_pay = allinfo.fixed_pay;
                this.fixpay_currency = allinfo.fixpay_currency;
                this.leave_pay = allinfo.leave_pay;
                this.leavepay_currency = allinfo.leavepay_currency;
                this.onbroad_pay = allinfo.onbroad_pay;
                this.onbroadpay_currency = allinfo.onbroadpay_currency;
                this.code = allinfo.code;
                this.pants.size = allinfo.pants;
                this.shoe = allinfo.shoe;
                this.employer_detail_id = allinfo.id;
                this.$modal.show('additionalInfo');
            },

            saveaddinfo() {
                axios.post('/api/save-form-two', {
                    'basic_salary': this.basic_salary,
                    'phone_number': this.phone_number,
                    'cell_phone_number': this.cell_phone_number,
                    'drinking': this.drinking,
                    'smoking': this.smoking,
                    'deperature_date': this.deperature_date,
                    'rank': this.rank,
                    'company': this.company,
                    'home_allowance': this.home_allowance,
                    'total_salary': this.total_salary,
                    'fixed_pay': this.fixed_pay,
                    'leave_pay': this.leave_pay,
                    'onbroad_pay': this.onbroad_pay,
                    'code': this.code,
                    'shoe': this.shoe,
                    'pants': this.pants.size,
                    'employer_detail_id': this.employer_detail_id,
                    'employerId': this.id,
                    'basicsalary_currency': this.basicsalary_currency,
                    'onbroadpay_currency': this.onbroadpay_currency,
                    'fixpay_currency': this.fixpay_currency,
                    'leavepay_currency': this.leavepay_currency,
                    'home_allowance_currency': this.home_allowance_currency,
                    'total_salary_currency': this.total_salary_currency
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.getadditionalinfo();
                    this.hideaddinof();
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
                });
            },
            // ========================= End Additional Info ============================
            //========================== Download ========================
            downloadImage(url) {
                this.imagShow = url;
                this.$modal.show('show_image');
            },

            hideshowmodal() {
                this.$modal.hide('show_image');
            },
            //====================== END DOWNLOAD ========================
            //====================== PERSONAL DETAIL ========================
            editPersonalDdetail(person) {
                this.crewcode = person.crew_code;
                this.name = person.name;
                this.nationality = person.nationality;
                this.dob = moment(person.date_of_birth).format('DD-MM-YYYY');
                this.pob = person.place_of_birth;
                this.edulevel = person.education_level;
                this.ship = person.ship;
                this.image = person.image
                this.$modal.show('person_detail');
                console.log("jhjhj");
            },

            hidePerson() {
                this.$modal.hide('person_detail');
            },

            savePerson() {
                axios.post('/api/save-form-one', {
                    'crewcode': this.crewcode,
                    'name': this.name,
                    'nationality': this.nationality,
                    'dob': this.dob,
                    'pob': this.pob,
                    'edulevel': this.edulevel,
                    'ship': this.ship,
                    'personId': this.id,
                    'image': this.image
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then((result) => {
                    this.hidePerson();
                    this.personDetail();
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
            //====================== END PERSONAL DETAIL ========================
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

            medicalC() {
                this.loading = true;
                axios.post('/api/get-meidicalcheckup', {
                    employer_id: this.id
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    if(result.data.medicalcheckup != null) {
                        this.loading = false;
                        this.medicalcheckup = result.data.medicalcheckup;
                    } else {
                        this.medicalcheckup = false;
                    }
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


            /*================================== Start Family Member ==========================================*/
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
            // Delete Family Members
            deleteFamilyMember(member) {
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + member.name,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-family-member', {
                            id: member.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.familyMember();
                        })
                    }
                });
            },
            /*================================ End Family Member ===============================================*/
            //=============================== MEDICALCHECKUP BY TT ==============================================
            createMedicalCheckup() {
                this.$modal.show('medical_checkup');
            },

            closeMedicalcheckup() {
                this.$modal.hide('medical_checkup');
            },

            editMedicateCheckup(medical) {
                this.height = medical.height;
                this.weight = medical.weight;
                this.checst = medical.checst;
                this.tooth = medical.tooth;
                this.tooth_state = medical.tooth_state;
                this.color_blindness = medical.color_blindness;
                this.blood_type = medical.blood_type;
                this.xray = medical.xray;
                this.sight_right = medical.sight_right;
                this.sight_left = medical.sight_left;
                this.hearing_left = medical.hearing_left;
                this.hearing_right = medical.hearing_right;
                this.hospital = medical.hospital;
                this.decision = medical.decision;
                this.medicalCheckupId = medical.id;
                this.med_date = moment(medical.med_date).format('DD-MM-YYYY');
                this.$modal.show('medical_checkup');
            },
            //================================= END MEDICALCHEKUP =========================================
            /*================================= Start Other Company Career =================================*/
            editOtherCompany(item) {
                this.company_career_id = item.id;
                this.rank = item.rank;
                this.grt = item.grt;
                this.kw = item.kw;
                this.ship_name = item.ship_name;
                this.company_name = item.company_name;
                this.boarding_date =item.boarding_date;
                this.leaving_date = item.leaving_date;
                this.area = item.area;
                this.company_remark = item.remark;
                this.user_id = this.id;
                this.showOtherCompanyCareer();
            },
            showOtherCompanyCareer(){
                this.$modal.show('other_company');
            },
            hideOtherCompanyCareer(){
                this.rank = '',
                this.grt = '',
                this.kw = '',
                this.company_name = '',
                this.ship_name = '',
                this.company_name = '',
                this.boarding_date = moment(new Date()).format('DD-MM-YYYY');
                this.leaving_date = moment(new Date()).format('DD-MM-YYYY');
                this.area = '',
                this.company_remark = '',
                this.$modal.hide('other_company');
            },
            saveOtherCompanyCareer(){

                axios.post('/api/save-other-company-careers', {
                    'rank': this.rank,
                    'grt': this.grt,
                    'kw': this.kw,
                    'company_name': this.company_name,
                    'ship_name': this.ship_name,
                    'boarding_date': this.boarding_date,
                    'leaving_date':this.leaving_date,
                    'area': this.area,
                    'company_remark':this.company_remark,
                    'company_career_id' : this.company_career_id,
                    'user_id':this.id,
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    this.hideOtherCompanyCareer();
                    $(document).find('span[class="validate-message"]').remove();
                    this.otherCompanyCareer();
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

            // Delete Company Career
            deleteOtherCompany(company) {
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + company.ship_name,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-company-career', {
                            id: company.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.otherCompanyCareer();
                        })
                    }
                });
            },
            /*============== End Other Company Career =============*/

            createNewMedicalCheckup() {
                axios.post('/api/save-medical-checkup', {
                    'employerId': this.id,
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
                    this.closeMedicalcheckup();
                    this.medicalCheckupId = result.data.mde.id;
                    $(document).find('span[class="validate-message"]').remove();
                    this.medicalC();
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

            // ================================================= CERTIFICATE BY TT =================================================
            hideCertificate() {
                this.$modal.hide('certificate');
                this.value = {},
                this.licine_number = '',
                this.training_date = moment(new Date()).format('DD-MM-YYYY');
                this.expire_date = moment(new Date()).format('DD-MM-YYYY');
                this.all_images = [];
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
                this.all_images = JSON.parse(certificate.image);
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
                    'image': this.all_images,
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

            deleteCertificate(certificate) {
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + certificate.name,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-certificate', {
                            id: certificate.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.certificate();
                        })
                    }
                });
            },

            //====================== View Images Section =========================
            showDisease() {
                axios.post('/api/get-all-disease-detail', {
                    employer_id: this.id
                }, {
                    headers:{'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                    let self = this;
                    self.view_certificate_images = [];
                    $.each(result.data.images, function(index, value) {
                        const obj = {
                            'name': value.certificate.title,
                            'images': JSON.parse(value.image)
                        }
                        self.view_certificate_images.push(obj);
                    });

                    console.log(self.view_certificate_images, result.data);
                });
            },

            pdfopen(pdf) {
                window.open(pdf);
            },

            uploadPassportFile(e) {
                console.log(e);
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createPassportImg(files)
            },

            onDropPassport: function(e) {
                e.stopPropagation();
                e.preventDefault();
                var files = e.target.files || e.dataTransfer.files;
                this.createPassportImg(files)
            },

            createPassportImg(files) {
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
                        if(vm.countall < vm.allMaxLength) {
                            var reader = new FileReader();
                                reader.onload = function(event) {
                                const imageUrl = event.target.result;
                                vm.showLoading = true;
                                axios.post('/api/image-upload', {
                                    'image': imageUrl,
                                    'folder': 'all/'
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
                        vm.countall++;
                    }
                }
            },

            editImage(index, e) {
                e.preventDefault();
                var vm = this;
                var files = e.target.files || e.dataTransfer.files;
                var reader = new FileReader();
                    reader.onload = function(event) {
                    const imageUrl = event.target.result;
                    vm.showLoading = true;
                    axios.post('/api/image-upload-edit', {
                        'image': imageUrl,
                        'oldImage': vm.all_images[index],
                        'folder': 'all/'
                    }, {
                        headers: {'Authorization': 'Bearer '+ this.user_token}
                    }).then((res) => {
                        vm.showLoading = false;
                        vm.all_images.splice(index, 1, res.data.url);
                    });
                }
                reader.readAsDataURL(files[0]);
            },

            deleteImage(index, e) {
                axios.post('/api/image-delete', {
                    'image': this.all_images[index],
                }).then(res => {
                    this.all_images.splice(index, 1);
                    this.countall--;
                });
                e.stopPropagation();
            },

            editDisease(item) {
            this.addDisease();
            this.disease_start_date = item.start_date;
            this.disease_end_date = item.end_date;
            this.disease_illness = item.illness;
            this.disease_medicine = item.medicine;
            this.disease_other_medicine = item.other_medicine;
            this.disease_remark = item.remark;
            this.employerId = item.employer_id;
            this.diseaseId = item.id;
            },
            deleteDisease(item){
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + item.illness,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-disease', {
                            id: item.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.showDisease();
                        })
                    }
                });

            },
            addDisease() {
            this.$modal.show('disease_modal');
            },

            hideDiseaseModal() {
                this.$modal.hide('disease_modal');
                this.disease_start_date = moment(new Date()).format('DD-MM-YYYY');
                this.disease_end_date = moment(new Date()).format('DD-MM-YYYY');
                this.disease_illness = '',
                this.disease_medicine = '',
                this.disease_other_medicine = '',
                this.disease_remark = ''
            },
            saveDisease() {

            axios.post('/api/save-disease', {
                'employerId': this.id,
                'start_date': this.disease_start_date,
                'end_date': this.disease_end_date,
                'illness': this.disease_illness,
                'medicine': this.disease_medicine,
                'other_medicine': this.disease_other_medicine,
                'remark': this.disease_remark,
                'diseaseId': this.diseaseId
            }, {
                headers: {'Authorization': 'Bearer '+ this.user_token}
            }).then(result => {
            this.hideDiseaseModal();
            $(document).find('span[class="validate-message"]').remove();
            this.showDisease();
            this.diseaseId = null;
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
            //====end Disease===
            //====Accident===
            showAccident() {
                    axios.post('/api/get-all-accident-detail', {
                        employer_id: this.id
                    }, {
                        headers:{'Authorization': 'Bearer '+ this.user_token}
                    }).then(result => {

                        this.accidents = result.data.accidents;
                    });
            },
            addAccident(){
                this.$modal.show('accident_modal');
            },
            hideAccidentModal() {
                    this.$modal.hide('accident_modal');
                    this.accident_date = moment(new Date()).format('DD-MM-YYYY');
                    this.accident_ship_name = '',
                    this.accident_rank = '',
                    this.accident_type = '',
                    this.accident_reason = '',
                    this.accident_cost = '',
                    this.accident_currency='',
                    this.accident_re_use = '',
                    this.accident_etc = '',
                    this.accident_remark = ''
            },
            saveAccident() {

                axios.post('/api/save-accident', {
                    'employerId': this.id,
                    'ship_name': this.accident_ship_name,
                    'rank': this.accident_rank,
                    'date': this.accident_date,
                    'type': this.accident_type,
                    'reason': this.accident_reason,
                    'cost': this.accident_cost,
                    'currency':this.accident_currency,
                    're_use': this.accident_re_use,
                    'etc': this.accident_etc,
                    'remark': this.accident_remark,
                    'accidentId': this.accidentId
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                this.hideAccidentModal();
                $(document).find('span[class="validate-message"]').remove();
                this.showAccident();
                this.accidentId = null;
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
            editAccident(item){
                this.addAccident();
                this.accident_date = item.date;
                this.accident_ship_name = item.ship_name;
                this.accident_rank = item.rank;
                this.accident_type = item.type;
                this.accident_reason = item.reason;
                this.accident_cost = item.cost;
                this.accident_currency=item.currency
                this.accident_re_use = item.re_use;
                this.accident_etc = item.etc;
                this.accident_remark = item.remark;
                this.employerId = item.employer_id;
                this.accidentId = item.id;
            },
            deleteAccident(item) {
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + item.type,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-accident', {
                            id: item.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.showAccident();
                        })
                    }
                });
            },
            //injury
            showInjury() {
                    axios.post('/api/get-all-injury', {
                        employer_id: this.id
                    }, {
                        headers:{'Authorization': 'Bearer '+ this.user_token}
                    }).then(result => {

                        this.injuries = result.data.injuries;
                    });
            },
            addInjury() {
                this.$modal.show('injury_modal');
            },

            hideInjury() {
                this.$modal.hide('injury_modal');
                this.clearInjuryForm();
                },
            saveInjury() {

                axios.post('/api/save-injury', {
                    'employer_id': this.id,
                    'illness': this.injury_illness,
                    'medical_name': this.injury_medical_name,
                    'hospital_name': this.injury_hospital_name,
                    'start_date': this.injury_start_date,
                    'recovery_date': this.injury_recovery_date,
                    'hospital_type': this.injury_hospital_type,
                    'expenses_won': this.injury_expenses_won,
                    'expenses_won_currency':this.injury_expenses_won_currency,
                    'expenses_ex': this.injury_expenses_ex,
                    'expenses_ex_currency': this.injury_expenses_ex_currency,
                    'remark': this.injury_remark,
                    'injury_id': this.injury_id
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                this.hideInjury();
                $(document).find('span[class="validate-message"]').remove();
                this.showInjury();
                this.injury_id = null;
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
            clearInjuryForm(){
                    this.injury_start_date = moment(new Date()).format('DD-MM-YYYY');
                    this.injury_recovery_date = moment(new Date()).format('DD-MM-YYYY');
                    this.injury_illness = '',
                    this.injury_medical_name = '',
                    this.injury_hospital_name = '',
                    this.injury_hospital_type = 'Public',
                    this.injury_expenses_won = '',
                    this.injury_expenses_won_currency='MMK',
                    this.injury_expenses_ex = '',
                    this.injury_expenses_ex_currency = 'MMK',
                    this.injury_remark = ''
            },
            editInjury(item){
                        this.$modal.show('injury_modal');
                        this.injury_start_date = item.start_date,
                        this.injury_recovery_date = item.recovery_date,
                        this.injury_illness = item.illness,
                        this.injury_medical_name = item.medical_name,
                        this.injury_hospital_name = item.hospital_name,
                        this.injury_hospital_type =item.hospital_type,
                        this.injury_expenses_won = item.expenses_won,
                        this.injury_expenses_won_currency=item.expenses_won_currency,
                        this.injury_expenses_ex = item.expenses_ex,
                        this.injury_expenses_ex_currency = item.expenses_ex_currency,
                        this.injury_remark = item.remark
            },

            deleteInjury(member) {
                    const vm = this;
                    return Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete " + member.type,
                        icon: 'warning',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete'
                    }).then((result) => {
                        if(result.isConfirmed) {
                            axios.post('/api/delete-injury', {
                                id: member.id,
                                employer_id: this.id
                            }, {
                                headers: {'Authorization': 'Bearer '+ this.user_token}
                            }).then(response => {
                                vm.showInjury();
                            })
                        }
                    });
            },
            //evaluation
            showEvaluation() {
                    axios.post('/api/get-all-evaluation', {
                        employer_id: this.id
                    }, {
                        headers:{'Authorization': 'Bearer '+ this.user_token}
                    }).then(result => {

                        this.evaluations = result.data.evaluations;
                    });
            },
            addEvaluation(){
            this.$modal.show('crew_evaluate_modal');
            },

            hideEvaluation() {
                    this.$modal.hide('crew_evaluate_modal');
                    this.clearEvaluation();
            },

            saveCrewEvaluate() {

                axios.post('/api/save-crew-evaluation', {
                    'employer_id': this.id,
                    'date': this.crew_date,
                    'score': this.crew_score,
                    're_use': this.crew_re_use,
                    'rate': this.crew_rate,
                    'detail': this.crew_detail,
                    'evaluation_id': this.crew_evaluation_id
                }, {
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(result => {
                this.hideEvaluation();
                $(document).find('span[class="validate-message"]').remove();
                this.showEvaluation();
                this.crew_evaluation_id = null;
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
            clearEvaluation(){
                this.crew_date = moment(new Date()).format('DD-MM-YYYY');
                this.crew_score = '',
                this.crew_re_use = '',
                this.crew_rate = '',
                this.crew_detail = ''
            },

            reloadTable(tableProps){
            this.tableProps = tableProps;
                this.getData(tableProps);
            },
            editEvaluation(item){
                this.$modal.show('crew_evaluate_modal');
                this.crew_date = moment(item.date).format('DD-MM-YYYY');
                this.crew_score = item.score;
                this.crew_re_use = item.re_use;
                this.crew_rate = item.rate;
                this.crew_detail = item.detail;
                this.employerId = item.user_id;
                this.crew_evaluation_id = item.id;
            },

            // Delete Family Members
            deleteEvaluation(member) {
                const vm = this;
                return Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete " + member.type,
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/api/delete-crew-evaluation', {
                            id: member.id,
                            employer_id: this.id
                        }, {
                            headers: {'Authorization': 'Bearer '+ this.user_token}
                        }).then(response => {
                            vm.showEvaluation();
                        })
                    }
                });
            },

            // =================== View Image ========================
            viewimages() {
                let self = this;
                self.loading = true;
                axios.post('/api/get-all-images', {
                    'employer_id': this.id
                },{
                    headers: {'Authorization': 'Bearer '+ this.user_token}
                }).then(response => {
                    self.view_certificate_images = [];
                    $.each(response.data.images, function(index, value) {
                        const obj = {
                            'name': value.certificate.title,
                            'images': JSON.parse(value.image)
                        };

                        self.view_certificate_images.push(obj);
                    })
                })
            }
        }
    }
</script>
