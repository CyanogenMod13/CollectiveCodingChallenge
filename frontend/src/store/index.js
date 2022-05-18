import { createStore } from 'vuex'
import routedecode from "../utils/routedecode";
import router from "../router";

const store = createStore({
	state () {
		return {
			filter: {
				data: {
					minPrice: null,
					maxPrice: null,
					categoryId: null,
					available: null
				},
				selected: {
					minPrice: 0,
					maxPrice: 10000,
					categoryId: 0,
					available: false
				}
			}
		}
	},
	mutations: {
		pushRoute(state) {
			let params = routedecode.stringify(state.filter.data)
			router.push({ name: 'ProductsView', params: { param: params } })
		},
		resetPrice(state) {
			state.filter.data.maxPrice = null
			state.filter.data.minPrice = null

			state.filter.selected.maxPrice = 10000
			state.filter.selected.minPrice = 0
		},
		resetCategory(state) {
			state.filter.data.categoryId = null
			state.filter.selected.categoryId = 0
		},
		resetInStore(state) {
			state.filter.data.available = null
			state.filter.selected.available = 0
		}
	},
	getters: {
		hasPrice(state) {
			return state.filter.data.maxPrice || state.filter.data.minPrice
		},
		hasCategory(state) {
			return state.filter.data.categoryId
		},
		hasInStore(state) {
			return state.filter.data.available
		}
	}
})

export default store