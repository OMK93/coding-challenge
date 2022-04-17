<template>
    <!-- Product Modal -->
    <product-modal v-if="selectedProduct" :product="selectedProduct" @close="selectedProduct = null"></product-modal>

    <div class="mb-5">
        <b-form-input class="search-input" size="lg" placeholder="Search..." v-model="searchTerm"></b-form-input>
    </div>

    <!-- Search Bar -->
    <div class="row">
        <div v-for="product in filteredProducts" :key="product" class="col-sm-6 col-xl-4">
            <b-card
                :img-src="product.image"
                :img-alt="product.name"
                role="button"
                img-height="130"
                class="mb-4"
                @click="showProduct(product)"
            >
                <h6>{{ product.name }}</h6>
                <h6 class="mb-0">JOD {{ product.price }}</h6>
            </b-card>
        </div>
    </div>
</template>

<script>
import ProductModal from '@components/ProductModal';

export default {
    components: {
        ProductModal
    },

    data() {
        return {
            products: [],
            searchTerm: '',
            selectedProduct: null
        };
    },

    computed: {
        filteredProducts() {
            return this.products.filter(product => {
                return product.name.toLowerCase().indexOf(this.searchTerm.toLowerCase()) !== -1;
            });
        }
    },

    methods: {
        showProduct(product) {
            this.selectedProduct = product;
        }
    },

    async created() {
        const {data: products} = await axios.get('/api/products');
        this.products = products;
    }
}
</script>

<style scoped>
.search-input {
    background-color: #eee;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PGNpcmNsZSBjeD0iMTEiIGN5PSIxMSIgcj0iOCIvPjxwYXRoIGQ9Im0yMSAyMS00LTQiLz48L3N2Zz4=);
    background-position: 12px;
    background-repeat: no-repeat;
    border-radius: 8px;
    box-sizing: border-box;
    flex: 1;
    font-size: 16px;
    line-height: 1.5;
    padding: 12px 12px 12px 48px;
    position: relative;
    width: 100%;
}
</style>
