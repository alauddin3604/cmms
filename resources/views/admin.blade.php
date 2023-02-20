@extends('layouts.app')
@section('content')
<div class="flex">
  <aside class="w-60 fixed left-0 top-0 h-screen shadow-md bg-gray-800 p-1">
    <div class="pt-4 pb-2 px-6 mt-20 mb-5">
        <div class="grid grid-flow-row place-items-center justify-center">
          <div class="shrink-0 row-span-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 bg-white rounded-lg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3 row-span-1">
            <p class="text-sm font-semibold text-white item-center">{{ Auth::guard('admin')->user()->name }}</p>
            <p class="text-xs text-white">Admin</p>
          </div>
        </div>
    </div>
    <ul class="relative">
      <li class="relative">
        <router-link
          class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
          data-mdb-ripple="true" data-mdb-ripple-color="dark" to="/admin/dashboard">Dashboard</router-link>
      </li>
      <li class="relative">
        <router-link
          class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
          data-mdb-ripple="true" data-mdb-ripple-color="dark" to="/admin/asset-management">Asset</router-link>
      </li>
      <li class="relative">
        <router-link
          class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
          data-mdb-ripple="true" data-mdb-ripple-color="dark" to="/admin/supervisor-management">Supervisor</router-link>
      </li>
      <li class="relative">
        <router-link
          class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap rounded transition duration-300 ease-in-out"
          data-mdb-ripple="true" data-mdb-ripple-color="dark" to="/admin/technician-management">Technician</router-link>
      </li>
    </ul>
    <div class="text-center bottom-0 absolute w-full">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-slate-50 text-ellipsis whitespace-nowrap hover:underline">Log
        Out</a>
    </div>
  </aside>
  <div class="flex-1 ml-60 bg-gray-100 ">
    <header class="fixed bg-gray-900 shadow-md z-50 w-full px-100 py-5 flex justify-between items-center"></header>
    <main class="bg-gray-100 p-10 w-full h-full mt-8 flex justify-center">
      <router-view></router-view>
    </main>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
  </form>
</div>
@endsection