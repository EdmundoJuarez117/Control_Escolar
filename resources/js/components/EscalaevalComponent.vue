<template>
	<div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 mb-2">
				<div class="form-group ">
					<label for="">Nombre</label>
					<input v-model="escalaeval.nombre"
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
		v-bind:total_datos="total"
		v-bind:datagrid="escalaevals"
		v-bind:endPoint="myendPoint"
		>
	</grid-pagination-component>

	<popup-component ref="modalEscalaeval" :idModal="idModal">
		<template slot="modalHeader">
			<h5 class="modal-title"> {{ tituloModal }} </h5>
		</template>
		<template slot="modalBody">
			<form id="formSucursales">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="itxt_escalaeval_nombre">Nombre</label>
							<input v-model="escalaeval.nombre"
							v-bind:class="{ 'is-invalid': ($v.escalaeval.nombre.$error), 'is-valid': (!$v.escalaeval.nombre.$error && $v.escalaeval.nombre.$dirty)  }"
							id="itxt_escalaeval_nombre" name="itxt_escalaeval_nombre" type="text"
							class="form-control"
							>
							<div v-if="!$v.escalaeval.nombre.required" class="invalid-feedback">Ingrese el nombre de la modalidad de carrera</div>

							<label for="itxt_escalaeval_calificacion_min">Calificación mínima</label>
							<input v-model="escalaeval.calificacion_min"
							v-bind:class="{ 'is-invalid': ($v.escalaeval.calificacion_min.$error), 'is-valid': (!$v.escalaeval.calificacion_min.$error && $v.escalaeval.calificacion_min.$dirty)  }"
							id="itxt_escalaeval_calificacion_min" name="itxt_escalaeval_calificacion_min" type="text"
							class="form-control"
							>
							<div v-if="!$v.escalaeval.calificacion_min.required" class="invalid-feedback">Ingrese la calificacion mínima de la modalidad de carrera</div>

							<label for="itxt_escalaeval_calificacion_max">Calificación máxima</label>
							<input v-model="escalaeval.calificacion_max"
							v-bind:class="{ 'is-invalid': ($v.escalaeval.calificacion_max.$error), 'is-valid': (!$v.escalaeval.calificacion_max.$error && $v.escalaeval.calificacion_max.$dirty)  }"
							id="itxt_escalaeval_calificacion_max" name="itxt_escalaeval_calificacion_max" type="text"
							class="form-control"
							>
							<div v-if="!$v.escalaeval.calificacion_max.required" class="invalid-feedback">Ingrese la calificacion máxima de la modalidad de carrera</div>

							<label for="itxt_escalaeval_fcreacion">Fecha de Creación</label>
							<input v-model="escalaeval.fcreacion"
							v-bind:class="{ 'is-invalid': ($v.escalaeval.fcreacion.$error), 'is-valid': (!$v.escalaeval.fcreacion.$error && $v.escalaeval.fcreacion.$dirty)  }"
							id="itxt_escalaeval_fcreacion" name="itxt_escalaeval_fcreacion" type="text"
							class="form-control"
							>
							<div v-if="!$v.escalaeval.fcreacion.required" class="invalid-feedback">Ingrese la fecha de creacion de la carrera</div>

							<label for="itxt_escalaeval_fmodificacion">Fecha de Modificación</label>
							<input v-model="escalaeval.fmodificacion"
							v-bind:class="{ 'is-invalid': ($v.escalaeval.fmodificacion.$error), 'is-valid': (!$v.escalaeval.fmodificacion.$error && $v.escalaeval.fmodificacion.$dirty)  }"
							id="itxt_escalaeval_fmodificacion" name="itxt_escalaeval_fmodificacion" type="text"
							class="form-control"
							>
							<div v-if="!$v.escalaeval.fmodificacion.required" class="invalid-feedback">Ingrese la fecha de modificacion de la carrera</div>
							

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
		'escalaevals',
		'total'
	],

	data(){
		return {
			escalaeval: {
				id: 0,
				nombre: "",
			},

			myendPoint: "escalaeval",

			columns_grid: {
				'id': {
					'type': 'text',
					'header': 'ID',
					'width': '10%'
				},
				'nombre': {
					'type': 'text',
					'header': 'NOMBRE',
					'width': '20%'
				},
				'calificacion_min':{
					'type': 'text',
					'header': 'CALIFICACION MINIMA',
					'width': '15%'
				},
				'calificacion_max':{
					'type': 'text',
					'header': 'CALIFICACION MAXIMA',
					'width': '15%'
				},
				'fcreacion':{
					'type': 'text',
					'header': 'FECHA DE CREACION',
					'width': '15%'
				},
				'fmodificacion':{
					'type': 'text',
					'header': 'FECHA DE MODIFICACION',
					'width': '15%'
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

				idModal: "modalEscalaeval",
				tituloModal: '',

				configToast:{
					type: "",
					message: ""
				},

			}

		},

		validations: {
			escalaeval: {
				nombre: { required },
				calificacion_min: { required },
				calificacion_max: { required },
				fcreacion: { required },
				fmodificacion: { required }
			}
		},



		methods: {
			showForm( data={} ) {
				console.info("showForm() -> data: ");
				console.info(data);
				// this.sucursal.id = ( data.id === undefined )?0:data.id;
				// alert(typeof data.id);
				this.escalaeval.id = (data.id === undefined)?0:data.id;

				if(this.escalaeval.id > 0){
					this.escalaeval.id = data.id;
					this.tituloModal = "Editar";
					this.escalaeval.nombre = data.nombre;
				}else if (this.escalaeval.id == 0) {
					this.escalaeval.id = 0;
					this.tituloModal = "Agregar";
				}

				this.$refs.modalEscalaeval.open({contextClass:'bg-primary'});
			},

			validateForm() {
				this.$v.escalaeval.$touch();
				if(this.$v.escalaeval.$invalid){
					this.configToast.type = "error";
					this.configToast.message = "Atienda las indicaciones";

					this.$refs.toastDialog.open();
					return;
				}
			},

			resetFields() {
				this.escalaeval.id = 0;
				this.escalaeval.nombre = "";
				this.escalaeval.calificacion_min = "";
				this.escalaeval.calificacion_max = "";
				this.escalaeval.fcreacion = "";
				this.escalaeval.fmodificacion = "";
			},

			hideForm() {
				console.info("hideForm()");
				this.$v.escalaeval.$reset();
				this.resetFields();
				this.$refs.toastDialog.close();
				this.$refs.modalEscalaeval.close();
			},

			doSave() {
				this.validateForm();
				if( !this.$v.escalaeval.$invalid ){
					if(this.escalaeval.id > 0){
						this.doUpdate();
					}else if (this.escalaeval.id == 0) {
						this.doCreate();
					}
				}
			},

			doCreate() {
				let me = this;
				let url = appURL + 'escalaevals';

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.post(url, this.escalaeval)
				.then( (response) => {
					if(!response.data.result){
						me.configToast.type = "error";
						me.configToast.message = response.data.message;
						// me.$refs.toastDialog.open();
					}else{
						me.configToast.type = "success";
						me.configToast.message = "Carrera agregada correctamente";
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
					this.escalaeval.id = data.id;
					this.escalaeval.nombre = data.nombre;
					this.escalaeval.calificacion_min = data.calificacion_min;
					this.escalaeval.calificacion_max = data.calificacion_max;
					this.escalaeval.fcreacion = data.fcreacion;
					this.escalaeval.fmodificacion = data.fmodificacion;

					this.showForm(this.escalaeval);
				}else if (action=='delete') {
					this.configToast.type = "info";
					this.configToast.message = "Eliminación pendiente, es necesario desarrollar módulos con FK de carrera";
					this.$refs.toastDialog.open();
				}
			},

			doUpdate() {
				let me = this;
				let url = appURL + 'escalaevals/'+this.escalaeval.id;

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.put(url, this.escalaeval).
				then(async (response) => {
					if(!response.data.result){
						me.configToast.type = "error";
						me.configToast.message = response.data.message;
					}else{
						me.configToast.type = "success";
						me.configToast.message = "Modalidad de Carrera editada correctamente";
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
				this.$refs.myGrid.getPagination(0);
			},

			confirmDelete(responseConfirm) {
			},




		},

		created() {
			console.info("created...");
		},

		mounted(){
		},
		watch: {
		},


	}

	</script>

	<style>
	</style>
