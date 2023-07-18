<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new supplier</h2>
                </div>
                <form method="POST" action="{{ route('suppliers.store') }}" class="">
                    @csrf

                    <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Supplier name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="name" value="{{ old('name')}}" type="name" placeholder="Please fill name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Address') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="address" value="{{ old('address')}}" type="address" placeholder="Please fill address" />
                                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <label for="phone" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Phone') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="phone" value="{{ old('phone')}}" type="phone" placeholder="Please fill phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-error" />
                                </div>
                            </div>


                            <div class="flex items-center gap-4">

                                <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary'>
                                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                    Submit
                                </button>
                                <a href="{{ route('suppliers.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                    Return supplier table
                                </a>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>