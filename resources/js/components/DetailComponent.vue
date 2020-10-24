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
									<td><a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="show">Edit</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" id="headingThree">
					<h5 class="mb-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						Medical Checkup
					</h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
					<div class="card-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<modal name="family_member" :clickToClose="false" height="auto">
			<div class="modal-content">
				<div class="modal-header">
					<h1>Hello</h1>
				</div>
				<div class="modal-body">
					<button class="btn btn-default" @click="hide">close</button>
				</div>
			</div>
		</modal>
	</div>

</template>

<style lang="scss" scoped>
.card-header {
	h5 {
		cursor: pointer;
	}
}
.wd-70 {
	width: 70%;
}
</style>

<script>
	import moment from 'moment'
	export  default{
		data() {
			return {
				id: '',
				user_token: `${process.env.MIX_APP_TOKEN}`,
				person_detail: {},
				dob: '',
				family_members: {}
			}
		},
		created() {
			var route = window.location.pathname;
			var arr = route.split('/');
			this.id = arr[2];
			this.personDetail();
		},
		methods: {
			personDetail() {
				axios.post('/api/get-person-detail', {
					id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.person_detail = result.data.person_detail;
					this.dob = moment(this.person_detail.date_of_birth).format('DD-MM-YYYY');
				});
			},

			familyMember() {
				axios.post('/api/get-familymember', {
					user_id: this.id
				}, {
					headers:{'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.family_members = result.data.family_members;
				});
			},

			show() {
				this.$modal.show('family_member');
			},

			hide() {
				this.$modal.hide('family_member');
			}
		}
	}
</script>
