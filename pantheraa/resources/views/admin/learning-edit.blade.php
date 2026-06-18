<x-admin-layout :title="$id ? 'Edit learning' : 'New learning'">
    <livewire:admin.learning-editor :learningId="$id" />
</x-admin-layout>
