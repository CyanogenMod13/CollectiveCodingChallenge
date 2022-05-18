<template>
	<div class="d-flex flex-column p-2 product-border product-cell">
		<div><strong>{{name}}</strong></div>
		<div>{{description}}</div>
		<div class="mt-auto d-flex w-100">
			<div class="ms-auto d-flex flex-column">
				<div class="ms-auto">{{price}}$</div>
				<div>
					<span v-if="available" class="text-success">In stock</span>
					<span v-else class="text-danger">Not available</span>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "Product",
	props: {
		name: String,
		description: String,
		price: Number,
		available: Number
	},
	mounted() {

	}
}
</script>

<style scoped>
	.product-border {
		border: 1px solid #e9e9e9;
	}

	.product-cell {
		width: calc(100% / 2);
	}
	@media (min-width: 768px) {
		.product-cell {
			width: calc(100% / 3);
		}
	}
	@media (min-width: 1280px) {
		.product-cell {
			width: calc(100% / 5);
		}
	}
</style>