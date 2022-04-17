<template>
    <div class="row p-5">
        <div class="col-lg-6 col-xl-5 mb-5">
            <order-summary></order-summary>
        </div>

        <div class="col-lg-6 col-xl-7 ps-4">
            <Products></Products>
        </div>
    </div>
</template>

<script>
import Products from '@components/Products';
import OrderSummary from '@components/OrderSummary';

export default {
    components: {
        Products,
        OrderSummary
    }
}
</script>
