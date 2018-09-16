<template>
	<div class="row">
		<!-- load method is defined below -->
		<a href="#" class="btn btn-outline-primary" v-on:click="load">Ver respuestas</a>
		
		<div class="mt-2 col-12" v-for="response in responses">
			<div class="card">
				<div class="card-block p-3">
					{{ response.message }}
				</div>
				<div class="card-footer text-muted">
					{{ response.created_at }}
				</div>
			</div>
		</div>
	</div>
</template>

<script>
// Props is for inmutable data, this is received from HTML TAG AT original template
export default {
	props: ['message'],
	data() {
		return {
			responses: [],
		}
	},
	methods: {
		load() {
			axios.get('/api/messages/' + this.message + '/responses')
				.then(res => {
					this.responses = res.data
				});
		}
	}
}
</script>
