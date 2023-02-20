<template>
  <div class="mt-10">
    <h2 class="font-semibold text-2xl">Technician</h2>

    <div class="flex flex-col">
      <div class="overflow-x-visible sm:-mx-6 lg:-mx-8">
        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">

          <div class="overflow-hidden">
            <div class="flow-root">
              <router-link :to="{ name: 'addTechnician' }" tag="button"
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
                    Name
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    IC Number
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Email
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Phone Number
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Address
                  </th>
                  <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody class="border">
                <tr v-for="technician in technicians" class="bg-white border-b" :key="technician.id"
                  :class="isChecked(technician.id) ? 'table-primary' : ''">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <input type="checkbox" :value="technician.id" v-model="checked" />
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ technician.name }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ technician.ic_number }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ technician.email }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ technician.phone_number }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-normal">
                    {{ technician.address }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <router-link :to="{ name: 'editTechnician', params: { id: technician.id } }" tag="button"
                      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                      Edit</router-link>
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
          Technician has been <span v-if="add == 1">added</span><span v-else>updated</span> successfully.</div>
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
          Technician(s) deleted successfully.</div>
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
        <pagination :data="technicians" @pagination-change-page="getTechnicians"></pagination>
      </div>
    </div>
  </div>

  <div v-show="alertModal" class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Cannot Delete Technician(s)</h3>
      </div>
      <div class="mt-4">
        <p class="mb-4">
          One or more selected technician has related in work order.
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
      technicians: {},
      selectPage: false,
      checked: [],
      alertModal: false,
      checkboxModal: false,
      deleteModal: false,
      add: 0,
      onSave: 0,
      onDelete: 0
    };
  },
  watch: {
    selectPage: function (value) {
      this.checked = [];
      if (value) {
        this.technicians.forEach((technician) => {
          this.checked.push(technician.id);
        });
      } else {
        this.checked = [];
        this.selectAll = false;
      }
    },
    checked: function (value) {
      this.url = "/api/supervisor/export/" + this.checked;
    },
  },
  methods: {
    getTechnicians() {
      axios.get("/api/technician").then((response) => {
        this.technicians = response.data.data;
      });
    },
    isChecked(technician_id) {
      return this.checked.includes(technician_id);
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
      .delete("/api/technician/multiDelete/" + this.checked)
      .then((response) => {
        if (response.data == 'exists')
          this.alertModal = true
        else {
          this.onDelete = 1;
          this.checked = [];
          this.getTechnicians();
        }
      });
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
    this.getTechnicians();
  },
};
</script>