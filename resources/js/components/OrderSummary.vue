<template>
    <!-- Success Message -->
    <div v-if="successMessage" class="alert alert-success d-flex justify-content-between" role="alert">
        <div>
            <i class="fas fa-check-circle fa-lg me-2"></i>
            {{ successMessage }}
        </div>

        <button type="button" class="btn-close" @click="successMessage = null"></button>
    </div>

    <!-- Validation Errors -->
    <div v-if="validationErrors.length" class="alert alert-danger d-flex justify-content-between" role="alert">
        <ul>
            <li v-for="(error, index) in validationErrors" :key="index">{{ error }}</li>
        </ul>

        <button type="button" class="btn-close" @click="validationErrors = []"></button>
    </div>

    <!-- Customers List -->
    <b-card class="mb-3">
        <label class="mb-1">Customer</label>
        <b-form-select
            v-model="selectedCustomer"
            :options="customers"
            class="mb-3"
            value-field="id"
            text-field="name"
        ></b-form-select>
    </b-card>

    <!-- Oder Summary -->
    <b-overlay :show="loading" rounded="sm">
        <div class="d-flex flex-column order-summary">
            <div class="px-4 py-3 order-summary-title">
                <h3 class="mb-0">Order Summary</h3>
            </div>

            <div v-if="!order.products.length" class="d-flex align-items-center justify-content-center"
                 style="height: 500px">
                <h4 class="fw-bold">No products added.</h4>
            </div>

            <div v-else class="order-items p-4" style="height: 500px; overflow: auto">
                <div v-for="(product, index) in order.products" :key="product.id"
                     class="d-flex justify-content-between align-items-center py-3"
                     :class="{'order-item': notLastIndex(index)}">

                    <button class="me-3 btn-lg remove-product" @click="removeProduct(product)">
                        <i class="fas fa-minus-circle text-danger"></i>
                    </button>

                    <div>
                        <b-img :src="product.image"
                               height="60"
                               width="80"></b-img>
                    </div>

                    <div class="ms-4">
                        <p class="mb-0">
                            <strong>{{ product.qty }}</strong> x {{ product.name }}
                        </p>
                    </div>

                    <div class="remove-item ms-auto">
                        <strong>JOD {{ product.subTotal.toFixed(2) }}</strong>
                    </div>
                </div>
            </div>

            <div class="mt-auto">
                <div class="d-flex justify-content-between px-4 py-3 mb-4 order-total">
                    <h4 class="mb-0">Total</h4>
                    <h4 class="mb-0">JOD {{ order.total }}</h4>
                </div>

                <div class="d-flex justify-content-between p-4 order-controls">
                    <b-button variant="outline-danger" class="text-uppercase px-xl-5 py-xl-2"
                              :disabled="!order.products.length" @click="clearOrder">Cancel
                        Order
                    </b-button>
                    <b-button variant="success" class="text-uppercase px-xl-5 py-xl-2" :disabled="!order.products.length"
                              @click="submitOrder">Place Order
                    </b-button>
                </div>
            </div>

        </div>
    </b-overlay>

</template>

<script>
import {mapGetters, mapMutations, mapActions} from 'vuex';

export default {
    data() {
        return {
            customers: [],
            selectedCustomer: null,
            loading: false,
            successMessage: null,
            validationErrors: []
        };
    },

    computed: {
        ...mapGetters({
            order: 'order/order'
        })
    },

    watch: {
        customers(value) {
            this.selectedCustomer = value.find(customer => customer.default).id;
        }
    },

    methods: {
        ...mapMutations({
            removeProduct: 'order/REMOVE_PRODUCT',
            clearOrder: 'order/CLEAR_ORDER'
        }),

        ...mapActions({
            placeOrder: 'order/placeOrder'
        }),

        async submitOrder() {
            this.loading = true;
            this.successMessage = null;
            this.validationErrors = [];

            try {
                const {data: {message}} = await this.placeOrder(this.selectedCustomer);
                this.clearOrder();
                this.successMessage = message;
            } catch (error) {
                const errors = error.response.data.errors;

                Object.values(errors).forEach(error => {
                    this.validationErrors.push(error.pop())
                });

            } finally {
                this.loading = false;
                window.scrollTo({top: 0, behavior: 'smooth'});
            }
        },

        notLastIndex(index) {
            return index !== (this.order.products.length - 1);
        }
    },

    async created() {
        const {data: customers} = await axios.get('/api/customers');
        this.customers = customers;
    }
}
</script>

<style scoped>
.order-summary {
    background: white;
    border-radius: 0.25rem
}

.order-summary-title {
    background: #5830c5;
    color: white;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem
}

.order-item {
    border-bottom: 1px solid black;
}

.order-total {
    background: #5830c5;
    color: white
}

.remove-product {
    border: none;
    background: none;
    box-shadow: none;
}
</style>
