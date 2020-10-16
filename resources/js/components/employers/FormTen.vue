<!-- ==================== All In One ===================== -->
<!-- Image 27 -->
<template>
	<div>
		<div class="form-row">
			<div class="form-group col-md-12">
					<label for="coc">C.O.C</label>
			<input type="text" name="coc" id="coc" v-model="coc" class="form-control">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			<label for="gmbss">GMBSS</label>
			<input type="text" name="gmbss" id="gmbss" v-model="gmbss" class="form-control">
			</div>
		</div>
		<!-- Image Container -->
		<div class="form-group">
			<div class="image-holder" v-show="all_images.length == 0">
				<div class="loading-area-one" v-show="showLoading">
					<img src="../../../../public/loading/loading.gif" alt="">
				</div>
				<label for="all-in-one" class="medicalcheckup" @dragover.prevent @drop="onDrop">
					<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
					<span class="image-lable-text" v-show="!showLoading">Choose File or drag & drop here</span>
				</label>
			</div>

			<div class="grid-container" @dragover.prevent @drop="onDrop" v-show="all_images.length >= 1">
				<div class="loading-area" v-show="showLoading">
					<img src="../../../../public/loading/loading.gif" alt="">
				</div>
				<div class="gird-item-image " :key="index" v-for="(image, index) in all_images">
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
					<label for="all-in-one" class="medicalcheckup" @dragover.prevent @drop="onDrop">
						<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
						<span class="image-lable-text">Choose File or drag & drop here</span>
					</label>
				</div>
			</div>
		</div>
		<input type="file" multiple draggable="true" id="all-in-one" @change="uploadPassportFile" accept="image/*, .pdf">
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
				coc: '',
				gmbss: '',
				all_in_one_id: null,
				user_token: `${process.env.MIX_APP_TOKEN}`,
				all_images: [],
				showLoading: false,
				fileMaxLenght: 15,
				fileLoopCount: 0,
			}
		},
		methods: {
			async validate() {
				var isValid;
				await axios.post('/api/save-all-in-one', {
					"coc": this.coc,
					"gmbss": this.gmbss,
					"all_images": this.all_images,
					'all_in_one_id': this.all_in_one_id,
					'employer_id': this.employerId
				}, {
					headers: {'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.all_in_one_id = result.data.all_in_one;
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

				// return isValid;
				Swal.fire({
	                title: 'Woo!',
	                text: "Successfully Complete!",
	                icon: 'success',
	                allowOutsideClick: false,
	            });
			},
			uploadPassportFile(e) {
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createImages(files)
			},

			createImages(files) {
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

			onDrop: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createImages(files)
			},

			deletePassportImage(index) {
				axios.post('/api/image-delete', {
					'image': this.all_images[index],
				}).then(res => {
					this.all_images.splice(index, 1);
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
		},
		props: ['employerId']
	}
</script>