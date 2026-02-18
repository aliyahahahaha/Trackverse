<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-6">
            <!-- Navigation Switcher (Premium Pill) -->
            <div class="flex">
                <div
                    class="bg-base-100 rounded-full p-1 items-center shadow-sm border border-base-content/5 inline-flex transition-all">
                    <div
                        class="px-6 py-2 rounded-full hover:bg-base-200/50 text-base-content/60 font-bold text-[10px] tracking-widest transition-all">
                        ADMINISTRATION
                    </div>
                    <div class="w-px h-8 bg-base-content/5 mx-1"></div>
                    <div
                        class="px-6 py-2 rounded-full bg-primary/10 text-primary font-bold text-[10px] tracking-widest transition-all">
                        PERMISSION MANAGEMENT
                    </div>
                </div>
            </div>

            <!-- Main Header Content -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div
                        class="size-16 rounded-[1.5rem] bg-primary shadow-2xl shadow-primary/20 flex items-center justify-center text-primary-content shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                            <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 12l0 2.5" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <h1 class="text-3xl font-black text-base-content tracking-tight leading-none">Permission
                            Management</h1>
                        <p class="text-[13px] text-base-content/50 font-bold mt-0.5">Manage access levels and system
                            roles.</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('permissions.create') }}"
                        class="btn btn-primary h-12 px-8 gap-3 font-bold uppercase text-[10px] tracking-widest shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all rounded-2xl border-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        ADD PERMISSION
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Main Content -->
    <div class="mt-4">

        @if(session('success'))
            <div class="mb-6">
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

        <div
            class="card bg-base-100 shadow-xl shadow-base-content/5 border border-base-content/5 rounded-3xl overflow-hidden">
            <div class="card-body p-0">
                <form action="{{ route('permissions.update', 'bulk_update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="overflow-x-auto">
                        <table class="table align-middle">
                            <thead
                                class="bg-base-100 border-b border-base-content/5 text-base-content/40 uppercase text-[10px] font-bold tracking-widest">
                                <tr>
                                    <th class="px-8 py-5 w-1/3">Permission</th>
                                    @foreach($roles as $role)
                                        <th class="px-6 py-5 text-center">
                                            <div class="inline-flex flex-col items-center">
                                                <span
                                                    class="badge border border-{{ $role['color'] }} bg-{{ $role['color'] }}/5 text-{{ $role['color'] }} rounded-md font-bold text-[11px] uppercase tracking-widest py-3 px-4 min-w-[100px]">
                                                    {{ $role['name'] }}
                                                </span>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $perm)
                                    <tr
                                        class="group hover:bg-base-200/30 transition-all border-b border-base-content/5 last:border-0">
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col gap-1">
                                                <span
                                                    class="font-bold text-sm text-base-content/90 group-hover:text-primary transition-colors">{{ $perm['name'] }}</span>
                                                <span
                                                    class="text-xs text-base-content/50 font-medium">{{ $perm['description'] }}</span>
                                            </div>
                                        </td>
                                        @foreach($roles as $role)
                                            <td class="text-center px-6 py-5">
                                                <label
                                                    class="cursor-pointer inline-flex items-center justify-center p-2 rounded-lg hover:bg-base-200/50 transition-colors">
                                                    <input type="checkbox"
                                                        name="permissions[{{ $perm['id'] }}][{{ $role['key'] }}]"
                                                        class="checkbox checkbox-{{ $role['color'] }} checkbox-md border-2 rounded-lg"
                                                        @checked($perm['roles'][$role['key']]) />
                                                </label>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 bg-base-100 border-t border-base-content/5 flex justify-end">
                        <button type="submit"
                            class="btn btn-primary shadow-xl shadow-primary/20 font-bold px-8 h-12 rounded-2xl text-white uppercase text-[10px] tracking-widest border-none hover:scale-[1.02] active:scale-[0.98] transition-all gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            SAVE CHANGES
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>