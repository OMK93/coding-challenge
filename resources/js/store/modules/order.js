export default {
    namespaced: true,

    state: () => ({
        products: [],
        total: (0).toFixed(2)
    }),

    mutations: {
        ADD_PRODUCT(state, {product, qty}) {
            const orderProduct = state.products.find(record => record.id === product.id);

            if (orderProduct) {
                orderProduct.qty += qty;
                const subTotal = (orderProduct.qty * orderProduct.price).toFixed(2);
                orderProduct.subTotal = parseFloat(subTotal);
            } else {
                product.qty = qty;
                const subTotal = (product.qty * product.price).toFixed(2);
                product.subTotal = parseFloat(subTotal);
                state.products.push(product);
            }
        },

        REMOVE_PRODUCT(state, product) {
            const orderProductIndex = state.products.findIndex(record => record.id === product.id);

            state.products.splice(orderProductIndex, 1);
        },

        CLEAR_ORDER(state) {
            state.products = [];
            state.total = (0).toFixed(2);
        }
    },

    actions: {
        async placeOrder({state}, customer) {
            console.log(customer)
            const products = state.products.map(product => {
                return {
                    id: product.id,
                    qty: product.qty
                }
            });

            return await axios.post('/api/orders', {
                products,
                customer
            });
        }
    },

    getters: {
        order(state, getters) {
            return {
                products: state.products,
                total: getters.total
            }
        },

        total(state) {
            if (!state.products.length) {
                return state.total;
            }

            return state.products.reduce((previousValue, currentValue) => {
                return (previousValue + currentValue.subTotal)
            }, 0).toFixed(2);
        }
    }
}
