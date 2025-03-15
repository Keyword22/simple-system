<script setup>
import { router } from '@inertiajs/vue3';
import SelectButton from 'primevue/selectbutton';
import US from '@/assets/img/us.svg'
import Spain from '@/assets/img/spain.svg'
import { ref, watch } from 'vue';
import Fluid from 'primevue/fluid';

const props = defineProps({
    currentLocale: {
        type: String,
        required: true,
    },
});

console.log(props.currentLocale)

// Watch for changes to the currentLocale prop
watch(
    () => props.currentLocale,
    (newLocale) => {
        value.value = newLocale; // Update the value when the locale changes
    }
);

const changeLocale = (locale) => {
    router.post('/locale', { locale }, {
        preserveState: true, // Preserve the current page state
        preserveScroll: true, // Preserve the scroll position
    });
};

const options = ref([
    { icon: US, value: 'en'},
    { icon: Spain, value: 'es'},
]);

const value = ref(props.currentLocale);

</script>

<template>
    <Fluid>
        <SelectButton v-model="value" option-value="value" :allow-empty="false" @change="changeLocale(value)" :options="options">
            <template #option="slotProps">
                <img :src="slotProps.option.icon" class="w-5" alt="option icon">
            </template>
        </SelectButton>
    </Fluid>
</template>