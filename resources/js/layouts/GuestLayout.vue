<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import LocaleSwitcher from '@/components/LocaleSwitcher.vue';
import { Button } from 'primevue';
import { PageProps } from '@/types';
import AppearanceTabs from '@/components/AppearanceTabs.vue';

const page = usePage<PageProps>();
</script>

<template>
    <div class="min-h-screen bg-gradient-to-b from-white to-gray-50 dark:from-gray-900 dark:to-gray-800">
        <!-- Navigation -->
        <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md dark:bg-gray-900/80 shadow-sm z-50">
            <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
                <Link href="/">
                    <div class="flex items-center space-x-2">
                        <!-- <img src="/logo.svg" alt="Blog Logo" class="h-8 w-8" /> -->
                        <span class="text-xl font-bold text-gray-800 dark:text-white press-start-2p-regular">KeeDev</span>
                    </div>
                </Link>
                
                <div class="flex items-center gap-4">
                    <LocaleSwitcher :currentLocale="page.props.currentLocale" />
                    <!-- <template v-if="page.props.auth.user">
                        <Link :href="route('dashboard')">
                            <Button
                                class="p-button-outlined"
                                variant="outlined"
                            >
                                Dashboard
                            </Button>
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')">
                            <Button
                                class="p-button-text"
                                variant="text"
                            >
                                Log in
                            </Button>
                        </Link>
                        <Link :href="route('register')">
                            <Button
                                class="p-button-outlined"
                                variant="outlined"
                            >
                                Register
                            </Button>
                        </Link>
                    </template> -->
                    <AppearanceTabs/>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 press-start-2p-regular">KeeDev</h3>
                        <p class="text-gray-400">Share your stories with the world.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white">About</a></li>
                            <li><a href="#" class="hover:text-white">Contact</a></li>
                        </ul>
                    </div>
                    <!-- <div>
                        <h4 class="font-semibold mb-4">Categories</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white">Technology</a></li>
                            <li><a href="#" class="hover:text-white">Lifestyle</a></li>
                            <li><a href="#" class="hover:text-white">Travel</a></li>
                            <li><a href="#" class="hover:text-white">Food</a></li>
                        </ul>
                    </div> -->
                    <div>
                        <h4 class="font-semibold mb-4">Follow Me</h4>
                        <div class="flex space-x-4">
                            <a href="https://github.com/Keyword22" target="_blank" class="text-gray-400 hover:text-white">
                                <i class="pi pi-github text-xl"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/manuelfmm/" target="_blank" class="text-gray-400 hover:text-white">
                                <i class="pi pi-linkedin text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <i class="pi pi-telegram text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template> 

<style>
@import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
.press-start-2p-regular {
  font-family: "Press Start 2P", system-ui;
  font-weight: 400;
  font-style: normal;
}

</style>