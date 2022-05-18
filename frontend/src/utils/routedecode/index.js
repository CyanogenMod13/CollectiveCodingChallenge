import qs from "qs";

function parse(param) {
	let filter = qs.parse(param)

	for (let param in filter) {
		if (!isNaN(filter[param])) {
			filter[param] = +filter[param]
		}
		if (filter[param] === 'true') {
			filter[param] = (filter[param] === 'true')
		}
	}
	return filter
}

function stringify(filter) {
	return qs.stringify(filter, { skipNulls: true })
}

const routedecode = {
	parse: parse,
	stringify: stringify
}

export default routedecode