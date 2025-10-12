@guest
    @include('layouts.partials.guest-navigation')
@endguest

@auth
    <nav x-data="{ open: false }" class="bg-slate-900/40 backdrop-blur border-b border-white/10 relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="/">
                            <img src="{{ asset('storage/logo-rekandana.png') }}" alt="" class="w-16 drop-shadow">
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="url('/')" :active="request()->is('/')">
                            Home
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        @if(auth()->user()->role === 'mahasiswa')
                            <x-nav-link :href="route('mahasiswa.proposals.create')" :active="request()->routeIs('proposals.create')">
                                Ajukan Proposal
                            </x-nav-link>
                            <x-nav-link :href="route('mahasiswa.proposals.index')" :active="request()->routeIs('proposals.index')">
                                Proposal Saya
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'sponsor')
                            <x-nav-link :href="route('sponsor.proposals.index')" :active="request()->routeIs('sponsor.proposals.index')">
                                Cari Proposal
                            </x-nav-link>
                            <x-nav-link :href="route('sponsor.proposals.direct')" :active="request()->routeIs('sponsor.proposals.direct')">
                                Direct Proposal
                            </x-nav-link>
                            <x-nav-link :href="route('sponsor.proposals.saved')" :active="request()->routeIs('sponsor.proposals.saved')">
                                Disimpan
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.proposals.index')" :active="request()->routeIs('admin.proposals.index')">
                                Moderasi Proposal
                            </x-nav-link>
                            <x-nav-link :href="route('admin.proposals.history')" :active="request()->routeIs('admin.proposals.history')">
                                History Proposal
                            </x-nav-link>
                            <x-nav-link :href="route('admin.referral-codes.index')" :active="request()->routeIs('admin.referral-codes.*')">
                                Kode Referral
                            </x-nav-link>
                        @endif
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-white/10 text-sm leading-4 font-medium rounded-md text-gray-200 bg-slate-800/50 hover:bg-slate-700/50 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                </div>

            <div class="pt-4 pb-1 border-t border-white/10">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@endauth
