<template>
    <div class="p-5">
        <div class="mb-5">
            <h1>Merchant Settings</h1>
        </div>

        <form @submit.prevent="update">
            <div class="row mb-3">
                <div class="col-md-6">
                    <!-- Success Message -->
                    <div v-if="successMessage" class="alert alert-success d-flex justify-content-between" role="alert">
                        <div>
                            <i class="fas fa-check-circle fa-lg me-2"></i>
                            {{ successMessage }}
                        </div>

                        <button type="button" class="btn-close" @click="successMessage = null"></button>
                    </div>

                    <!-- Validation Errors -->
                    <div v-if="validationErrors.length" class="alert alert-danger d-flex justify-content-between"
                         role="alert">
                        <ul>
                            <li v-for="(error, index) in validationErrors" :key="index">{{ error }}</li>
                        </ul>

                        <button type="button" class="btn-close" @click="validationErrors = []"></button>
                    </div>
                </div>
            </div>

            <div class="row">
                <b-form-group label="Merchant Name:" class="col-md-4">
                    <b-form-input v-model="merchantSettings.value.name"
                                  placeholder="Enter merchant name"></b-form-input>
                </b-form-group>

                <b-form-group label="Merchant Email:" class="col-md-4">
                    <b-form-input v-model="merchantSettings.value.email"
                                  placeholder="Enter merchant email"></b-form-input>
                </b-form-group>
            </div>

            <div class="mt-3">
                <b-button class="px-5" type="submit" variant="primary" :disabled="loading">
                    Update
                </b-button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            merchantSettings: {
                id: null,
                key: null,
                value: {}
            },
            successMessage: null,
            validationErrors: []
        }
    },

    methods: {
        async update() {
            this.loading = true;
            this.successMessage = null;
            this.validationErrors = [];

            try {
                const {data: {message}} = await axios.put(`/api/settings/${this.merchantSettings.id}`, {
                    merchant_settings: this.merchantSettings
                });
                this.successMessage = message;
            } catch (error) {
                const errors = error.response.data.errors;

                Object.values(errors).forEach(error => {
                    this.validationErrors.push(error.pop())
                });
            } finally {
                this.loading = false;
            }
        }
    },

    async created() {
        const {data: merchantSettings} = await axios.get('/api/settings');

        this.merchantSettings = merchantSettings;
    }
}
</script>


