<template>
  <div class="mt-10">
    <h2 class="font-semibold text-2xl">Asset</h2>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <div class="flow-root">
              <router-link :to="{ name: 'addAsset' }" tag="button"
                class="bg-green-600 hover:bg-green-700 hover:shadow-lg text-slate-50 font-bold py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add</span>
              </router-link>
              <button
                class="bg-red-600 hover:bg-red-700 hover:shadow-lg text-slate-50 font-bold py-2 px-4 rounded inline-flex items-center float-right mb-5"
                @click="deleteRecords">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete</button>
            </div>

            <table class="min-w-full text-center">
              <thead class="border-b bg-gray-800">
                <tr>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    <input type="checkbox" v-model="selectPage" />
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    ID
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Barcode
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Name
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Description
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody class="border">
                <tr v-for="asset in assets" class="bg-white border-b" :key="asset.id"
                  :class="isChecked(asset.id) ? 'table-primary' : ''">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <input type="checkbox" :value="asset.id" v-model="checked" />
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.id }}
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.barcode }}
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.name }}
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-normal">
                    {{ asset.description }}
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-nowrap">
                    <!-- <qr-code v-bind:text="asset.barcode"></qr-code> -->
                    <router-link :to="{ name: 'editAsset', params: { id: asset.id } }" tag="button"
                      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                      Edit
                    </router-link>
                    &nbsp;
                    <button @click="showQR(asset.barcode, asset.name)"
                      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                      Get QR Code
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div v-if="onSave == 1"
        class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 "
        role="alert">
        <div class="text-xl font-normal  max-w-full flex-initial">
          Asset has been <span v-if="add == 1">added</span><span v-else>updated</span> successfully.</div>
        <div class="flex flex-auto flex-row-reverse" @click="onSave = 0">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-x cursor-pointer hover:text-green-400 rounded-full w-5 h-5 ml-2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </div>
        </div>
      </div>
      <div v-if="onDelete == 1"
        class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 bg-green-100 border border-green-300 "
        role="alert">
        <div class="text-xl font-normal  max-w-full flex-initial">
          Asset(s) deleted successfully.</div>
        <div class="flex flex-auto flex-row-reverse" @click="onDelete = 0">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-x cursor-pointer hover:text-green-400 rounded-full w-5 h-5 ml-2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </div>
        </div>
      </div>
      <div>
        <pagination :data="assets" @pagination-change-page="getAssets"></pagination>
      </div>
    </div>
  </div>
  <div v-show="qRCodeModal" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50" @scroll.prevent>
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">{{ asset_name }}</h3>
        <button @click="qRCodeModal = false" type="button"
          class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
          <span class="sr-only">Close menu</span>
          <!-- Heroicon name: outline/x -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-4 justify-center">
        <qr-code class="mb-2" v-bind:text="asset_barcode"></qr-code>
        <p>{{ asset_barcode }}</p>
        <button @click="print()" class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded">
          Print
        </button>
      </div>
    </div>
  </div>

  <div v-show="alertModal" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Cannot Delete Asset(s)</h3>
      </div>
      <div class="mt-4">
        <p class="mb-4">
          One or more selected asset has related in work order.
        </p>
        <button @click="alertModal = false" class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded">
          Okay
        </button>
      </div>
    </div>
  </div>

  <div v-show="checkboxModal" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Cannot Proceed</h3>
      </div>
      <div class="mt-4">
        <p class="mb-4">
          Please select one or more records to be deleted.
        </p>
        <button @click="checkboxModal = false" class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded">
          Okay
        </button>
      </div>
    </div>
  </div>

  <div v-show="deleteModal" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Delete Record(s)</h3>
      </div>
      <div class="mt-4">
        <p class="mb-4">
          Are you sure you want to delete the selected record?
        </p>
        <button @click.prevent="confirmDelete" class="px-6 py-2 ml-2 float-right text-slate-100 bg-red-600 rounded">
          Delete
        </button>
        <button @click="deleteModal = false" class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded">
          Cancel
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
      assets: {},
      selectPage: false,
      checked: [],
      qRCodeModal: false,
      alertModal: false,
      checkboxModal: false,
      deleteModal: false,
      asset_barcode: "",
      asset_name: "",
      add: 0,
      onSave: 0,
      onDelete: 0
    };
  },
  watch: {
    selectPage: function (value) {
      this.checked = [];
      if (value) {
        this.assets.forEach((asset) => {
          this.checked.push(asset.id);
        });
      } else {
        this.checked = [];
        this.selectAll = false;
      }
    },
    checked: function (value) {
      this.url = "/api/asset/export/" + this.checked;
    },
  },
  methods: {
    getAssets() {
      axios.get("/api/assets").then((response) => {
        this.assets = response.data.data;
      });
    },
    isChecked(asset_id) {
      return this.checked.includes(asset_id);
    },
    deleteRecords() {
      if (this.checked === undefined || this.checked.length == 0)
        this.checkboxModal = true;
      else
        this.deleteModal = true;
    },
    confirmDelete() {
      this.deleteModal = false;
      axios
      .delete("/api/asset/multiDelete/" + this.checked)
      .then((response) => {
        if (response.data == 'exists')
          this.alertModal = true
        else {
          this.onDelete = 1;
          this.checked = [];
          this.getAssets();
        }
      });
    },
    showQR(asset_barcode, asset_name) {
      this.qRCodeModal = true;
      this.asset_barcode = asset_barcode;
      this.asset_name = asset_name;
    },
    print() {
      window.print();
    },
  },
  mounted() {
    if (this.$route.query.success == 'true') {
      if (this.$route.query.action == 'add')
        this.add = 1;
      else
        this.add = 0;

      this.onSave = 1;
      let query = Object.assign({}, this.$route.query);
      delete query.success;
      delete query.action;
      this.$router.replace({ query });
    }
    this.getAssets();
  },
};
</script>