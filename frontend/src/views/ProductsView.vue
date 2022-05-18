<template>
	<header class="shadow">
		<div class="nav nav-pills d-flex container p-2">
			<div class="nav-item fs-4">Products</div>
			<button class="ms-auto btn btn-outline-secondary sidebar-button" @click="$refs.sidebar.style.right = '0'">
				<i class="bi bi-list"></i>
			</button>
		</div>
	</header>
	<div class="h-100 d-flex container p-1">
		<div class="main-view">
			<div class="d-flex flex-row py-2">
				<ResetFilterButton name="Price"
								   reset-method="resetPrice"
								   visibility="hasPrice"/>
				<ResetFilterButton name="Category"
								   reset-method="resetCategory"
								   visibility="hasCategory"/>
				<ResetFilterButton name="In Store"
								   reset-method="resetInStore"
								   visibility="hasInStore"/>
			</div>
			<div class="d-flex flex-wrap">
				<template v-if="products" v-for="product in products">
					<Product :name="product.name"
							 :description="product.description"
							 :price="product.price"
							 :available="product.available"/>
				</template>
			</div>
			<ul class="pagination w-100 py-3">
				<li :class="currentPage <= 1 ? 'disabled' : ''" class="page-item me-auto">
					<a @click="selectPage(currentPage - 1)" role="button" class="page-link">Prevision</a>
				</li>
				<template v-for="index in countPage">
					<li :class="currentPage === index ? 'active' : ''" class="page-item">
						<a @click="selectPage(index)" role="button" class="page-link">{{index}}</a>
					</li>
				</template>
				<li :class="currentPage >= countPage ? 'disabled' : ''" class="page-item ms-auto">
					<a @click="selectPage(currentPage + 1)" role="button" class="page-link">Next</a>
				</li>
			</ul>
		</div>
		<div ref="sidebar" class="sidebar-view">
			<a role="button" class="nav-link fs-5 text-black sidebar-button" @click="$refs.sidebar.style.right = '-50%'">
				<span>Filter&nbsp;></span>
			</a>
			<ProductFilter/>
		</div>
	</div>
</template>

<script>
import qs from "qs"
import axios from "axios"
import Product from "../components/Product.vue";
import ProductFilter from "../components/ProductFilter.vue";
import routedecode from "../utils/routedecode";
import ResetFilterButton from "../components/ResetFilterButton.vue";
export default {
	name: "ProductsView",
	components: {ResetFilterButton, ProductFilter, Product },
	watch: {
		$route (to, from) {
			this.parseRoute(to.params.param)
		}
	},
	methods: {
		fetchProducts: function (page = 1, filter = {}) {
			axios.post(`/api/products/${page}`, filter).then(response => {
				this.products = response.data.products
				this.countPage = response.data.countPage
				this.currentPage = response.data.currentPage
			})
		},
		parseRoute: function (param) {
			let filter = routedecode.parse(param)
			let page = filter.page
			if (page) {
				delete filter['page']
			}
			this.fetchProducts(page ? page : 1, filter)
		},
		selectPage: function (page) {
			let routeParam = this.$route.params.param
			let param = null
			if (routeParam.includes('page=')) {
				param = routeParam.replace(new RegExp('page=\\d+'), `page=${page}`)
			} else {
				param = `page=${page}` + (routeParam.length ? `&${routeParam}` : '')
			}
			this.$router.push({ name: 'ProductsView', params: { param: param } })
		}
	},
	data() {
		return {
			products: null,
			countPage: 0,
			currentPage: 1,
		}
	},
	mounted() {
		this.parseRoute(this.$route.params.param)
	}
}
</script>

<style scoped>
	.main-view {
		width: 75%;
	}
	.sidebar-view {
		width: 25%;
	}
	.sidebar-button {
		display: none;
	}

	@media (max-width: 800px) {
		.main-view {
			width: 100%;
		}
		.sidebar-view {
			position: fixed;
			top: 0;
			height: 100%;
			background-color: white;
			box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
			z-index: 1000;
			width: 50%;
			transition: 0.5s;
			right: calc(-50%);
		}
		.sidebar-button {
			display: block;
		}

		.open-sidebar {
			right: 0;
		}
		.close-sidebar {
			right: calc(-50%);
		}
	}
</style>