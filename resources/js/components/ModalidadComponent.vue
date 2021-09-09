<template>
	<div>

		<div class="row">
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 mb-2">
				<div class="form-group ">
					<label for="">Nombre</label>
					<input v-model="modalidadSearch.nombre"
					type="text" class="form-control">
				</div><!-- .form-group -->
			</div><!-- .col -->

			<div class="col-12 col-sm-12 col-md-offset-3 col-lg-2 mb-2 d-flex">
				<button v-on:click="toList()" type="button" name="button" class="btn btn-info w-100 text-white mt-auto">
					Buscar
				</button>
			</div><!-- .col -->
		</div><!-- .row -->

		<div class="row justify-content-md-end">
			<div class="col-12 col-sm-12 col-md-offset-3 col-lg-2 mb-2">
				<button v-on:click="showForm({})" type="button" name="button" class="btn btn-primary w-100 text-white">
					Agregar
				</button>
			</div><!-- .col -->
		</div><!-- .row -->

		<grid-pagination-component ref="myGrid"  @actionGrid="actionGrid"
		v-bind:columns="columns_grid"
		v-bind:total_datos="todaOk"
		v-bind:datagrid="modalidades"
		v-bind:endPoint="myendPoint"
		v-bind:search="modalidadSearch"
		>
	</grid-pagination-component>

	<popup-component ref="modalModalidad" :idModal="idModal">
		<template slot="modalHeader">
			<h5 class="modal-title"> {{ tituloModal }} </h5>
		</template>
		<template slot="modalBody">
			<form id="formSucursales">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="itxt_modalidad_nombre">Nombre</label>
							<input v-model="modalidad.nombre"
							v-bind:class="{ 'is-invalid': ($v.modalidad.nombre.$error), 'is-valid': (!$v.modalidad.nombre.$error && $v.modalidad.nombre.$dirty)  }"
							id="itxt_modalidad_nombre" name="itxt_modalidad_nombre" type="text"
							class="form-control"
							>
							<div v-if="!$v.modalidad.nombre.required" class="invalid-feedback">Ingrese</div>
						</div><!-- .form-group -->
					</div><!-- .col -->
				</div><!-- .row -->
			</form>
		</template>
		<template slot="modalFooter">
			<button @click="hideForm()" type="button" class="btn btn-secondary">Cancelar</button>
			<button v-on:click="doSave()" type="button" class="btn btn-primary">Guardar</button>
		</template>
	</popup-component>

	<toast-component ref="toastDialog" v-bind:config="configToast" />
</div><!-- -->
</template>



<script>
import PopupComponent from './PopupComponent.vue'
import { required, email, minLength } from "vuelidate/lib/validators";

export default {

	components: { PopupComponent },

	props: [
		'modalidades',
		'total'
	],

	data(){
		return {
			modalidad: {
				id: 0,
				nombre: "",
			},

			modalidadSearch: {
				nombre: ""
			},

			myendPoint: "modalidades",

			columns_grid: {
				'id': {
					'type': 'text',
					'header': 'ID',
					'width': '10%'
				},
				'nombre': {
					'type': 'text',
					'header': 'NOMBRE',
					'width': '80%'
				},
				'edit': {
					'type': 'button',
					'header': 'EDITAR',
					'width': '5%',
					'config':{
						'action': 'edit',
						'text': '<i class="bi bi-pencil-fill"></i>',
						'class': 'btn btn-sm btn-secondary'}
					},
					'eliminar': {
						'type': 'button',
						'header': 'ELIMINAR',
						'width': '5%',
						'config': {
							'action': 'delete',
							'text': '<i class="bi bi-trash-fill"></i>',
							'class':'btn btn-sm btn-danger'
						}
					}
				},
				data_grid:null,

				idModal: "modalModalidad",
				tituloModal: '',

				configToast:{
					type: "",
					message: ""
				},

				todaOk: this.total,
			}

		},

		validations: {
			modalidad: {
				nombre: { required },
			}
		},

		methods: {
			showForm( data={} ) {
				this.modalidad.id = (data.id === undefined)?0:data.id;

				if(this.modalidad.id > 0){
					this.modalidad.id = data.id;
					this.tituloModal = "Editar";
					this.modalidad.nombre = data.nombre;
				}else if (this.modalidad.id == 0) {
					this.modalidad.id = 0;
					this.tituloModal = "Agregar";
				}

				this.$refs.modalModalidad.open({contextClass:'bg-primary'});
			},

			validateForm() {
				this.$v.modalidad.$touch();
				if(this.$v.modalidad.$invalid){
					this.configToast.type = "error";
					this.configToast.message = "Atienda las indicaciones";

					this.$refs.toastDialog.open();
					return;
				}
			},

			resetFields() {
				this.modalidad.id = 0;
				this.modalidad.nombre = "";
			},

			hideForm() {
				this.$v.modalidad.$reset();
				this.resetFields();
				this.$refs.toastDialog.close();
				this.$refs.modalModalidad.close();
			},

			doSave() {
				this.validateForm();
				if( !this.$v.modalidad.$invalid ){
					if(this.modalidad.id > 0){
						this.doUpdate();
					}else if (this.modalidad.id == 0) {
						this.doCreate();
					}
				}
			},

			doCreate() {
				let me = this;
				let url = appURL + 'modalidades';

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.post(url, this.modalidad)
				.then( (response) => {
					if(!response.data.result){
						me.configToast.type = "error";
						me.configToast.message = response.data.message;
						// me.$refs.toastDialog.open();
					}else{
						me.configToast.type = "success";
						me.configToast.message = "Modalidad agregada correctamente";

						me.todaOk ++; // update value with + 1, for re-reder grid pagination

						me.hideForm();
						me.toList();
					}
				})
				.catch( (error) => {
					if(error.response.status == 422){ // catch validation error Laravel API
						me.configToast.type = "error";
						me.configToast.message = error.response.data.errors.nombre[0];
					}
				})
				.finally( () => {
					me.$refs.toastDialog.open();
				});
			},

			actionGrid(action, data){
				if(action=='edit'){
					this.modalidad.id = data.id;
					this.modalidad.nombre = data.nombre;

					this.showForm(this.modalidad);
				}else if (action=='delete') {
					this.configToast.type = "info";
					this.configToast.message = "Eliminación pendiente, es necesario desarrollar módulos con FK de modalidad";
					this.$refs.toastDialog.open();
				}
			},

			doUpdate() {
				let me = this;
				let url = appURL + 'modalidades/'+this.modalidad.id;

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.put(url, this.modalidad).
				then(async (response) => {
					if(!response.data.result){
						me.configToast.type = "error";
						me.configToast.message = response.data.message;
					}else{
						me.configToast.type = "success";
						me.configToast.message = "Modalidad editada correctamente";
						me.hideForm();
						me.toList();
					}
				})
				.catch(function (error) {
					if(error.response.status == 422){ // catch validation error Laravel API
						me.configToast.type = "error";
						me.configToast.message = error.response.data.errors.nombre[0];
					}
				})
				.finally(() => {
					me.$refs.toastDialog.open();
				});
			},

			toList() {
				// console.info("this.modalidadSearch");
				// console.info( JSON.stringify(this.modalidadSearch) );

				this.$refs.myGrid.getPagination(0, JSON.stringify(this.modalidadSearch));
			},

			confirmDelete(responseConfirm) {
			},

		},

		created() {
		},

		mounted(){
		},

		watch: {
		},


	}

	</script>

	<style>
	</style>
