<template>
    <div class="h-28 p-2 rounded-lg" :class="color">
        <span>{{ title }}</span>
        <div class="pt-4">
            <span class="inline-block">{{ result }}</span>
            <img
                class="inline-block float-right w-12"
                :src="icon"
            >
        </div>
    </div>
</template>

<script setup>
defineProps({
    color: {
        type: String,
        default: 'bg-blue-100',
    },
    title: {
        type: String,
        default: 'Loading...',
    },
    icon: {
        type: String,
        default: null,
    },
    result: {
        type: String,
        default: 'Loading...',
    },
})
</script>
