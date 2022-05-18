<template>
	<button v-if="$store.getters[visibility]" @click="reset" class="btn btn-outline-secondary btn-sm rounded rounded-pill me-1" style="box-shadow: none">
		<span class="text-black">{{ name }}&nbsp;<i class="bi bi-x-circle"></i></span>
	</button>
</template>

<script>
export default {
	name: "ResetFilterButton",
	props: {
		name: String,
		resetMethod: String,
		visibility: String
	},
	methods: {
		reset: function () {
			this.$store.commit(this.resetMethod)
			this.$store.commit('pushRoute')
		}
	}
}
</script>

<style scoped>

</style>