<nav class="flex items-center justify-between flex-wrap bg-orange-700 px-4">
    <div class="flex items-center flex-no-shrink text-white mr-6">
        <!-- <img src="{{ asset('/img/logo.png') }}" alt="logo" width="50" class="fill-current"/> -->
        <a class="font-semibold text-xl tracking-tight" href="{{ route('home') }}">Dashboard</a>
    </div>
    <div class="block sm:hidden">
        <button @click="toggle" class="flex items-center text-gray-200 border-gray-200 hover:text-white hover:border-white">
            <i class="fa fa-fw fa-bars"></i>
        </button>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="text-sm sm:flex-grow">

        </div>
        <div class="mt-2 md:mt-0">
            <dropdown align="right" width="200px">
                <template v-slot:trigger>
                    <button class="p-4 -mr-4 text-default text-center no-underline text-sm focus:outline-none text-gray-200 hover:bg-orange-800 hover:text-white" >
                        @auth
                            <avatar-component
                                name=""
                                initials="{{ auth()->user()->getInitials() }}"
                                color="{{ auth()->user()->avatar }}"
                            ></avatar-component>
                        @endauth
                    </button>
                </template>
                <form id="logout-form" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="dropdown-menu-link w-full text-left">Logout</button>
                </form>
            </dropdown>
        </div>
    </div>
</nav>
