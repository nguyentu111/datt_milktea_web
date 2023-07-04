<x-app-layout>
    <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="col-span-3 border-b-slate-400 border-b pb-2">
                <p class="text-sm text-center font-semibold text-slate-600 uppercase">
                    Customer information
                </p>
            </div>
            <form action="{{ route('customers.update',$customer) }}" method="POST" class="space-y-6 col-span-3">
                @method('PUT')
                @csrf
                <div>
                    <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Cusomter id</label>
                    <div class="mt-2">
                        <x-bewama::form.input.text name="id" type="text" disabled class="bg-slate-100" placeholder="Please fill customer id" value="{{ $customer->id }}"></x-bewama::form.input.text>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Name</label>
                    <div class="mt-2">
                        <input name="name" type="text" value="{{ $customer->name }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Email</label>
                    <div class="mt-2">
                        <input name="email" type="text" value="{{ $customer->email }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
                    </div>
                </div>

                <div>
                    <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Phone number</label>
                    <div class="mt-2">
                        <input name="phone_number" type="text" value="{{ $customer->phone_number }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2 text-error" />
                    </div>
                </div>

                <div>
                    <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Address</label>
                    <div class="mt-2">
                        <input name="address" type="text" value="{{ $customer->address }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2 text-error" />
                    </div>
                </div>
                <div class="w-full flex gap-4 pt-2">
                    <a href="{{ route('customers.index') }}" class="bg-red-500 p-2 rounded-lg !text-white hover:bg-red-600">
                        Return customer table
                    </a>
                    <div class="mr-4">
                        <button type="submit" class="bg-green-500 p-2 rounded-lg !text-white hover:bg-green-600">
                            Save changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>