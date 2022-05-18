import { createRouter, createWebHistory } from 'vue-router'
import ProductsView from "../views/ProductsView.vue";

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			name: 'ProductsView',
			path: '/products/:param?',
			component: ProductsView
		}
	]
})

export default router
