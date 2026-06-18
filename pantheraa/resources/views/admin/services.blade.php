<x-admin-layout title="Services">
    @if(session('status'))
        <div class="mb-5 rounded-xl border border-volt-500/30 bg-volt-500/10 px-4 py-3 text-sm text-white">{{ session('status') }}</div>
    @endif
    <livewire:admin.services-index />
</x-admin-layout>
