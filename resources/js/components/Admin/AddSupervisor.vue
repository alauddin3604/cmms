<template>
  <nav class="fixed w-10/12 flex-wrap items-center justify-between py-3 text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
      <nav
        class="bg-grey-light rounded-md w-full"
        aria-label="breadcrumb"
      >
        <ol class="list-reset flex">
          <li>
            <router-link
              :to="{ name: 'supervisor' }"
              class="text-blue-600 hover:text-blue-700"
            >Supervisor</router-link>
          </li>
          <li><span class="text-gray-500 mx-2">/</span></li>
          <li class="text-gray-500">Add Supervisor</li>
        </ol>
      </nav>
    </div>
  </nav>
  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
        <h2 class="font-semibold text-2xl mt-20">Add Supervisor</h2>
        <form
          class="w-full max-w-lg mt-10"
          @submit.prevent="addRecord"
        >
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-first-name"
              >
                Name
              </label>
              <input
                required
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="grid-first-name"
                type="text"
                v-model="supervisor.name"
                @keypress="isLetter"
              >
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-last-name"
              >
                IC Number
              </label>
              <input
                required
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name"
                type="text"
                v-model="supervisor.ic_number"
                @keypress="onlyNumber"
                :maxlength="12"
                placeholder="Without dashes '-' or spaces"
              >
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-last-name"
              >
                Email
              </label>
              <input
                required
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name"
                type="email"
                placeholder="example@email.com"
                v-model="supervisor.email"
              >
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-last-name"
              >
                Phone Number
              </label>
              <input
                required
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name"
                type="tel"
                placeholder="012xxxxxxx"
                v-model="supervisor.phone_number"
                @keypress="onlyNumber"
                :maxlength="12"
              >
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="grid-password"
              >
                Address
              </label>
              <textarea
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-password"
                type="text"
                v-model="supervisor.address"
              ></textarea>
            </div>
          </div>
          <div class="float-right">
            <button class="bg-green-600 hover:bg-green-700 hover:shadow-lg text-slate-50 font-bold py-2 px-4 rounded inline-flex items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4v16m8-8H4"
                />
              </svg>
              <span>Add</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div
    v-show="alertModal"
    class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
  >
    <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
      <div class="flex items-center justify-between">
        <h3 class="text-2xl">Cannot Add Supervisor</h3>
      </div>
      <div class="mt-4">
          <div v-for="(errorArray, idx) in errors" :key="idx">
              <div v-for="(allErrors, idx) in errorArray" :key="idx">
                  <p class="mb-4 text-sm">{{ allErrors}} </p>
              </div>
          </div>
        <button
          @click="alertModal = false"
          class="px-6 py-2 ml-2 float-right text-blue-100 bg-blue-600 rounded"
        >
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
      supervisor: {
        name: "",
        ic_number: "",
        email: "",
        phone_number: "",
        address: "",
      },
      alertModal: false,
      errors: null
    };
  },
  methods: {
    addRecord() {
      axios
        .post("/api/supervisors", this.supervisor)
        .then((response) => {
          if (response.data.success == true)
            this.$router.push({ name: "supervisor", query: { success: 'true', action: 'add' } });
        })
        .catch(e => {
          this.errors = e.response.data.data;
          this.alertModal = true;
        })
        .finally(() => (this.loading = false));
    },
    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if (keyCode < 48 || keyCode > 57) {
        // 46 is dot
        $event.preventDefault();
      }
    },
    isLetter(e) {
      let char = String.fromCharCode(e.keyCode); // Get the character
      if(/^[A-Za-z]+$/.test(char)) return true; // Match with regex 
      else e.preventDefault(); // If not match, don't add to input text
    }
  },
};
</script>