<!-- ======================== DMA ============================= -->
<template>
	<div>
		<div class="form-group row">
			<div class="col-md-12">
				<div class="image-holder" v-show="dmaimg.length == 0">
					<div class="loading-area-one" v-show="showLoading">
						<img src="../../../../public/loading/loading.gif" alt="">
					</div>
					<label for="all-images" class="medicalcheckup" @dragover.prevent @drop="onDropPassport">
						<i class="wizard-icon ti-cloud-up icon-image-upload" v-show="!showLoading"></i>
						<span class="image-lable-text" v-show="!showLoading">Choose File or drag & drop here</span>
					</label>
				</div>
				<div class="grid-container" @dragover.prevent @drop="onDropPassport" v-show="dmaing.length >= 1">
					<div class="loading-area" v-show="showLoading">
						<img src="../../../../public/loading/loading.gif" alt="">
					</div>
					<div class="gird-item-image " :key="index" v-for="(image, index) in imageAllInOne">
						<img :src="image.img" alt="image" class="images-img img-thumbnail" v-if="image.ext != 'pdf'">
						<img src="../../../../public/pdf/pdfimage.png" class="images-img img-thumbnail"  v-else/>
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

			<div class="form-group col-md-6">
				<label for="remark">Remark</label>
				<textarea name="remark" id="remark" cols="30" rows="10" v-model.trim="remark" class="form-control"></textarea>
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
				max_length: 10
			}
		}
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
