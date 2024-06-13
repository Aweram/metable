<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-header">
                <h2 class="font-medium text-2xl">{{ __("Meta tags") }}</h2>
            </div>
            <div class="card-body">
                @include("ma::admin.includes.meta-search")
                <x-tt::notifications.error />
                <x-tt::notifications.success />
            </div>

            @include("ma::admin.includes.meta-table")
            @include("ma::admin.includes.meta-table-modals")
        </div>
    </div>
</div>
