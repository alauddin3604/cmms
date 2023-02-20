@extends('layouts.app')
@section('content')
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-12">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Log In
            </h2>
        </div>
        <form class="mt-8 space-y-6 form-floating" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="hidden" name="remember" value="true" />
            <div class="rounded-md -space-y-px">
                <div>
                    <div class="flex justify-center mb-6">
                        <div>
                            <div class="flex items-center">
                                <input
                                    class="default:ring-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                    type="radio" name="role" id="admin" value="admin" {{ old('role') ? 'checked' : '' }}>
                                <label class="ml-2 font-medium" for="admin">
                                    Admin
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input
                                    class="default:ring-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                    type="radio" name="role" id="supervisor" value="supervisor" {{ old('role') ? 'checked' : '' }}>
                                <label class="ml-2 font-medium" for="supervisor">
                                    Supervisor
                                </label>
                            </div>
                        </div>
                    </div>
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Email address" value="{{ old('email') }}" autofocus />
                </div>
            </div>
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Password" />
                </div>
            </div>

            <!-- <div class="flex items-center justify-between">
                <div class="text-sm">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Forgot your password?
                    </a>
                </div>
            </div> -->
            @error('credentials')
            <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                {{ $message }}
            </div>
            @enderror
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection()