<template>
    <nav class="navbar fixed-top navbar-light bg-white p-3">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">
                <img src="https://www.foodics.com/wp-content/uploads/2021/06/Group-1216.svg" alt="foodics-logo"
                     class="d-inline-block align-text-top">
            </router-link>

            <div class="ms-auto">
                <b-button pill variant="danger" class="text-white" :to="{ name: 'MerchantSettings' }">
                    <i class="fas fa-cogs"></i> &nbsp;MerchantSettings
                </b-button>
            </div>
        </div>
    </nav>

    <div class="container-fluid min-vh-100" style="background: #f1f3f7;padding-top: 70px; padding-bottom: 70px">
        <router-view></router-view>
    </div>
</template>
