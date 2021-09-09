<template>
	<div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 mb-2">
				<div class="form-group ">
					<label for="">Nombre</label>
					<input v-model="planestudio.nombre"
					type="text" class="form-control">
				</div><!-- .form-group -->
			</div><!-- .col -->

			<div class="col-12 col-sm-12 col-md-offset-3 col-lg-2 mb-2 d-flex">
				<button v-on:click="toList()" type="button" name="button" class="btn btn-info w-100 text-white mt-auto">
					Buscar
				</button>
			</div><!-- .col -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-12 col-sm-12 col-md-10 col-lg-10 mb-2">
				<div class="form-group ">
					<label for="">Nombre Corto</label>
					<input v-model="planestudio.nombre_corto"
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
		v-bind:datagrid="planestudios"
		v-bind:endPoint="myendPoint"
		>
	</grid-pagination-component>

	<popup-component ref="modalPlanestudio" :idModal="idModal">
		<template slot="modalHeader">
			<h5 class="modal-title"> {{ tituloModal }} </h5>
		</template>
		<template slot="modalBody">
			<form id="formSucursales">
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="itxt_planestudio_nombre">Nombre</label>
							<input v-model="planestudio.nombre"
							v-bind:class="{ 'is-invalid': ($v.planestudio.nombre.$error), 'is-valid': (!$v.planestudio.nombre.$error && $v.planestudio.nombre.$dirty)  }"
							id="itxt_planestudio_nombre" name="itxt_planestudio_nombre" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.nombre.required" class="invalid-feedback">Ingrese el nombre del plan de estudio</div>

							<label for="itxt_planestudio_nombre_corto">Nombre Corto</label>
							<input v-model="planestudio.nombre_corto"
							v-bind:class="{ 'is-invalid': ($v.planestudio.nombre_corto.$error), 'is-valid': (!$v.planestudio.nombre_corto.$error && $v.planestudio.nombre_corto.$dirty)  }"
							id="itxt_planestudio_nombre_corto" name="itxt_planestudio_nombre_corto" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.nombre_corto.required" class="invalid-feedback">Ingrese el nombre corto del plan de estudio</div>

							<label for="itxt_planestudio_estatus">Estatus</label>
							<input v-model="planestudio.estatus"
							v-bind:class="{ 'is-invalid': ($v.planestudio.estatus.$error), 'is-valid': (!$v.planestudio.estatus.$error && $v.planestudio.estatus.$dirty)  }"
							id="itxt_planestudio_estatus" name="itxt_planestudio_estatus" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.estatus.required" class="invalid-feedback">Ingrese el estatus del plan de estudio</div>

							<label for="itxt_planestudio_num_creditos_total">Numero de creditos totales</label>
							<input v-model="planestudio.num_creditos_total"
							v-bind:class="{ 'is-invalid': ($v.planestudio.num_creditos_total.$error), 'is-valid': (!$v.planestudio.num_creditos_total.$error && $v.planestudio.num_creditos_total.$dirty)  }"
							id="itxt_planestudio_num_creditos_total" name="itxt_planestudio_num_creditos_total" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.num_creditos_total.required" class="invalid-feedback">Ingrese el numero de creditos totales</div>

							<label for="itxt_planestudio_num_creditos_min">Numero de creditos mínimos</label>
							<input v-model="planestudio.num_creditos_min"
							v-bind:class="{ 'is-invalid': ($v.planestudio.num_creditos_min.$error), 'is-valid': (!$v.planestudio.num_creditos_min.$error && $v.planestudio.num_creditos_min.$dirty)  }"
							id="itxt_planestudio_num_creditos_min" name="itxt_planestudio_num_creditos_min" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.num_creditos_min.required" class="invalid-feedback">Ingrese el numero de creditos mínimos</div>

							<label for="itxt_planestudio_num_creditos_max">Numero de creditos máximos</label>
							<input v-model="planestudio.num_creditos_max"
							v-bind:class="{ 'is-invalid': ($v.planestudio.num_creditos_max.$error), 'is-valid': (!$v.planestudio.num_creditos_max.$error && $v.planestudio.num_creditos_max.$dirty)  }"
							id="itxt_planestudio_num_creditos_max" name="itxt_planestudio_num_creditos_max" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.num_creditos_max.required" class="invalid-feedback">Ingrese el numero de creditos máximos</div>

							<label for="itxt_planestudio_fcreacion">Fecha de Creación</label>
							<input v-model="planestudio.fcreacion"
							v-bind:class="{ 'is-invalid': ($v.planestudio.fcreacion.$error), 'is-valid': (!$v.planestudio.fcreacion.$error && $v.planestudio.fcreacion.$dirty)  }"
							id="itxt_planestudio_fcreacion" name="itxt_planestudio_fcreacion" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.fcreacion.required" class="invalid-feedback">Ingrese la fecha de creacion del plan de estudio</div>

							<label for="itxt_planestudio_fmodificacion">Fecha de Modificación</label>
							<input v-model="planestudio.fmodificacion"
							v-bind:class="{ 'is-invalid': ($v.planestudio.fmodificacion.$error), 'is-valid': (!$v.planestudio.fmodificacion.$error && $v.planestudio.fmodificacion.$dirty)  }"
							id="itxt_planestudio_fmodificacion" name="itxt_planestudio_fmodificacion" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.fmodificacion.required" class="invalid-feedback">Ingrese la fecha de modificacion del plan de estudio</div>

							<label for="itxt_planestudio_idcarrera">ID de carrera</label>
							<input v-model="planestudio.idcarrera"
							v-bind:class="{ 'is-invalid': ($v.planestudio.idcarrera.$error), 'is-valid': (!$v.planestudio.idcarrera.$error && $v.planestudio.idcarrera.$dirty)  }"
							id="itxt_planestudio_idcarrera" name="itxt_planestudio_idcarrera" type="text"
							class="form-control"
							>
							<div v-if="!$v.planestudio.idcarrera.required" class="invalid-feedback">Ingrese el id de la carrera que pertenece al plan de estudio</div>

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
		'planestudios',
		'total'
	],

	data(){
		return {
			planestudio: {
				id: 0,
				nombre: "",
			},

			myendPoint: "planestudio",

			columns_grid: {
				'id': {
					'type': 'text',
					'header': 'ID',
					'width': '10%'
				},
				'nombre': {
					'type': 'text',
					'header': 'NOMBRE',
					'width': '10%'
				},
				'nombre_corto':{
					'type': 'text',
					'header': 'NOMBRE CORTO',
					'width': '10%'
				},
				'estatus':{
					'type': 'text',
					'header': 'ESTATUS',
					'width': '5%'
				},
				'num_creditos_total':{
					'type': 'text',
					'header': 'NUM CRED TOTALES',
					'width': '5%'
				},
				'num_creditos_min':{
					'type': 'text',
					'header': 'NUM CRED MIN',
					'width': '5%'
				},
				'num_creditos_max':{
					'type': 'text',
					'header': 'NUM CRED MAX',
					'width': '5%'
				},
				'fcreacion':{
					'type': 'text',
					'header': 'FECHA DE CREACION',
					'width': '10%'
				},
				'fmodificacion':{
					'type': 'text',
					'header': 'FECHA DE MODIFICACION',
					'width': '10%'
				},
				'idcarrera':{
					'type': 'text',
					'header': 'ID DE MODALIDAD',
					'width': '5%'
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

				idModal: "modalPlanestudio",
				tituloModal: '',

				configToast:{
					type: "",
					message: ""
				},

			}

		},

		validations: {
			planestudio: {
				nombre: { required },
				nombre_corto: { required },
				estatus: { required },
				num_creditos_total: { required },
				num_creditos_min: { required },
				num_creditos_max: { required },
				fcreacion: { required },
				fmodificacion: { required },
				idcarrera: { required }
			}
		},



		methods: {
			showForm( data={} ) {
				console.info("showForm() -> data: ");
				console.info(data);
				// this.sucursal.id = ( data.id === undefined )?0:data.id;
				// alert(typeof data.id);
				this.planestudio.id = (data.id === undefined)?0:data.id;

				if(this.planestudio.id > 0){
					this.planestudio.id = data.id;
					this.tituloModal = "Editar";
					this.planestudio.nombre = data.nombre;
				}else if (this.planestudio.id == 0) {
					this.planestudio.id = 0;
					this.tituloModal = "Agregar";
				}

				this.$refs.modalPlanestudio.open({contextClass:'bg-primary'});
			},

			validateForm() {
				this.$v.planestudio.$touch();
				if(this.$v.planestudio.$invalid){
					this.configToast.type = "error";
					this.configToast.message = "Atienda las indicaciones";

					this.$refs.toastDialog.open();
					return;
				}
			},

			resetFields() {
				this.planestudio.id = 0;
				this.planestudio.nombre = "";
				this.planestudio.nombre_corto = "";
				this.planestudio.estatus = "";
				this.planestudio.num_creditos_total = "";
				this.planestudio.num_creditos_min = "";
				this.planestudio.num_creditos_max = "";
				this.planestudio.fcreacion = "";
				this.planestudio.fmodificacion = "";
				this.planestudio.idcarrera = "";
			},

			hideForm() {
				console.info("hideForm()");
				this.$v.planestudio.$reset();
				this.resetFields();
				this.$refs.toastDialog.close();
				this.$refs.modalPlanestudio.close();
			},

			doSave() {
				this.validateForm();
				if( !this.$v.planestudio.$invalid ){
					if(this.planestudio.id > 0){
						this.doUpdate();
					}else if (this.planestudio.id == 0) {
						this.doCreate();
					}
				}
			},

			doCreate() {
				let me = this;
				let url = appURL + 'planestudios';

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.post(url, this.planestudio)
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
					this.planestudio.id = data.id;
					this.planestudio.nombre = data.nombre;
					this.planestudio.nombre_corto = data.nombre_corto;
					this.planestudio.estatus = data.estatus;
					this.planestudio.num_creditos_total = data.num_creditos_total;
					this.planestudio.num_creditos_min = data.num_creditos_min;
					this.planestudio.num_creditos_max = data.num_creditos_max;
					this.planestudio.fcreacion = data.fcreacion;
					this.planestudio.fmodificacion = data.fmodificacion;
					this.planestudio.idcarrera = data.idcarrera;

					this.showForm(this.planestudio);
				}else if (action=='delete') {
					this.configToast.type = "info";
					this.configToast.message = "Eliminación pendiente, es necesario desarrollar módulos con FK de carrera";
					this.$refs.toastDialog.open();
				}
			},

			doUpdate() {
				let me = this;
				let url = appURL + 'planestudios/'+this.planestudio.id;

				let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;

				axios.put(url, this.planestudio).
				then(async (response) => {
					if(!response.data.result){
						me.configToast.type = "error";
						me.configToast.message = response.data.message;
					}else{
						me.configToast.type = "success";
						me.configToast.message = "Carrera editada correctamente";
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
