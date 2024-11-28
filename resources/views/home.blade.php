<x-layout>
    <div
        class="relative min-h-screen isolate overflow-hidden bg-[#09090B] px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
        <svg viewBox="0 0 1024 1024"
            class="absolute left-1/2 top-1/2 -z-10 size-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
            aria-hidden="true">
            <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)"
                fill-opacity="0.7" />
            <defs>
                <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                    <stop stop-color="#60A5FA" />
                    <stop offset="1" stop-color="rgb(59,130,246)" />
                </radialGradient>
            </defs>
        </svg>
        <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
            <h2 class="text-balance text-3xl font-semibold tracking-tight text-white sm:text-4xl">Boost your
                productivity. Start using our app today.</h2>
            <p class="mt-6 text-pretty text-lg text-gray-300">This library application is designed to manage <span
                    class="font-semibold text-[rgb(59,130,246)]">book collections</span>, <span
                    class="font-semibold text-[rgb(59,130,246)]">borrowing transactions</span>, <span
                    class="font-semibold text-[rgb(59,130,246)]">returns</span>, and <span
                    class="font-semibold text-[rgb(59,130,246)]">member</span>. This application
                increases inventory
                efficiency and makes it easier for users to search and borrow books.
            </p>
            <div class="mt-10 flex justify-center items-center gap-x-6 text-black lg:justify-start">
                <a class="flex h-min items-center disabled:opacity-50 disabled:hover:opacity-50 hover:opacity-95 justify-center ring-none rounded-lg shadow-lg font-semibold py-2 px-4 font-dm focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-[rgb(59,130,246)] border-b-[rgb(27,61,116)] disabled:border-0 disabled:bg-[rgb(59,130,246)] disabled:text-white ring-white text-white border-b-4 hover:border-0 active:border-0 hover:text-gray-100 active:bg-[rgb(59,130,246)] active:text-gray-300 focus-visible:outline-[rgb(59,130,246)] text-sm sm:text-base"
                    href="/register">
                    Create account
                </a>
                <a class="flex h-min items-center disabled:opacity-50 disabled:hover:opacity-50 hover:opacity-95 justify-center ring-none rounded-lg shadow-lg font-semibold py-2 px-4 font-dm focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-[rgb(59,130,246)] border-b-[rgb(27,61,116)] disabled:border-0 disabled:bg-[rgb(59,130,246)] disabled:text-white ring-white border-b-4 hover:border-0 active:border-0 active:bg-[rgb(59,130,246)] focus-visible:outline-[rgb(59,130,246)] text-sm sm:text-base"
                    href="/admin/login">
                    Sign in
                </a>
            </div>
        </div>
        <div class="relative mt-16 h-80 lg:mt-8">
            <img class="absolute left-0 top-0 w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                src="images/HERO_SECTION_1.png" alt="App screenshot" width="1824" height="1080">
        </div>
        <div class="hidden relative lg:flex mt-16 h-80 lg:mt-8">
            <img class="absolute left-0 top-[12em] w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                src="images/HERO_SECTION_2.png" alt="App screenshot" width="1824" height="1080">
        </div>
    </div>
</x-layout>
