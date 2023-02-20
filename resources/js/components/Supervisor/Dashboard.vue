<template>
  <div class="mt-10">
    <!-- <h2 class="font-semibold text-2xl">Recent Activity</h2> -->
    <div class="grid grid-rows-3 grid-flow-col gap-4">
      <div class="row-span-3 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Total Assets</h5>
        <p class="font-normal text-xl text-gray-700">{{ assets.length }}</p>
      </div>
      <div class="row-span-3 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Total Work Orders</h5>
        <p class="font-normal text-xl text-gray-700">{{ work_orders.length }}</p>
      </div>
      <div class="row-span-3 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Pending Work Order</h5>
        <p class="font-normal text-xl text-gray-700">{{ pending }}</p>
      </div>
      <div class="row-span-3 block p-6 max-w-sm bg-white rounded-lg border shadow-md">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Completed Work Order</h5>
        <p class="font-normal text-xl text-gray-700">{{ completed }}</p>
      </div>
    </div>
    <h2 class="font-semibold text-2xl mt-20">Asset Health</h2>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full text-center">
              <thead class="border-b bg-gray-800">
                <tr>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    ID
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Barcode
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Asset
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Last Serviced
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Health
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="asset in assets"
                  class="bg-white border-b"
                  :key="asset.id"
                >
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.id }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.barcode }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.name }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ asset.last_serviced }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <div class="w-full bg-gray-200 h-5 ">
                      <div
                        class="bg-red-600 h-5"
                        v-if="random >= 1 && random <= 25"
                        :style="{ width: random + '%' }"
                      ></div>
                      <div
                        class="bg-orange-600 h-5"
                        v-if="random >= 26 && random <= 50"
                        :style="{ width: random + '%' }"
                      ></div>
                      <div
                        class="bg-yellow-500 h-5"
                        v-if="random >= 51 && random <= 75"
                        :style="{ width: random + '%' }"
                      ></div>
                      <div
                        class="bg-green-600 h-5"
                        v-if="random >= 76 && random <= 100"
                        :style="{ width: random + '%' }"
                      ></div>
                    </div>
                  </td>
                  <td class="text-sm text-gray- font-light px-6 py-4 whitespace-nowrap">
                    <router-link
                      :to="{name: 'assetStatus', params: { id: asset.id, health: random }}"
                      tag="button"
                      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                    >View</router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <h2 class="font-semibold text-2xl">Work Order</h2>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full text-center">
              <thead class="border-b bg-gray-800">
                <tr>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Work Order ID
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Technician
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Asset
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Assigned By
                  </th>
                  <th
                    scope="col"
                    class="text-sm font-medium text-white px-6 py-4"
                  >
                    Status
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="work_order in work_orders"
                  class="bg-white border-b"
                  :key="work_order.id"
                >
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ work_order.work_order_id }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ work_order.technician }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ work_order.asset_name }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ work_order.supervisor }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <span
                      class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full"
                      v-if="work_order.status === 'Completed'"
                    >{{ work_order.status }}</span>
                    <span
                      class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-yellow-500 text-white rounded-full"
                      v-if="work_order.status === 'Pending'"
                    >{{ work_order.status }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      pending: 0,
      completed: 0,
      work_orders: {},
      assets: {},
      random: this.randomNumber(),
    };
  },
  mounted() {
    this.$http.get("/api/asset").then((response) => {
      this.assets = response.data.data;
    });
    axios.get("/api/work_order").then((response) => {
      this.work_orders = response.data.data;
      this.work_orders.forEach((tag) => {
        if (tag.status == "Pending") this.pending++;
        else if (tag.status == "Completed") this.completed++;
      });
    });
  },
  methods: {
    randomNumber() {
      return Math.floor(Math.random() * 100 + 1);
    },
  },
};
</script>