<x-app-layout>
    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Create new customer</h2>
                </div>

                <div class="mt-7">
                    <form method="POST" action="{{ route('customers.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Email address') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="email" value="{{ old('email')}}" type="email" placeholder="Please fill email"></x-bewama::form.input.text>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
                            </div>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Name') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="name" type="text" value="{{ old('name')}}" placeholder="Please fill name"></x-bewama::form.input.text>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Address') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="address" type="text" value="{{ old('address')}}" placeholder="Please fill address"></x-bewama::form.input.text>
                                <x-input-error :messages="$errors->get('address')" class="mt-2 text-error" />
                            </div>
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Phone number') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="phone_number" type="text" value="{{ old('phone_number')}}" placeholder="Please fill phone number"></x-bewama::form.input.text>
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2 text-error" />
                            </div>
                        </div>

                        <input class="hidden" type="checkbox" name="working" checked />

                        <div class="flex items-center gap-4">

                            <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary'>
                                <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                Submit
                            </button>
                            <a href="{{ route('customers.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                Return customer table
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
</x-app-layout>