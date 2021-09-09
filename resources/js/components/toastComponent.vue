


<template>
<div>

	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10000">
		<div id="toastCustom" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">

			<div
			:class="bgHeader"
			class="toast-header bg-gradient text-white mx-auto">
					<!-- <i class="bi bi-exclamation-square-fill"></i> -->
					<i :class="iconContext" class="me-2" style="font-size: 1.5rem;"></i>

					<strong class="me-auto mt-1">Aviso</strong>

					<button  v-on:click="close();"
					type="button" class="btn-close" aria-label="Close"></button>
				</div><!-- .toast-header -->
				<div :class="textContext" class="toast-body bg-light tex-success">
					{{ config.message }}
			 </div><!-- .toast-body -->
		</div><!-- #toastCustom -->
	</div><!-- .position-fixed -->

</div>
</template>

<script>
export default {
    name: 'toastDialog',

		props: [
			'config'
			// 'type',
			// 'message',
			// 'visible',
		],

    data(){
			return {
				toast: null,
				// message: null,
				// type: null,

				bgHeader: "bg-primary",
				// classContext: 'bg-primary',

				textContext: 'text-muted',
				iconContext: 'bi bi-bell-fill', // campanita
			}
    },

    methods: {
			/*open(config = {}) {
				this.message = config.message
				this.classContext = ( config.type != null )?( (config.type=='success')?'bg-success': ((config.type=='error')?'bg-danger':this.classContext) ) : this.classContext;
				this.iconContext = ( config.type != null )?( (config.type=='success')?'bi bi-bookmark-check-fill': ((config.type=='error')?'bi bi-bookmark-x-fill':this.iconContext) ) : this.iconContext;
				this.textContext = ( config.type != null )?( (config.type=='success')?'text-success': ((config.type=='error')?'text-danger':this.textContext) ) : this.textContext;

				this.toast.show();
			},*/
			/*
			open(config = {}) {
				console.info("this.type: "+this.type);
				console.info("this.message: "+this.message);

				this.bgHeader = ( this.type != null )?( (this.type=='success')?'bg-success': ((this.type=='error')?'bg-danger':this.bgHeader) ) : this.bgHeader;

				this.iconContext = ( this.type != null )?( (this.type=='success')?'bi bi-bookmark-check-fill': ((this.type=='error')?'bi bi-bookmark-x-fill':this.iconContext) ) : this.iconContext;

				this.toast.show();
			},*/
			open(config = {}) {
				console.info("this.config.type: "+this.config.type);
				console.info("this.config.message: "+this.config.message);

				this.bgHeader = ( this.config.type != null )?( (this.config.type=='success')?'bg-success': ((this.config.type=='error')?'bg-danger':this.bgHeader) ) : this.bgHeader;

				this.iconContext = ( this.config.type != null )?( (this.config.type=='success')?'bi bi-bookmark-check-fill': ((this.config.type=='error')?'bi bi-bookmark-x-fill':this.iconContext) ) : this.iconContext;

				this.toast.show();
			},

			close() {
					this.toast.hide();
			},
    },

		mounted(){
			let options = {
				animation: true,
				autohide: false,
				delay: 5000
			};

			this.toast = new bootstrap.Toast(document.getElementById("toastCustom"), options);
		}
}
</script>

<style>
</style>
