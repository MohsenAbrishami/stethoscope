<template>
    <div class="container w-9/12 mx-auto mt-12 bg-white rounded-lg p-2">
        <span class="pl-3 py-4 font-bold inline-block">Current server status</span>
        <img
            src="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/refresh.png"
            class="w-10 inline-block float-right mr-3 cursor-pointer"
            @click.prevent="getCurrentStatus()"
        >

        <Loading v-if="isLoading" />
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            <StatusItem
                title="Cpu Usage"
                :result="statuses.cpu"
                color="bg-blue-100"
                icon="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/cpu-icon.png"
            />
            <StatusItem
                title="Memory Usage"
                :result="statuses.memory"
                color="bg-green-100"
                icon="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/ram-icon.png"
            />
            <StatusItem
                title="Storage Free Space"
                :result="statuses.storage"
                color="bg-red-100"
                icon="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/storage-icon.png"
            />
            <StatusItem
                title="Web server status"
                :result="statuses.webServer"
                color="bg-purple-100"
                icon="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/web-server-icon.png"
            />
            <StatusItem
                title="Network Status"
                :result="statuses.network"
                color="bg-yellow-100"
                icon="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/network-icon.png"
            />
        </div>
    </div>
</template>

<script setup>
import {
    onBeforeUnmount, onMounted, reactive, ref
} from 'vue'
import axios from 'axios'
import StatusItem from './StatusItem.vue'
import Loading from '../Loading.vue'

const statuses = reactive({
    cpu: 'Loading..',
    storage: 'Loading..',
    memory: 'Loading..',
    network: 'Loading..',
    webServer: 'Loading..',
})

const isLoading = ref(false)

onMounted(() => {
    getCurrentStatus()
})

onBeforeUnmount(() => {
    clearInterval(statusChecker)
})

const statusChecker = setInterval(() => {
    getCurrentStatus()
}, 180000)

function getCurrentStatus() {
    isLoading.value = true
    axios.get(`${window.stethoscope.host}/monitor/current?key=${window.stethoscope.monitoring_panel_key}`)
        .then((value) => {
            statuses.cpu = `${value.data.cpu} %`
            statuses.storage = `${value.data.storage} GB`
            statuses.memory = `${value.data.memory} %`
            statuses.network = value.data.network
            statuses.webServer = value.data.web_server
            isLoading.value = false
        })
}
</script>
