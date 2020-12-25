<!-- ======================== DMA ============================= -->
<template>
	<div>
		<div class="form-group row">
			<div class="col-md-12">
				<div class="image-holder" v-show="dmaimg.length == 0">
					<div class="loading-area-one" v-show="loading">
						<img src="../../../../public/loading/loading.gif" alt="">
					</div>
					<label for="dmaimg" class="medicalcheckup" @dragover.prevent @drop="dropdma">
						<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!loading"></i>
						<span class="image-lable-text" v-show="!loading">Choose File or drag & drop here</span>
					</label>
				</div>
				<div class="grid-container" @dragover.prevent @drop="dropdma" v-show="dmaimg.length >= 1">
					<div class="loading-area" v-show="loading">
						<img src="../../../../public/loading/loading.gif" alt="">
					</div>
					<div class="gird-item-image " :key="index" v-for="(image, index) in imageType">
						<img :src="image.img" alt="image" class="images-img img-thumbnail" v-if="image.ext != 'pdf'">
						<img src="../../../../public/pdf/pdfimage.png" class="images-img img-thumbnail"  v-else/>
						<div class="image-overlay" v-if="image.ext != 'pdf'">
							<div class="ed-holder">
								<div class="edit-delete-area">
									<label style="cursor: pointer">
										<input type="file" @change="editdma(index, $event)" class="d-none" accept="image/*, .pdf">
										<i class="wizard-icon ti-pencil icon-holder edit"></i>
									</label>
									<i class="wizard-icon ti-trash icon-holder delete" @click="deldma(index)"></i>
								</div>
							</div>
						</div>

						<div class="image-overlay" v-else>
							<div class="main-ovl">
								<div class="ovly" @click="dmapdfopen(image.img)"></div>
								<div class="dele-ar">
									<label style="cursor: pointer">
										<input type="file" @change="editdma(index, $event)" class="d-none" accept="image/*, .pdf">
										<i class="wizard-icon ti-pencil icon-holder edit"></i>
									</label>
									<i class="wizard-icon ti-trash icon-holder delete" @click="deldma(index, $event)"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="gird-item-image final-grid" v-show="count < max_length">
						<label for="dmaimg" class="medicalcheckup" @dragover.prevent @drop="dropdma">
							<i class="wizard-icon ti-cloud-up icon-image-upload"></i>
							<span class="image-lable-text">Choose File or drag & drop here</span>
						</label>
					</div>
				</div>
				<input type="file" multiple draggable="true" id="dmaimg" @change="uploaddma" accept="image/*, .pdf">
			</div>

		</div>
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
				dmaimg: [],
				count: 0,
				max_length: 10,
				loading: false,
				dma_id: null,
			}
		},
		computed: {
			imageType: function() {
				var mimages = this.dmaimg;
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
			}
		},
		methods: {
			async validate() {
				var isValid;
				await axios.post('/api/save-dma', {
					"all_images": this.dmaimg,
					'employer_id': this.employerId,
					"dma_id": this.dma_id,
				}, {
					headers: {'Authorization': 'Bearer '+ this.user_token}
				}).then(result => {
					this.dma_id = result.data.dma.id;
					isValid = true;
                    $(document).find('span[class="validate-message"]').remove();
                    Swal.fire({
                        title: 'Woo!',
                        text: "Successfully Complete!",
                        icon: 'success',
                        allowOutsideClick: false,
                    }).then(result => {
                        if(result.isConfirmed) {
                            window.location = '/home';
                        }
                    });
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

			dropdma: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.target.files || e.dataTransfer.files;
				this.createDmaImg(files)
			},

			createDmaImg(files) {
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
						if(vm.count < vm.max_length) {
							var reader = new FileReader();
							reader.onload = function(event) {
								const imageUrl = event.target.result;
								vm.loading = true;
								axios.post('/api/image-upload', {
									'image': imageUrl,
									'folder': 'dma/'
								}, {
									headers: {'Authorization': 'Bearer '+ this.user_token}
								}).then((res) => {
									vm.loading = false;
									vm.dmaimg.push(res.data.url);
								});
							}
							reader.readAsDataURL(files[index]);
						} else {
							return false;
						}
						vm.count++;
					}
				}
			},
			uploaddma(e) {
				console.log(e);
				var files = e.target.files || e.dataTransfer.files;
				if (!files.length)
					return;
				this.createDmaImg(files)
			},

			editdma(index, e) {
				e.preventDefault();
				var vm = this;
				var files = e.target.files || e.dataTransfer.files;
				var reader = new FileReader();
				reader.onload = function(event) {
					const imageUrl = event.target.result;
					vm.loading = true;
					axios.post('/api/image-upload-edit', {
						'image': imageUrl,
						'oldImage': vm.dmaimg[index],
						'folder': 'all/'
					}, {
						headers: {'Authorization': 'Bearer '+ this.user_token}
					}).then((res) => {
						vm.loading = false;
						vm.dmaimg.splice(index, 1, res.data.url);
					});
				}
				reader.readAsDataURL(files[0]);
			},

			deldma(index, e) {
				axios.post('/api/image-delete', {
					'image': this.dmaimg[index],
				}).then(res => {
					this.dmaimg.splice(index, 1);
					this.countall--;
				});
				e.stopPropagation();
			},

			dmapdfopen(pdf) {
				window.open(pdf);
			},
		},
		props: ['employerId']
	}
</script>

<style lang="scss" scoped>
.certificate_modal {
	overflow-y: auto;
}
.dele-ar {
	height: 32px;
	width: 100%;
	background: #ffffffb0;
	text-align: center;
	padding-top: 6px;
}
.main-ovl {
	width: 100%;
	height: 100%;
	position: relative;
}
.ovly {
	width: 100%;
	height: 84%;
}
</style>
