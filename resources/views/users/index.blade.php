<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-base-100 rounded-xl border border-base-content/5 shadow-sm text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-base-content tracking-tight">User Management</h2>
                    <p class="text-sm text-base-content/60 font-medium mt-1">Manage system access and team roles.</p>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-3">
                <div class="px-4 py-2 bg-base-100 rounded-xl border border-base-content/5 shadow-sm text-xs font-bold text-base-content/70">
                    {{ $users->total() }} Active Users
                </div>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('users.create') }}" class="btn btn-primary h-10 px-5 rounded-xl font-black text-[10px] uppercase tracking-widest gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Add User
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="card bg-base-100 shadow-xl shadow-base-content/5 border border-base-content/5 rounded-3xl overflow-hidden mt-4">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="p-4">
                    <div
                        class="alert alert-success shadow-sm border-none bg-success/10 text-success font-bold text-sm rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="table align-middle">
                    <thead class="bg-base-100 border-b border-base-content/5 text-base-content/40 uppercase text-[10px] font-black tracking-[0.2em]">
                        <tr>
                            <th class="px-8 py-5">User</th>
                            <th class="py-5">Contact</th>
                            <th class="py-5">Role</th>
                            <th class="py-5 text-center">Status</th>
                            <th class="py-5">Joined</th>
                            <th class="text-end px-8 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($users as $user)
                            <tr class="group hover:bg-base-200/30 transition-all border-b border-base-content/5 last:border-0">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="avatar relative">
                                            <div class="w-11 h-11 rounded-2xl overflow-hidden shadow-sm border border-base-content/10 group-hover:scale-105 transition-transform">
                                                <img src="{{ $user->profile_photo_url }}"
                                                    alt="{{ $user->name }}" class="object-cover w-full h-full" />
                                            </div>
                                            @if($user->todayAvailability?->status === 'present')
                                                <div class="absolute -bottom-1 -right-1 size-3 bg-success rounded-full border-2 border-white"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-black text-base-content/90 text-sm group-hover:text-primary transition-colors">
                                                {{ $user->name }}
                                            </div>
                                            <div class="flex items-center gap-1 mt-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3 text-base-content/30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 8l2 0" /><path d="M15 12l2 0" /><path d="M7 16l10 0" /></svg>
                                                <span class="text-[10px] uppercase font-bold text-base-content/40 tracking-wider">ID: #{{ $user->id }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                   <div class="text-xs font-semibold text-base-content/70">
                                       {{ $user->email }}
                                   </div>
                                </td>
                                <td class="py-4">
                                    @if($user->isAdmin())
                                        <div class="badge bg-primary/10 text-primary border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6l4 6l5 -4l-2 10h-14l-2 -10l5 4z" /></svg>
                                            Admin
                                        </div>
                                    @elseif($user->isTeamLeader())
                                        <div class="badge bg-secondary/10 text-secondary border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z" /><path d="M5 21v-7" /></svg>
                                            Leader
                                        </div>
                                    @else
                                        <div class="badge bg-base-200/50 text-base-content/60 border-none rounded-lg font-black text-[10px] uppercase tracking-widest py-3 px-3 gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                            Member
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 text-center">
                                    @php $status = $user->todayAvailability?->status ?? 'present'; @endphp
                                    @if($status === 'present')
                                        <div class="inline-flex items-center justify-center p-1.5 rounded-lg bg-success/10 text-success" title="Available">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10" /></svg>
                                        </div>
                                    @elseif($status === 'medical_leave')
                                        <div class="inline-flex items-center justify-center p-1.5 rounded-lg bg-error/10 text-error" title="On Leave">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg>
                                        </div>
                                    @else
                                        <div class="inline-flex items-center justify-center p-1.5 rounded-lg bg-warning/10 text-warning" title="Vacation">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -5l-2 -5h3l2 2h4l-2 -7h3z" /></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-base-content/70">{{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                </td>
                                <td class="text-end px-8 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- View Button -->
                                            <a href="{{ route('users.show', $user) }}"
                                                class="btn btn-square btn-sm size-8 bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all rounded-lg"
                                                title="View Profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5">
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </a>

                                            <!-- Edit Button -->
                                            @if(auth()->user()->isAdmin() || auth()->id() === $user->id)
                                                <a href="{{ route('users.edit', $user) }}"
                                                    class="btn btn-square btn-sm size-8 bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-warning hover:text-warning hover:bg-warning/5 transition-all rounded-lg"
                                                    title="Edit Profile">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5">
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>
                                            @endif

                                            <!-- Delete Button -->
                                            @if(auth()->user()->isAdmin())
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-square btn-sm size-8 bg-base-100 text-base-content shadow-sm border border-base-content/10 hover:border-error hover:text-error hover:bg-error/5 transition-all rounded-lg"
                                                        title="Delete User">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="size-3.5">
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-20 bg-base-200/10">
                                    <div class="flex flex-col items-center gap-6">
                                        <div
                                            class="size-20 bg-base-200 rounded-full flex items-center justify-center shadow-inner">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-10 text-base-content/20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            </svg>
                                        </div>
                                        <p class="text-base-content/60 font-medium">No system users found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-8 py-4 border-t border-base-content/5 bg-base-200/20">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>