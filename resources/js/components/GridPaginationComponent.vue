<template>

	<div>

		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">

				<div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead class="table-secondary">
							<tr>
								<th v-for="column in columns"
								:class="(column.type === 'hidden')?'d-none' : ''"
								:style="{width:column.width}"
								>
								{{ column.header}}
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="datag in dataGridFinally">
							<td v-for="(column, key) in columns"
							:class="(column.type === 'hidden')?'d-none' : ''">
							<span v-if="column.type === 'text'">{{ datag[key] }}</span>
							<button v-if="column.type === 'button'" type="button" name="button"
							@click="setToParentAction(column.config.action, datag)"
							:class="column.config.class"
							v-html="column.config.text">
							<!-- <span></span> -->
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div><!-- .table-responsive -->

	<nav>
		<ul class='pagination justify-content-center'>
			<li class='page-item' v-if="actual_pag>1">
				<button @click="getPagination(0)" class='page-link'>
					<i class="bi bi-chevron-double-left"></i>
				</button>
			</li>
			<li class='page-item disabled' v-else>
				<button class='page-link'>
					<i class="bi bi-chevron-double-left"></i>
				</button>
			</li>
			<li class='page-item' v-if="actual_pag>1">
				<button @click="getPagination((actual_pag-2)*limit)" class='page-link'>
					<span aria-hidden='true'><i class='bi bi-chevron-left'></i>
					</span>
				</button>
			</li>
			<li class='page-item disabled' v-else>
				<button class='page-link'>
					<i class='bi bi-chevron-left'></i>
				</button>
			</li>
			<!-- start for pages -->
			<li class='page-item'
			:class="(page==actual_pag)?'active':'' "
			v-for="page in pages">
			<button v-if="page == actual_pag" class='page-link disabled'>{{ page }}</button>
			<button v-else @click="getPagination((page-1)*limit)" class='page-link disabled'>{{ page }}</button>
		</li>
		<!-- End for pages -->
		<li class='page-item' v-if="actual_pag<totalPag">
			<button @click="getPagination(actual_pag*limit)" class='page-link'>
				<i class='bi bi-chevron-right' aria-hidden='true'></i>
			</button>
		</li>
		<li class='page-item disabled' v-else>
			<button class='page-link'>
				<i class='bi bi-chevron-right' aria-hidden='true'></i>
			</button>
		</li>
		<li class='page-item' v-if="actual_pag<totalPag">
			<button @click="getPagination((totalPag-1)*limit)" class='page-link'>
				<i class="bi bi-chevron-double-right"></i>
			</button>
		</li>
		<li class='page-item disabled' v-else>
			<a class='page-link'>
				<i class="bi bi-chevron-double-right"></i>
			</a>
		</li>

	</ul>
</nav>

</div><!-- .col -->
</div><!-- .row -->


</div><!--  -->
</template>


<script>

export default {

	components: {},

	props: [
		'endPoint',
		'columns',
		'datagrid',
		'total_datos'
	],

	data(){
		return {
			dataGridFinally: [],

			actual_pag: 1, // calulate
			limit: 10,
			totalDatos: 0,
			totalPag: 0, // calulate
			pagVisibles: 2,
			primera_pag: 0, // calulate
			ultima_pag:  0,  // calulate
			pages: [], // calulate
			offset: 0, // asigned


		}

	},


	methods: {
		calculeValues() {
			this.totalPag = this.total_datos/this.limit;
			this.totalPag = (this.totalPag % 1 == 0)?this.totalPag : Math.ceil(this.totalPag)

			if (this.offset == 0) {
				this.actual_pag = 1;
			} else {
				this.actual_pag = (this.offset + this.limit) / this.limit;
			}

			if(this.actual_pag <= this.pagVisibles){
				this.primera_pag = 1;
			}else{
				this.primera_pag = this.actual_pag - this.pagVisibles;
			}
			if((this.actual_pag + this.pagVisibles) <= this.totalPag){
				this.ultima_pag = this.actual_pag + this.pagVisibles;
			}else{
				this.ultima_pag = this.totalPag;
			}

			this.pages = [];
			for(var i=this.primera_pag; i<=this.ultima_pag; i++){
				this.pages.push(i);
			}
		},

		getPagination(offset){
			this.offset = offset;
			this.actual_pag = this.offset / this.limit;
			let me = this;

			let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

			let url = appURL + this.endPoint+'/'+offset; // Ruta que hemos creado para que nos devuelva las sucursales

			axios.defaults.headers.common['X-CSRF-TOKEN'] = laravelToken;
			axios.get(url)
			.then( (response) => {
				this.dataGridFinally = response.data.modalidades;
				this.totalDatos = response.data.totalData;
			})
			.catch( (error) => { // handle error
				console.log(error);
			})
			.finally( () => {
				// me.$refs.spinnerDialog.close();
			});
		},

		setToParentAction(action, obj){
			this.$emit("actionGrid", action, obj);
		}



	},

	created() {
	},
	mounted(){


		this.dataGridFinally = this.datagrid;
		this.totalDatos = this.total_datos;

		this.calculeValues();
	},
	watch: {
		dataGridFinally: function (newData, oldData) {
			this.calculeValues();
		}
	},


}

</script>

<style>
</style>
