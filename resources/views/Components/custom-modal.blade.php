@props(['title','showModal' => 'showModal','modalWidth'=>'tw-w-7/12'])

<div x-show="{{ $showModal }}" class="overlay-modal-x tw-fixed  tw-inset-0 tw-overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div  class="tw-flex tw-items-end tw-justify-center tw-min-h-screen tw-pt-4 tw-px-4 tw-pb-20 tw-text-center sm:tw-block sm:tw-p-0">
        <div x-show="{{ $showModal }}" x-transition:enter="tw-ease-out tw-duration-300" x-transition:enter-start="tw-opacity-0"
            x-transition:enter-end="tw-opacity-100" x-transition:leave="tw-ease-in tw-duration-200" x-transition:leave-start="tw-opacity-100"
            x-transition:leave-end="tw-opacity-0" class="tw-fixed tw-inset-0 tw-bg-gray-500 tw-bg-opacity-75 tw-transition-opacity" aria-hidden="true"></div>

        <span class="tw-hidden sm:tw-inline-block sm:tw-align-middle sm:tw-h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="{{ $showModal }}" x-transition:enter="tw-ease-out tw-duration-300" x-transition:enter-start="tw-opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
            x-transition:enter-end="tw-opacity-100 tw-translate-y-0 sm:tw-scale-100" x-transition:leave="tw-ease-in tw-duration-200"
            x-transition:leave-start="tw-opacity-100 tw-translate-y-0 sm:tw-scale-100" x-transition:leave-end="tw-opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
            class="tw-inline-block tw-align-bottom tw-bg-white tw-rounded-lg tw-px-4 tw-pt-5 tw-pb-4 tw-text-left tw-overflow-hidden tw-shadow-xl tw-transform transition-all sm:tw-my-8 sm:tw-align-middle tw-w-full sm:{{ $modalWidth }} sm:tw-p-6">
            <div>
                <h3 class="tw-text-xl tw-border-b tw-border-neutral-700 tw-py-2 tw-w-fit tw-mx-3  tw-mb-8 tw-leading-6 tw-font-semibold tw-text-gray-900" id="modal-title">
                    {{ $title }}
                </h3>
                <div class="tw-mt-3 tw-mb-9">
                    <!-- Form for Editing Row -->
                    <form>
                        {{$slot}}
                    </form>
                </div>
            </div>
           {{--  <div class="tw-mt-8 tw-px-3 sm:tw-mt-4 sm:tw-flex sm:tw-flex-row-reverse">
               
                <button x-on:click="showModal = false" type="button"
                    class="tw-mt-3 tw-inline-flex tw-justify-center tw-w-full sm:tw-w-auto sm:tw-mt-0 tw-px-4 tw-py-2 tw-bg-white tw-border tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-text-base tw-font-medium tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 sm:tw-text-sm">
                    Cancel
                </button>
            </div> --}}
        </div>
    </div>
</div>