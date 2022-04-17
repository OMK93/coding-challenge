<template>
    <div class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-end mb-4">
                        <button class="btn-close" @click="$emit('close')"></button>
                    </div>

                    <div class="row px-3 pb-4">
                        <div class="col-lg-5 mb-sm-4 mb-lg-0">
                            <img class="img-fluid" :src="product.image" alt="product.name">
                        </div>

                        <div class="col-lg-7 ps-4">
                            <h3>{{ product.name }}</h3>
                            <h5 class="mb-4">{{ product.price }} JOD</h5>
                            <p class="mb-5">{{ product.description }}</p>

                            <div class="d-flex">
                                <div class="input-group me-4" style="width: 30%">
                                    <b-button size="sm" class="input-group-text" variant="secondary"
                                              @click="decrementQty">
                                        <i class="fas fa-minus"></i>
                                    </b-button>
                                    <input type="number" v-model="qty" class="form-control">
                                    <b-button size="sm" class="input-group-text" variant="secondary" @click="qty++">
                                        <i class="fas fa-plus"></i>
                                    </b-button>
                                </div>

                                <div>
                                    <b-button variant="primary" @click="addToOrder">
                                        <i class="fas fa-plus"></i>&nbsp; Add To Order
                                    </b-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapMutations} from 'vuex';

export default {
    props: ['product'],

    data() {
        return {
            qty: 1
        };
    },

    methods: {
        ...mapMutations({
            addItem: 'order/ADD_PRODUCT'
        }),

        decrementQty() {
            if (this.qty === 1) return;

            this.qty--;
        },

        addToOrder() {
            this.addItem({
                product: this.product,
                qty: this.qty
            });

            this.$emit('close');
        }
    }
}
</script>

<style>
.modal {
    display: block;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
    text-align: center;
}
</style>
