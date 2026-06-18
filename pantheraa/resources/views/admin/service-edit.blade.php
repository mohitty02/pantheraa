<x-admin-layout :title="$id ? 'Edit service' : 'New service'">
    <livewire:admin.service-editor :serviceId="$id" />
</x-admin-layout>
