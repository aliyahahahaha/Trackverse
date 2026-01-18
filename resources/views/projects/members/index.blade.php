<x-app-layout>
    <x-slot name="header">
        <div class="space-y-6 pb-2">
            <!-- Back Button & Breadcrumb Row (FIXED) -->
            <div class="flex items-center gap-4">
                <a href="{{ route('projects.show', $project) }}" 
                   class="btn btn-sm h-9 min-h-0 rounded-full px-5 bg-base-100 hover:bg-primary hover:text-primary-content border border-base-content/10 hover:border-primary gap-2 font-bold shadow-sm group transition-all">
                    <span class="text-[10px] uppercase tracking-widest text-base-content/60 group-hover:text-current">← BACK TO PROJECT</span>
                </a>

                <div class="h-4 w-px bg-base-content/20"></div>

                <!-- Breadcrumb -->
                <nav class="flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-base-content/40">
                    <ol class="flex items-center gap-2">
                        <li><a href="{{ route('projects.index') }}" class="hover:text-primary transition-colors">Projects</a></li>
                        <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" style="width: 10px; height: 10px;" class="opacity-30 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                        <li><a href="{{ route('projects.show', $project) }}" class="hover:text-primary transition-colors">{{ $project->name }}</a></li>
                        <li class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" style="width: 10px; height: 10px;" class="opacity-30 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6l-6 6" /></svg></li>
                        <li class="text-base-content/60">Members</li>
                    </ol>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                <div class="size-9 bg-primary/10 rounded-xl flex items-center justify-center text-primary shadow-sm border border-primary/5">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>
                </div>
                <h2 class="text-2xl font-black text-base-content tracking-tight">Manage Team</h2>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add Member Form -->
        <div class="lg:col-span-1">
            <div class="card bg-base-100 border border-base-content/5 shadow-xl shadow-base-content/[0.02] rounded-3xl sticky top-6">
                <div class="card-body p-6">
                    <h3 class="text-xs font-black uppercase tracking-widest text-base-content/40 flex items-center gap-2 mb-6">
                        Add Member
                    </h3>

                    <form action="{{ route('projects.members.store', $project) }}" method="POST">
                        @csrf

                        <div class="form-control mb-6">
                            <x-ui.advance-select 
                                name="user_id" 
                                label="Member" 
                                placeholder="Search user to add..."
                                :multiple="false"
                                :options="$users->map(fn($u) => [
                                    'value' => $u->id, 
                                    'label' => $u->name, 
                                    'description' => $u->email, 
                                    'image' => $u->profile_photo_url
                                ])->toArray()"
                            />
                        </div>

                        <button type="submit" class="btn btn-primary h-11 w-full rounded-xl font-black uppercase tracking-widest text-[9px] shadow-lg shadow-primary/20">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Confirm Access
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Members List -->
        <div class="lg:col-span-2">
            <div class="card bg-base-100 border border-base-content/5 shadow-xl shadow-base-content/[0.02] rounded-3xl">
                <div class="card-body p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xs font-black uppercase tracking-widest text-base-content/40 flex items-center gap-2">
                            Team
                        </h3>
                        <span class="px-2.5 py-1 bg-base-200 text-base-content/40 rounded-lg text-[10px] font-black">{{ $members->count() }} TOTAL</span>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            <span class="icon-[tabler--check] size-5"></span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error mb-4">
                            <span class="icon-[tabler--alert-circle] size-5"></span>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($members->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="table table-zebra">
                                <thead>
                                    <tr class="text-[9px] font-black uppercase tracking-widest text-base-content/30 border-b border-base-content/5">
                                        <th class="py-4">Member</th>
                                        <th class="py-4 text-center">Status</th>
                                        <th class="py-4 text-right">Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                        <tr class="hover">
                                            <td>
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-shrink-0" style="width: 36px; height: 36px; min-width: 36px; min-height: 36px;">
                                                        <div class="w-full h-full rounded-full overflow-hidden shadow-sm border-2 border-primary/10 p-0.5 bg-base-200">
                                                            <img src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}" 
                                                                class="object-cover w-full h-full rounded-full pointer-events-none" 
                                                                style="width: 100% !important; height: 100% !important; display: block;" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-[11px] font-black text-base-content leading-tight">{{ $member->name }}</div>
                                                        <div class="text-[9px] text-base-content/30 font-bold uppercase tracking-widest leading-none">{{ $member->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                @if($member->id === $project->created_by)
                                                    <div class="badge badge-soft badge-primary badge-sm py-2 px-3 font-black uppercase text-[8px] border-none rounded-lg">
                                                        Owner
                                                    </div>
                                                @else
                                                    <div class="badge badge-soft badge-neutral badge-sm py-2 px-3 font-black uppercase text-[8px] border-none rounded-lg">
                                                        Member
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if($member->id !== $project->created_by)
                                                    <form action="{{ route('projects.members.destroy', [$project, $member]) }}" method="POST" 
                                                          onsubmit="return confirm('Revoke access for {{ $member->name }}?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="btn btn-square btn-sm btn-ghost hover:bg-error/10 hover:text-error transition-all rounded-xl"
                                                            title="Revoke Access">
                                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" class="flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <div class="flex justify-end mr-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;" class="text-base-content/10 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                                            <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                            <path d="M8 11v-5a4 4 0 1 1 8 0v4" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-base-200 mb-3">
                                <span class="icon-[tabler--users] size-6 text-base-content/40"></span>
                            </div>
                            <p class="text-base-content/60">No members yet. Add members using the form on the left.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>