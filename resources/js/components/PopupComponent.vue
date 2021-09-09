<!-- components/PopupModal.vue -->
<template>
	<!-- Modal, 'modal-content' sólo si no es modalSpinner y class 'fade' sólo si no es modalSpinner-->
	<div class="modal"
	:class="idModal!='modalSpinner' ? 'fade' : ''"
	 v-bind:id="idModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" v-if="(idModal!='modalSpinner')">
				<div
				:class="bgClass"
				class="modal-header text-white">
					<!-- <h5 class="modal-title" id="exampleModalLabel"> -->
						<slot name="modalHeader"></slot>
					<!-- </h5> -->
				</div>
				<div class="modal-body">
					<slot name="modalBody"></slot>
				</div>
				<!-- <div class="modal-footer justify-content-center"> -->
				<div class="modal-footer">
					<slot name="modalFooter"></slot>
				</div><!-- .modal-footer -->
			</div><!-- .modal-content -->
		</div><!-- .modal-dialog -->
	</div><!-- .modal -->
</template>

<script>
export default {
    name: 'PopupComponent',

		props: [
			'idModal',
			],

    data: () => ({
				modal: null,
				bgClass: 'bg-info',
    }),

    methods: {
        open(opts = {}) {
					// console.info("open " + this.idModal);
					this.bgClass = (!!opts.contextClass)?opts.contextClass:this.bgClass;
					this.modal = new bootstrap.Modal(document.getElementById(this.idModal), { 'backdrop': 'static', 'keyboard':false});
					this.modal.show();
        },

        close() {
					// console.info("close " + this.idModal);
					this.modal.hide();
        },
    },
		mounted() {
		},
}
</script>

<style scoped>
</style>
