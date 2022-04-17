import { createRouter, createWebHistory } from 'vue-router';
import Layout from '@components/Layout';

const routes = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '',
                name: 'Home',
                component: () => import('@views/Home')
            },

            {
                path: '/merchant-settings',
                name: 'MerchantSettings',
                component: () => import('@views/MerchantSettings')
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
