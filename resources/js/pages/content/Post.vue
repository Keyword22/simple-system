<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Button, Card } from 'primevue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import GeometricBackground from '@/components/GeometricBackground.vue';
import dayjs from 'dayjs';

defineProps<{
    post: Post
}>();
</script>

<template>
    <Head title="Post - {{ post.title }}">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <GuestLayout>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 px-4 overflow-hidden bg-gradient-to-b from-white via-[rgb(var(--primary-color)/0.03)] to-white dark:from-gray-900 dark:to-gray-800">
            <GeometricBackground />
            <div class="container mx-auto text-center relative z-10">
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 [text-shadow:_0_1px_2px_rgb(0_0_0_/_10%)]">
                    {{ post.title }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
                    Published on {{ dayjs(post.published_at).format("DD/MM/YYYY HH:mm") }}
                </p>
                <img :src="post.image" :alt="post.title" class="w-full h-64 object-cover mb-8" />
            </div>
        </section>

        <!-- Post Content -->
        <section class="py-16 px-4 bg-white dark:bg-gray-800">
            <div class="container mx-auto max-w-5xl">
                <Card class="shadow-lg">
                    <template #content>
                        <div class="prose dark:prose-dark max-w-none">
                            <p v-html="post.content" class="text-gray-600 dark:text-gray-300"></p>
                        </div>
                    </template>
                </Card>
            </div>
        </section>

        <!-- Back to Home Button -->
        <section class="py-8 px-4">
            <div class="container mx-auto text-center">
                <!-- <Button label="Back to Home" class="p-button-lg" @click="$router.push({ name: 'home' })" /> -->
            </div>
        </section>
    </GuestLayout>
</template>
