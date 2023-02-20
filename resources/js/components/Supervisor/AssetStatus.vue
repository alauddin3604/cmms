<template>
  <div class="mt-10">
    <h2 class="font-semibold text-2xl">Asset Status</h2>
    <div class="xl:w-96 block p-6 rounded-lg shadow-lg bg-white max-w-md">
      <div class="form-group mb-6">
        <label class="form-label inline-block mb-2 text-gray-700">Barcode</label>
        <input
          v-model="asset.barcode"
          type="text"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-gray-100 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          readonly
        >
      </div>
      <div class="form-group mb-6">
        <label class="form-label inline-block mb-2 text-gray-700">Name</label>
        <input
          v-model="asset.name"
          type="text"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          readonly
        >
      </div>
      <div class="form-group mb-6">
        <label class="form-label inline-block mb-2 text-gray-700">
          Description
        </label>
        <textarea
          v-model="asset.description"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          rows="3"
          readonly
        ></textarea>
      </div>
      <div class="form-group mb-6">
        <label
          for="exampleFormControlInput1"
          class="form-label inline-block mb-2 text-gray-700"
        >Health</label>
        <div class="w-full bg-gray-200 h-5 ">
          <div
            class="bg-red-600 h-5"
            :style="{ width: this.$route.params.health + '%' }"
          ></div>
        </div>
      </div>
      <button
        type="button"
        class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        @click="checkWorkOrder"
      >Create Work Order</button>
    </div>
  </div>
  <div
    v-show="workOrderModal"
    class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
  >
    <div class="min-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Create Work Order</h3>
      </div>
      <form @submit.prevent="addRecord">
        <div class="form-group mb-6 mt-4">

          <label class="form-label inline-block mb-2 text-gray-700">Asset</label>
          <input
            v-model="asset.name"
            type="text"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            readonly
          >
          <!-- <input type="hidden" v-model="asset.id"> -->
          <input
            type="hidden"
            v-model="work_order.asset_id"
          >
        </div>
        <div class="form-group mb-6 mt-4">
          <label class="form-label inline-block mb-2 text-gray-700">Technician</label>
          <select
          required
            v-model="work_order.technician_id"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          >
            <option
              v-for="technician in technicians"
              :key="technician.id"
              :value="technician.id"
            >{{ technician.name }}</option>
          </select>
        </div>
        <div class="form-group mb-6 mt-4">
          <label class="form-label inline-block mb-2 text-gray-700">Maintenance Type</label>
          <select
            required
            v-model="work_order.maintenance_type"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          >
            <option value="General Work Order">General Work Order</option>
            <option value="Preventive Maintenance">Preventive Maintenance</option>
            <option value="Emergency">Emergency</option>
          </select>
        </div>
        <div class="form-group mb-6 mt-4">
          <label class="form-label inline-block mb-2 text-gray-700">Priority</label>
          <select
            required
            v-model="work_order.priority"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          >
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
          </select>
        </div>
        <div class="form-group mb-6">
          <label class="form-label inline-block mb-2 text-gray-700">
            Remarks
          </label>
          <textarea
            required
            v-model="work_order.remarks"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out  m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            rows="3"
          ></textarea>
        </div>
        <input
          type="hidden"
          v-model="work_order.supervisor_id"
        >
        <button
          @click="workOrderModal = false"
          class="px-6 py-2 text-blue-800 border border-blue-600 rounded"
        >
          Cancel
        </button>
        <button class="px-6 py-2 ml-2 text-blue-100 bg-blue-600 rounded">
          Save
        </button>
      </form>
    </div>
  </div>

  <div
    v-show="alertModal"
    class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
  >
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Cannot Create Work Order</h3>
      </div>
      <div class="mt-4">
        <p class="mb-4">
          This asset has pending work order.
        </p>
        <button @click="alertModal = false" class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded">
          Okay
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      asset: {
        id: "",
      },
      technicians: {},
      work_order: {
        asset_id: "",
        technician_id: 0,
        supervisor_id: document
          .querySelector("meta[name='user-id']")
          .getAttribute("content"),
      },
      workOrderModal: false,
      alertModal: false,
    };
  },
  methods: {
    getTechnicians() {
      axios.get("/api/technician").then((response) => {
        this.technicians = response.data.data;
      });
    },
    addRecord() {
      axios
        .post("/api/work_order/add", this.work_order)
        .then((response) => this.$router.push({ name: "supervisorDashboard" }))
        .catch((err) => console.log(err))
        .finally(() => (this.loading = false));
    },
    checkWorkOrder() {
      axios.get(`/api/work_order/check/${this.asset.id}`).then((response) => {
        if (response.data == 1) this.alertModal = true;
        else this.workOrderModal = true;
      });
    },
  },
  created() {
    axios.get(`/api/asset/edit/${this.$route.params.id}`).then((response) => {
      this.asset = response.data;
      this.work_order.asset_id = this.asset.id;
    });
  },
  mounted() {
    this.getTechnicians();
  },
};
</script>