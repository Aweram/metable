<x-tt::modal.aside wire:model="displayData">
    <x-slot name="title">{{ $metaId ? __("Edit meta") : __("Add meta") }}</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $metaId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="metaDataForm">
            <div>
                <label for="metaName" class="inline-block mb-2">
                    Name<span class="text-danger">*</span>
                </label>
                <input type="text" id="metaName"
                       class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="name">
                <x-tt::form.error name="name" />
            </div>

            <div>
                <label for="metaContent" class="inline-block mb-2">
                    Content<span class="text-danger">*</span>
                </label>
                <input type="text" id="metaContent"
                       class="form-control {{ $errors->has('content') ? 'border-danger' : '' }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="content">
                <x-tt::form.error name="content" />
            </div>

            <div>
                <label for="metaProperty" class="inline-block mb-2">
                    Property
                </label>
                <input type="text" id="metaProperty"
                       class="form-control {{ $errors->has('property') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model="property">
                <x-tt::form.error name="property" />
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    {{ __("Cancel") }}
                </button>
                <button type="submit" form="metaDataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $metaId ? __("Update") : __("Add") }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
