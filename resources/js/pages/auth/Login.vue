<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import Checkbox from 'primevue/checkbox';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Password from 'primevue/password';
import Message from 'primevue/message';
import { LoginTranslations } from '@/types';




defineProps<{
    status?: string;
    canResetPassword: boolean;
    translations?: LoginTranslations;
    theme: 'light' | 'dark';
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase :title="translations?.title" :description="translations?.description">

        <Head :title="translations?.simple_title" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <FloatLabel variant="on">
                        <Label for="email">{{translations?.email}}</Label>
                        <InputText id="email" type="email" required autofocus class="w-full" :tabindex="1"
                            autocomplete="email" v-model="form.email" />
                    </FloatLabel>
                    <Message v-if="form.errors.email" icon="pi pi-times-circle" size="small" severity="error" >{{ form.errors.email }}</Message>
                </div>

                <div class="grid gap-2">
                    <FloatLabel variant="on">
                        <Password inputId="password" toggle-mask required fluid
                            autocomplete="current-password" :feedback="false" v-model="form.password" />
                            <Label for="password">{{translations?.password}}</Label>
                    </FloatLabel>
                    <Message v-if="form.errors.password" icon="pi pi-times-circle" size="small" severity="error" >{{ form.errors.password }}</Message>
                </div>

                <div class="flex items-center justify-between" :tabindex="3">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" binary :tabindex="4" />
                        <span>{{translations?.remember_me}}</span>
                    </Label>
                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm justify-self-end" :tabindex="5">
                            {{translations?.forgot_pass}}
                        </TextLink>
                </div>

                <Button type="submit" icon="key" class="mt-4 w-full" :label="translations?.simple_title" size="small" :tabindex="4" :loading="form.processing"/>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                {{translations?.no_account}}
                <TextLink :href="route('register')" :tabindex="5">{{translations?.sign_up}}</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
