<div class="bg-base-100/80 backdrop-blur-md border-b border-base-content/[0.08] sticky top-0 z-40 flex flex-shrink-0">
    <div class="w-full px-6">
        <nav class="navbar h-16 min-h-[4rem] p-0">
            <div class="navbar-start items-center gap-3">
                <button type="button" class="btn btn-ghost btn-square btn-sm lg:hidden hover:bg-base-content/10" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6l16 0" /><path d="M4 12l16 0" /><path d="M4 18l16 0" /></svg>
                </button>
            </div>

            <div class="navbar-end items-center gap-4">
                <!-- Profile Dropdown -->
                <div class="dropdown dropdown-end relative inline-flex [--offset:12]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar p-0.5 rounded-xl transition-all hover:bg-base-content/5" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <div class="size-9 rounded-xl overflow-hidden border border-base-content/10 shadow-sm relative">
                            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                class="object-cover w-full h-full" />
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 min-w-72 hidden shadow-2xl border border-base-content/5 rounded-2xl overflow-hidden" role="menu"
                        aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header pt-5 px-6 pb-4 bg-base-content/[0.02]">
                            <div class="flex items-center gap-4">
                                <div class="avatar online">
                                    <div class="size-10 rounded-xl overflow-hidden border border-base-content/10">
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                            class="object-cover w-full h-full" />
                                    </div>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <h6 class="text-[13px] font-black text-base-content truncate">{{ auth()->user()->name }}</h6>
                                    <p class="text-[10px] font-bold text-base-content/40 truncate mt-0.5">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            
                            <!-- Status Selector -->
                            <form action="{{ route('availability.update') }}" method="POST" class="mt-4 border-t border-base-content/5 pt-3">
                                @csrf
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-base-content/30">Current Status</span>
                                        <div class="badge badge-soft badge-primary text-[8px] font-black uppercase tracking-tighter h-4">Live</div>
                                    </div>
                                    <select name="status" onchange="this.form.submit()"
                                        class="select select-sm select-bordered w-full h-9 min-h-[2.25rem] text-[10px] font-black uppercase tracking-wider rounded-xl bg-base-200/50 border-base-content/5 focus:border-primary/30 transition-all cursor-pointer text-primary">
                                        @php $currentStatus = auth()->user()->todayAvailability?->status ?? 'present'; @endphp
                                        <option value="present" {{ $currentStatus == 'present' ? 'selected' : '' }}>Available</option>
                                        <option value="medical_leave" {{ $currentStatus == 'medical_leave' ? 'selected' : '' }}>On Leave</option>
                                        <option value="vacation" {{ $currentStatus == 'vacation' ? 'selected' : '' }}>Vacation</option>
                                    </select>
                                </div>
                            </form>
                        </li>
                        <hr class="border-base-content/5 my-0">
                        <li class="px-3 pt-3">
                            <a class="flex items-center w-full h-11 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-base-content/60 hover:text-primary hover:bg-primary/5 border border-transparent hover:border-primary/10 transition-all group" href="{{ route('users.edit', auth()->user()) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-3 opacity-50 group-hover:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                Account Settings
                            </a>
                        </li>
                        <li class="px-3 pb-3 mt-1">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full h-11 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest text-error hover:bg-error/5 border border-transparent hover:border-error/10 transition-all group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-3 opacity-50 group-hover:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>