<div class="row">
    <div class="col w-full">
        <div class="card">
            <div class="card-header border-b-0">
                <div class="flex justify-between items-center">
                    <h2 class="font-medium text-2xl">{{ __("Meta tags") }}</h2>

                    @include("ma::admin.includes.meta-search")
                </div>
            </div>
            <div class="space-y-indent-half">
                <x-tt::notifications.error />
                <x-tt::notifications.success />
            </div>

            @include("ma::admin.includes.meta-table")
            @include("ma::admin.includes.meta-table-modals")
        </div>
    </div>
</div>
