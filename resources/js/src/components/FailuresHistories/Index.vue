<template>
    <div class="w-9/12 bg-white my-6 mx-auto p-5 rounded-lg mb-24">
        <div>
            <span class="py-4 font-bold">Server Failures Histories</span>
            <div class="tooltip">
                <img
                    class="w-12 inline-block"
                    src="https://raw.githubusercontent.com/MohsenAbrishami/monitoring-panel/main/src/assets/guide-icon.png"
                >
                <span class="tooltiptext">
                    In the graph below, you can see the number of times CPU, RAM,
                    and hard drive usage exceeds the limit, as well as
                    the number of web server and network outages per day.
                </span>
            </div>
        </div>
        <div class="py-4">
            <span class="inline text-gray-500">Select history range:</span>
            <div class="inline-block ml-3">
                <VueDatePicker
                    v-model="date"
                    range
                    auto-apply
                    :enable-time-picker="false"
                    :format="'yyyy/MM/dd'"
                    @update:model-value="selectDate"
                />
            </div>
        </div>
        <div class="grid grid-col-1 md:grid-cols-6">
            <div class="inline-block md:pt-16 py-2 md:col-span-1">
                <div class="block pt-2">
                    <input
                        v-model="resources.cpu"
                        type="checkbox"
                        @click="generateChart('cpu')"
                    >
                    <span class="text-blue-500 font-bold mx-4">CPU</span>
                </div>
                <div class="block pt-2">
                    <input
                        v-model="resources.memory"
                        type="checkbox"
                        @click="generateChart('memory')"
                    >
                    <span class="text-green-500 font-bold mx-4">Memory</span>
                </div>
                <div class="block pt-2">
                    <input
                        v-model="resources.storage"
                        type="checkbox"
                        @click="generateChart('storage')"
                    >
                    <span class="text-red-500 font-bold mx-4">HDD</span>
                </div>
                <div class="block pt-2">
                    <input
                        v-model="resources.network"
                        type="checkbox"
                        @click="generateChart('network')"
                    >
                    <span class="text-purple-500 font-bold mx-4">Network</span>
                </div>
                <div class="block pt-2">
                    <input
                        v-model="resources.webServer"
                        type="checkbox"
                        @click="generateChart('webServer')"
                    >
                    <span class="text-yellow-500 font-bold mx-4">Web Server</span>
                </div>
            </div>
            <div class="inline-block h-96 w-full md:col-span-5">
                <Line :data="data" :options="options" />
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'
import { onMounted, reactive, ref } from 'vue'
import axios from 'axios'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend
)

const data = ref({})

const date = ref()

const options = {
    responsive: true,
    maintainAspectRatio: false,
}

const resourceLog = reactive({
    history: null,
})

const resources = reactive({
    cpu: true,
    memory: true,
    storage: true,
    network: true,
    webServer: true,
})

function getResourceLogHistories() {
    const fromDate = date.value[0].toISOString().slice(0, 10)
    const toDate = date.value[1].toISOString().slice(0, 10)
    axios.get(`${window.stethoscope.host}/monitor/history/${fromDate}/${toDate}
        ?key=${window.stethoscope.monitoring_panel_key}`)
        .then((value) => {
            resourceLog.history = value.data
            generateChart()
        })
}

function generateChart(key) {
    resources[key] = !resources[key]

    data.value = {
        labels: resourceLog.history?.labels,
        datasets: [],
    }

    if (resources.cpu) {
        data.value.datasets.push({
            label: 'CPU',
            backgroundColor: '#3b82f6',
            data: resourceLog.history?.resource_log_count.cpu,
        })
    }

    if (resources.memory) {
        data.value.datasets.push({
            label: 'Memory',
            backgroundColor: '#22c55e',
            data: resourceLog.history?.resource_log_count.memory,
        })
    }

    if (resources.storage) {
        data.value.datasets.push({
            label: 'HDD',
            backgroundColor: '#ef4444',
            data: resourceLog.history?.resource_log_count.storage,
        })
    }

    if (resources.network) {
        data.value.datasets.push({
            label: 'network',
            backgroundColor: '#a855f7',
            data: resourceLog.history?.resource_log_count.network,
        })
    }

    if (resources.webServer) {
        data.value.datasets.push({
            label: 'web server',
            backgroundColor: '#eab308',
            data: resourceLog.history?.resource_log_count.web_server,
        })
    }
}

function setInitializeDate() {
    const endDate = new Date()
    const startDate = new Date(new Date().setDate(endDate.getDate() - 7))
    date.value = [startDate, endDate]
}

onMounted(() => {
    setInitializeDate()
    getResourceLogHistories()
})

generateChart()

const selectDate = (modelData) => {
    date.value = modelData
    getResourceLogHistories()
}
</script>

<style scoped>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 200px;
  background-color: #03a1fc;
  color: white;
  text-align: center;
  font-size: 12px;
  border-radius: 6px;
  padding: 5px;
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: -5px;
  left: 105%;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
