<!--========================= CTC ========================-->
<!-- image 20 -->
<template>
	<div>
		<div class="form-group">
			<label for="cbn">Ceman Book No</label>
			<input type="text" name="cbn" id="cbn" v-model="cbn" class="form-control">
		</div>
		<!-- Image Container -->
		<div class="form-group">
			<div class="image-holder" v-show="cbn_images.length == 0">
				<div class="loading-area-one" v-show="showLoading">
					<img src="../../../../public/loading/loading.gif" alt="">
				</div>
				<label for="medical-checkup" class="medicalcheckup" @dragover.prevent @drop="onDrop">
					<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
					<span class="image-lable-text" v-show="!showLoading">Choose File or drag & drop here</span>
				</label>
			</div>

			<div class="grid-container" @dragover.prevent @drop="onDrop" v-show="cbn_images.length >= 1">
				<div class="loading-area" v-show="showLoading">
					<img src="../../../../public/loading/loading.gif" alt="">
				</div>
				<div class="gird-item-image " :key="index" v-for="(image, index) in cbn_images">
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
						<span class="image-lable-text">Choose File or drag & drop here</span>
					</label>
				</div>
			</div>
		</div>
		<input type="file" multiple draggable="true" id="medical-checkup" @change="uploadFile" accept="image/*, .pdf">
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
	export default {
		data() {
			return {
				cbn: '',
				cbn_id: null,
				user_token: `${process.env.MIX_APP_TOKEN}`,
				cbn_images: [],
				showLoading: false,
				fileMaxLenght: 20,
				fileLoopCount: 0,
			}
		},
		methods: {
			async validate() {
				var isValid;
				await axios.post('/api/save-cbn', {
					"cbn": this.cbn,
					"cbn_images": this.cbn_images,
					'cbn_id': this.cbn_id,
					'employer_id': this.employerId
				}, {
					headers: {'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.cbn_id = result.data.cbn;
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
					'image': this.cbn_images[index],
				}).then(res => {
					this.cbn_images.splice(index, 1);
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
		},
		props: ['employerId']
	}
</script>