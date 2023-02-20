<template>
  <nav class="fixed w-10/12 flex-wrap items-center justify-between py-3 text-gray-500 hover:text-gray-700 focus:text-gray-700 navbar navbar-expand-lg navbar-light">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
      <nav class="bg-grey-light rounded-md w-full" aria-label="breadcrumb">
        <ol class="list-reset flex">
          <li><router-link :to="{ name: 'supervisor' }" class="text-blue-600 hover:text-blue-700">Supervisor</router-link></li>
          <li><span class="text-gray-500 mx-2">/</span></li>
          <li class="text-gray-500">Edit Supervisor</li>
        </ol>
      </nav>
    </div>
  </nav>
  <div class="justify-center">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
        <h2 class="font-semibold text-2xl mt-20">Edit Supervisor</h2>
        <form
          class="max-w-lg mt-10"
          @submit.prevent="updateSupervisor"
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
                required
                class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-password"
                v-model="supervisor.address"
              ></textarea>
            </div>
          </div>
          <div class="float-right">
            <button class="bg-blue-600 hover:bg-blue-700 hover:shadow-lg text-slate-50 font-bold py-2 px-4 rounded inline-flex items-center ml-3 mt-3">
              <span>Update</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      supervisor: {},
    };
  },
  created() {
    axios
      .get(`/api/supervisors/${this.$route.params.id}`)
      .then((response) => {
        this.supervisor = response.data.data;
        // console.log(response.data);
      });
  },
  methods: {
    updateSupervisor() {
      axios
        .post(
          `/api/supervisor/update/${this.$route.params.id}`,
          this.supervisor
        )
        .then(() => {
          this.$router.push({ name: "supervisor", query: { success: 'true', action: 'update' } });
        });
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