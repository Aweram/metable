<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading class="text-left">{{ __("Render tag") }}</x-tt::table.heading>
            <x-tt::table.heading class="text-left">{{ __("Create og") }}</x-tt::table.heading>
            <x-tt::table.heading>{{ __("Actions") }}</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($metas as $item)
            <tr>
                <td>
                    <code class="text-[#d63384] text-sm">{!! htmlspecialchars($item->clear_render) !!}</code>
                </td>
                <td>{{ $item->separated ? __("Yes") : __("No") }}</td>
                <td>Actions</td>
            </tr>
        @endforeach
    </x-slot>
</x-tt::table>
