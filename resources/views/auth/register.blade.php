<x-layout>
    <div class="min-h-screen w-full flex">
        <div id="section" class="w-full">
            <div class="flex flex-col items-center justify-center py-8 mx-auto h-screen lg:py-0">
                <div
                    class="justify-center items-center w-full bg-[#FFFFFF] rounded-lg md:mt-0 sm:max-w-lg xl:p-0 dark:bg-[#18181B] ring-1 ring-white/10 shadow-sm">
                    <div class="p-8 space-y-4 md:space-y-6 sm:p-10">
                        <div class="flex items-center justify-center">
                            <h1 class="text-xl text-white text-center font-bold">Pustakawan</h1>
                        </div>
                        <h1
                            class="text-xl font-bold text-center leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign up
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="{{ route('register.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name<span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[rgb(59,130,246)] focus:border-[rgb(59,130,246)] block w-full p-2 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[rgb(59,130,246)] dark:focus:border-[rgb(59,130,246)]"
                                    required="" autofocus>
                                @error('name')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                    address<span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[rgb(59,130,246)] focus:border-[rgb(59,130,246)] block w-full p-2 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[rgb(59,130,246)] dark:focus:border-[rgb(59,130,246)]"
                                    required="">
                                @error('email')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password<span
                                        class="text-red-500">*</span></label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[rgb(59,130,246)] focus:border-[rgb(59,130,246)] block w-full p-2 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[rgb(59,130,246)] dark:focus:border-[rgb(59,130,246)] pr-10"
                                    required="">
                                @error('password')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-2 top-[30px] border-l border-[#D1D5DB] dark:border-[#464649] pl-2 flex items-center text-gray-500 hover:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-5 open-eye-icon">
                                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        <path fill-rule="evenodd"
                                            d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-5 hidden closed-eye-icon">
                                        <path fill-rule="evenodd"
                                            d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l14.5 14.5a.75.75 0 1 0 1.06-1.06l-1.745-1.745a10.029 10.029 0 0 0 3.3-4.38 1.651 1.651 0 0 0 0-1.185A10.004 10.004 0 0 0 9.999 3a9.956 9.956 0 0 0-4.744 1.194L3.28 2.22ZM7.752 6.69l1.092 1.092a2.5 2.5 0 0 1 3.374 3.373l1.091 1.092a4 4 0 0 0-5.557-5.557Z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="m10.748 13.93 2.523 2.523a9.987 9.987 0 0 1-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 0 1 0-1.186A10.007 10.007 0 0 1 2.839 6.02L6.07 9.252a4 4 0 0 0 4.678 4.678Z" />
                                    </svg>

                                </button>
                            </div>

                            <h1 class="text-[12px] text-[#888888]">You have an account? <a href="/admin/login"
                                    class="text-blue-500 hover:underline">Sign in</a>
                            </h1>

                            <button id="signup-button" type="submit"
                                class="flex items-center justify-center w-full text-white bg-[rgb(59,130,246)] hover:bg-[#60A5FA] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <svg id="loading-spinner" class="hidden w-5 h-5 text-white animate-spin mr-2"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                <span id="button-text">Sign up</span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout>
{{-- <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <h1
        class="text-xl font-bold text-center leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        Sign up
    </h1>
    <form class="space-y-4 md:space-y-6" action="{{ route('register.store') }}" method="POST">
        @csrf
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                name</label>
            <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#06B6D4] focus:border-[#06B6D4] block w-full p-2.5 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[#06B6D4] dark:focus:border-[#06B6D4]"
                placeholder="admin" required="">
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                email</label>
            <input type="email" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#06B6D4] focus:border-[#06B6D4] block w-full p-2.5 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[#06B6D4] dark:focus:border-[#06B6D4]"
                placeholder="name@pustakawan.com" required="">
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative">
            <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#06B6D4] focus:border-[#06B6D4] block w-full p-2.5 dark:bg-[#242427] dark:border-[#464649] dark:placeholder-[#464649] dark:text-white dark:focus:ring-1 dark:focus:ring-[#06B6D4] dark:focus:border-[#06B6D4] pr-10"
                placeholder="••••••••" required="">
            @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <button type="button" id="togglePassword"
                class="absolute inset-y-0 right-2 top-[30px] flex items-center text-gray-500 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="size-5 open-eye-icon">
                    <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                    <path fill-rule="evenodd"
                        d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                        clip-rule="evenodd" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="size-5 hidden closed-eye-icon">
                    <path fill-rule="evenodd"
                        d="M3.28 2.22a.75.75 0 0 0-1.06 1.06l14.5 14.5a.75.75 0 1 0 1.06-1.06l-1.745-1.745a10.029 10.029 0 0 0 3.3-4.38 1.651 1.651 0 0 0 0-1.185A10.004 10.004 0 0 0 9.999 3a9.956 9.956 0 0 0-4.744 1.194L3.28 2.22ZM7.752 6.69l1.092 1.092a2.5 2.5 0 0 1 3.374 3.373l1.091 1.092a4 4 0 0 0-5.557-5.557Z"
                        clip-rule="evenodd" />
                    <path
                        d="m10.748 13.93 2.523 2.523a9.987 9.987 0 0 1-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 0 1 0-1.186A10.007 10.007 0 0 1 2.839 6.02L6.07 9.252a4 4 0 0 0 4.678 4.678Z" />
                </svg>

            </button>
        </div>

        <button id="signup-button" type="submit"
            class="flex items-center justify-center w-full text-white bg-[#06B6D4] hover:bg-[#06B6D4]/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg id="loading-spinner" class="hidden w-5 h-5 text-white animate-spin mr-2"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span id="button-text">Sign up</span>
        </button>

    </form>
</div> --}}
