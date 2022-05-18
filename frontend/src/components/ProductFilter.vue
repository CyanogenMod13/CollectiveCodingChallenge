<template>
	<div class="h-100">
		<div class="select-border p-3">
			<div>Price</div>
			<div class="d-flex flex-row">
				<input v-model="selected.minPrice" class="form-control form-control-sm" style="width: 30%">
				<div class="mx-1 my-auto"> — </div>
				<input v-model="selected.maxPrice" class="form-control form-control-sm" style="width: 30%">
				<button class="ms-auto btn btn-success btn-sm" @click="onSelectedPrice">OK</button>
			</div>
		</div>
		<div class="select-border p-3">
			<div>Category</div>
			<div class="dropdown">
				<button id="categoryButton" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
					{{ categories[selected.categoryId] ? categories[selected.categoryId].name : categories[0].name }}
				</button>
				<div class="dropdown-menu">
					<button v-for="category in categories" class="dropdown-item"
							:name="category.id"
							@click="onSelectCategory">
						{{category.name}}
					</button>
				</div>
			</div>
		</div>
		<div class="select-border p-3">
			<div>Available</div>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="inStockCheck" v-model="selected.available" @click="onCheckInStore">
				<label for="inStockCheck" class="form-check-label">In Stock</label>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios"
import routedecode from "../utils/routedecode";

export default {
	name: "ProductFilter",
	computed: {
		selected: function () {
			return this.$store.state.filter.selected
		},
		filter: function () {
			return this.$store.state.filter.data
		}
	},
	data() {
		return {
			categories: [{ id: 0, name: 'Select category' }],
		}
	},
	methods: {
		onSelectCategory: function (event) {
			let id = +(event.target.name)
			this.selected.categoryId = id

			this.filter.categoryId = id ? id : null
			this.pushRoute()
		},
		onCheckInStore: function () {
			this.filter.available = !this.selected.available ? !this.selected.available : null
			this.pushRoute()
		},
		onSelectedPrice: function () {
			this.filter.minPrice = this.selected.minPrice
			this.filter.maxPrice = this.selected.maxPrice
			this.pushRoute()
		},
		initFetch: function () {
			axios.get('/api/categories').then(response => {
				this.categories = [{ id: 0, name: 'Select category' }]
				response.data.forEach(category => {
					this.categories.push(category)
				})
			})
			let param = this.$route.params.param
			if (param.length) {
				let filter = routedecode.parse(param)
				for (let param in filter) {
					this.selected[param] = filter[param]
					this.filter[param] = filter[param]
				}
			}
		},
		pushRoute: function () {
			let params = routedecode.stringify(this.filter)
			this.$router.push({ name: 'ProductsView', params: { param: params } })
		}
	},
	mounted() {
		this.initFetch()
	}
}
</script>

<style scoped>
	.sidebar-border {
		border-left: 1px solid #e9e9e9;
	}

	.sidebar-border-divider {
		border-bottom: 1px solid #e9e9e9;
	}

	.select-border {
		border: 1px solid #e9e9e9;
	}
</style>