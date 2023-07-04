<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto ">
        <div class="mb-4 border-b-slate-400 border-b pb-2">
            <h1 class="text-xl text-black uppercase font-bold">Import detail</h1>
        </div>

        <form action="{{ route('imports.update',$import) }}" method="POST" class="space-y-6">
            @method('PUT')
            @csrf
            <label for="id" class="block  text-sm font-semibold leading-6 uppercase text-slate-700">Import id: {{ $import->id }}</label>
            <div class="flex">
                <div class="flex-auto me-2">
                    <label for="created_at" class="block ms-1 font-semibold text-xs leading-6 uppercase text-slate-600">
                        Created at
                    </label>

                    <input type="datetime" name="created_at" value="{{ $import->created_at }}" class="p-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                </div>
                <div class="flex-auto ms-2">
                    <label for="created_at" class="block ms-1 font-semibold text-xs leading-6 uppercase text-slate-600">
                        Updated at
                    </label>

                    <input type="datetime" name="created_at" value="{{ $import->updated_at }}" class="p-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                </div>
            </div>

            <div class="grid gap-4 grid-cols-6">
                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            user information
                        </p>
                    </div>
                    <div class="col-span-3 relative focus:fixed focus:-mt-2 focus:w-[40%] z-50">
                        <svg class="absolute inset-y-0 right-0 me-2 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                        <x-bewama::form.input.text id="search-user" name="search-user" type="text" placeholder="Search user" />
                    </div>

                    <div style="display: none;" id="result-user" class="fixed bg-white mt-20 p-2 border-2 rounded-lg overflow-auto panel col-span-3 panel-default z-50">
                        <table class="divide-y divide-gray-300 min-w-full">
                            <tbody id="memListUsers" class="table-body bg-white divide-y divide-gray-200">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">User id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="user_id" type="text" disabled class="bg-slate-100" placeholder="Please fill user id" value="{{ $import->user_id }}"></x-bewama::form.input.text>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Name</label>
                        <div class="mt-2">
                            <input name="user_name" type="text" disabled value="{{ $user->name }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Email</label>
                        <div class="mt-2">
                            <input name="user_email" type="text" disabled value="{{ $user->email }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Date of birth</label>
                        <div class="mt-2">
                            <input name="user_dob" type="datetime" disabled value="{{ $user->dob }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Address</label>
                        <div class="mt-2">
                            <input name="user_address" type="text" disabled value="{{ $user->address }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>

                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            Customer information
                        </p>
                    </div>

                    <div class="col-span-3 relative focus:fixed focus:-mt-2 focus:w-[40%] z-50">
                        <svg class="absolute inset-y-0 right-0 me-2 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                        <x-bewama::form.input.text id="search-customer" name="search-customer" type="text" placeholder="Search customer" />
                    </div>

                    <div style="display: none;" id="result-customer" class="fixed bg-white mt-20 p-2 border-2 rounded-lg overflow-auto panel col-span-3 panel-default z-50">
                        <table class="divide-y divide-gray-300 min-w-full">
                            <tbody class="table-body bg-white divide-y divide-gray-200" id="memListCustomers">

                            </tbody>
                        </table>
                    </div>

                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Cusomter id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="customer_id" type="text" disabled class="bg-slate-100" placeholder="Please fill customer id" value="{{ $import->customer_id }}"></x-bewama::form.input.text>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Name</label>
                        <div class="mt-2">
                            <input name="customer_name" type="text" disabled value="{{ $customer->name }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Email</label>
                        <div class="mt-2">
                            <input name="customer_email" type="text" disabled value="{{ $customer->email }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Phone number</label>
                        <div class="mt-2">
                            <input  name="customer_phone_number" type="text" disabled value="{{ $customer->phone_number }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Address</label>
                        <div class="mt-2">
                            <input name="customer_address" type="datetime" disabled value="{{ $customer->address }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border shadow-lg border-slate-500">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 uppercase py-3.5 text-left text-xs font-semibold text-gray-900">
                                {{ __('category ') }}
                            </th>
                            <th scope="col" class="px-3 uppercase py-3.5 text-left text-xs font-semibold text-gray-900">
                                {{ __('amount') }}
                            </th>
                            <th scope="col" class="px-3 uppercase py-3.5 text-left text-xs font-semibold text-gray-900">
                                {{ __('action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="import-detail" class="table-body bg-white divide-y divide-gray-200">
                        @empty($importDetails)
                        <tr>
                            <td colspan="{{ 5 }}">
                                <div class="py-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-500">{{ __('No record found.') }}</h3>
                                </div>
                            </td>
                        </tr>
                        @else
                        @foreach($importDetails as $index => $importDetail)
                        <tr class="detail-row">
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <select name="categories[]" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->getKey() === $importDetail['category_id']) selected @endif>
                                        {{ $category->name }} ({{ $category->unit }})
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <input name='amounts[]' type="number" required min=1 value={{ $importDetail['amount'] }} class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                            </td>
                            <td>
                                <span class="btn-delete hover:bg-red-400 hover:text-white inline-flex items-center rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700 cursor-pointer">{{ 'Delete' }}</span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="detail-add">
                            <td colspan="5">
                                <button type="button" class="flex items-center justify-center w-full p-4 mx-0 btn-add-import-detail hover:text-slate-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Add new import detail
                                </button>
                            </td>
                        </tr>
                        @endempty
                    </tbody>
                </table>
            </div>

            <div class="w-full flex flex-row-reverse">
                <a href={{ route('imports.index') }} class="bg-red-500 p-2 rounded-lg !text-white hover:bg-red-600">
                    Return import table
                </a>
                <div class="mr-4">
                    <button id="btnSaveChange" type="submit" class="bg-green-500 p-2 rounded-lg !text-white hover:bg-green-600">
                        Save changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>