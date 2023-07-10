<template>
    <div class="container w-9/12 mx-auto mt-6 bg-white rounded-lg p-2">
        <span class="pl-3 py-4 font-bold inline-block">Monitoring Overview:</span>
        <img
            src="../../public/refresh.png"
            class="w-10 inline-block float-right mr-3 cursor-pointer"
            @click.prevent="getCurrentStatus()"
        >
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            <div class="h-28 bg-red-100 p-2 rounded-lg">
                <span>Cpu Usage</span>
                <div class="pt-4">
                    <span class="inline-block">{{ statuses.cpu }}</span>
                    <img
                        class="inline-block float-right w-12"
                        src="../../public/cpu-icon.png"
                    >
                </div>
            </div>
            <div class="h-28 bg-green-100 p-2 rounded-lg">
                <span>Memory Usage</span>
                <div class="pt-4">
                    <span class="inline-block">{{ statuses.memory }}</span>
                    <img
                        class="inline-block float-right w-12"
                        src="../../public/ram-icon.png"
                    >
                </div>
            </div>
            <div class="h-28 bg-green-100 p-2 rounded-lg">
                <span>Hard Disk Space</span>
                <div class="pt-4">
                    <span class="inline-block">{{ statuses.hardDisk }}</span>
                    <img
                        class="inline-block float-right w-12"
                        src="../../public/harddisk-icon.png"
                    >
                </div>
            </div>
            <div class="h-28 bg-red-100 p-2 rounded-lg">
                <span>Web server status</span>
                <div class="pt-4">
                    <span class="inline-block">{{ statuses.webServer }}</span>
                    <img
                        class="inline-block float-right w-12"
                        src="../../public/web-server-icon.png"
                    >
                </div>
            </div>
            <div class="h-28 bg-green-100 p-2 rounded-lg">
                <span>Network Status</span>
                <div class="pt-4">
                    <span class="inline-block">{{ statuses.network ? 'Connected' : 'Disconnected' }}</span>
                    <img
                        class="inline-block float-right w-12"
                        src="../../public/network-icon.png"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, reactive } from 'vue'
import axios from 'axios'

const statuses = reactive({
    cpu: 'Loading..',
    hardDisk: 'Loading..',
    memory: 'Loading..',
    network: 'Loading..',
    webServer: 'Loading..',
})

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
    axios.get('monitor/current')
        .then((value) => {
            statuses.cpu = `${Number(value.data.cpu).toFixed(2)} %`
            statuses.hardDisk = `${(Number(value.data.hard_disk) / (1024 ** 3)).toFixed(2)} GB`
            statuses.memory = `${Number(value.data.memory).toFixed(2)} %`
            statuses.network = value.data.network
            statuses.webServer = value.data.web_server
        })
}
</script>
