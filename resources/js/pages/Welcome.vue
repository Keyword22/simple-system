<script setup lang="ts">

import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button, Card, Message, Skeleton, Toast } from 'primevue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import GeometricBackground from '@/components/GeometricBackground.vue';
import dayjs from 'dayjs'
import { useToast } from "primevue/usetoast";


const toast = useToast();


const showSuccess = () => {
    toast.add({ severity: 'success', summary: 'Thank you!', detail: 'Thank you for subscribing to my newsletter!', life: 3000 });
};

defineProps<{
    featuredPosts: Post[];
}>();

const form = useForm({
    email: '',
});

const subscribe = () => {
    form.post(route('newsletter.subscribe'), {
        onSuccess: () => {
            form.reset()
            showSuccess()
        },
    });
};
</script>

<template>

    <Head title="Welcome">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>


    <Toast />

    <GuestLayout>
        <!-- Hero Section -->
        <section
            class="relative pt-32 pb-20 px-4 overflow-hidden bg-gradient-to-b from-white via-[rgb(var(--primary-color)/0.03)] to-white dark:from-gray-900 dark:to-gray-800">
            <GeometricBackground />
            <div class="container mx-auto text-center relative z-10">
                <h1
                    class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 [text-shadow:_0_1px_2px_rgb(0_0_0_/_10%)]">
                    Share Your Story With The World
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    Create, share, and discover amazing stories. Join our community of writers and readers.
                </p>
                <div class="flex gap-4 justify-center">
                    <Button label="Start Writing" class="p-button-lg" severity="primary" />
                    <Button label="Learn More" class="p-button-lg p-button-outlined" />
                </div>
            </div>
        </section>

        <!-- Featured Posts -->
        <section class="py-16 px-4 bg-white dark:bg-gray-800">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 text-center">
                    Featured Posts
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template v-if="featuredPosts.length">
                        <Link v-for="post in featuredPosts" :key="post.id" :href="route('post.show', { post: post.id })">
                            <Card class="shadow-lg card-hover-effect">
                                <template #header>
                                    <img :src="post.image" :alt="post.title" class="w-full h-48 object-cover" />
                                </template>
                                <template #title>
                                    <h3 class="text-xl font-semibold">{{ post.title }}</h3>
                                </template>
                                <template #content>
                                    <p class="text-gray-600 dark:text-gray-300">{{ post.excerpt }}</p>
                                </template>
                                <template #footer>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">{{ dayjs(post.published_at).format("DD/MM/YYYY HH:mm") }}</span>

                                        <Link :href="route('post.show', { post: post.id })" class="p-button-text">
                                        <Button label="Read More" class="p-button-text" />
                                        </Link>
                                    </div>
                                </template>
                            </Card>
                        </Link>
                    </template>
                    <template v-else>
                        <Skeleton height="20rem"></Skeleton>
                        <Skeleton height="20rem"></Skeleton>
                        <Skeleton height="20rem"></Skeleton>
                    </template>

                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 px-4">
            <div class="container mx-auto max-w-4xl bg-gray-50 dark:bg-gray-700 rounded-xl p-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        Subscribe to Our Newsletter
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        Get the latest posts and updates delivered straight to your inbox.
                    </p>
                    <form @submit.prevent="subscribe" class="flex gap-4 justify-center">
                        <input 
                            v-model="form.email"
                            type="email" 
                            placeholder="Enter your email"
                            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 w-full max-w-sm"
                            :class="{ 'border-red-500': form.errors.email }" 
                        />
                        <Button 
                            type="submit"
                            label="Subscribe" 
                            :loading="form.processing"
                        />
                    </form>
                    <Message class="mt-5" v-if="form.errors.email" severity="error">
                        {{ form.errors.email }}
                    </Message>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>


<style scoped>
.card-hover-effect {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover-effect:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
</style>