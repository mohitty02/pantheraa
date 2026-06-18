@php $schema = config("cms.collections.$type"); @endphp
<x-admin-layout :title="$schema['title']">
    <livewire:admin.collection-manager :type="$type" :key="'col-'.$type" />
</x-admin-layout>
