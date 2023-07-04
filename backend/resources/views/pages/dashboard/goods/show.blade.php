<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full h-full max-w-9xl mx-auto">
        <div class="mb-10 border-b-slate-400 border-b pb-2">
            <h1 class="text-2xl text-black uppercase dark:text-white font-bold">Goods detail</h1>
        </div>

        <form action="{{ route('goods.update', $goods->id) }}" method="POST" class="space-y-6">
            @csrf
            <label for="id" class="block  text-sm font-semibold leading-6 uppercase text-slate-700">Goods id: {{ $goods->id }}</label>


        <div class="grid gap-4 grid-cols-6">
                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            Position infomation
                        </p>
                    </div>
                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Position id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="user_id" type="text" disabled class="bg-slate-100" value="{{ $position->id ?? '' }}"></x-bewama::form.input.text>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Block name</label>
                        <div class="mt-2">
                            <input name="user_name" type="text" disabled value="{{ $position->block_name ?? '' }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Description</label>
                        <div class="mt-2">
                            <input name="user_email" type="text" disabled value="{{ $position->description ?? '' }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Shelf name</label>
                        <div class="mt-2">
                            <input name="user_email" type="text" disabled value="{{ $position->shelf_name ?? '' }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                </div>

                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            Category information
                        </p>
                    </div>

                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Category id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="user_id" type="text" disabled class="bg-slate-100" value="{{ $category->id ?? '_' }}"></x-bewama::form.input.text>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Category Name</label>
                        <div class="mt-2">
                            <input  
                                name="name" 
                                type="text" 
                                disabled 
                                value="{{ $category->name }}" 
                                class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>  

                    <div class="col-span-1">
                        <label  class="block font-semibold text-xs leading-6 uppercase text-slate-600">Category unit</label>
                        <div class="mt-2">
                            <input 
                                name="unit" 
                                type="text" 
                                disabled 
                                value="{{ $category->unit }}" 
                                class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label  class="block font-semibold text-xs leading-6 uppercase text-slate-600">Created at</label>
                        <div class="mt-2">
                            <input 
                                name="unit" 
                                type="text" 
                                disabled 
                                value="{{ $category->created_at }}" 
                                class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label  class="block font-semibold text-xs leading-6 uppercase text-slate-600">Update at</label>
                        <div class="mt-2">
                            <input 
                                name="unit" 
                                type="text" 
                                disabled 
                                value="{{ $category->updated_at }}" 
                                class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
            </div>  

            <div class="grid gap-4 grid-cols-6">
                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            Import information
                        </p>
                    </div>
                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Import id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="user_id" type="text" disabled class="bg-slate-100" value="{{ $goods->import_id }}"></x-bewama::form.input.text>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Created by user</label>
                        <div class="mt-2">
                            <input name="user_name" type="text" disabled value="{{ $import->user->name }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Customer</label>
                        <div class="mt-2">
                            <input name="user_email" type="text" disabled value="{{ $import->customer->name }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Created at</label>
                        <div class="mt-2">
                            <input name="user_dob" type="datetime" disabled value="{{ $import->created_at }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Updated at</label>
                        <div class="mt-2">
                            <input name="user_address" type="text" disabled value="{{ $import->updated_at }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>

                <div class="col-span-3 grid grid-cols-3 gap-2 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-3 border-b-slate-400 border-b pb-2">
                        <p class="text-sm w-full text-center font-semibold text-slate-600 uppercase">
                            Export information
                        </p>
                    </div>

                    <div class="col-span-1">
                        <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Export id</label>
                        <div class="mt-2">
                            <x-bewama::form.input.text name="user_id" type="text" disabled class="bg-slate-100" value="{{ $goods->export_id ?? '_' }}"></x-bewama::form.input.text>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Created by user</label>
                        <div class="mt-2">
                            <input name="user_name" type="text" disabled value="{{ $export->user->name ?? '_' }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Customer</label>
                        <div class="mt-2">
                            <input name="user_email" type="text" disabled value="{{ $export->customer->name ?? '_'}}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Created at</label>
                        <div class="mt-2">
                            <input name="user_dob" type="datetime" disabled value="{{ $export->created_at ?? '_'}}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Updated at</label>
                        <div class="mt-2">
                            <input name="user_address" type="text" disabled value="{{ $export->updated_at ?? '_'}}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                        </div>
                    </div>

                </div>
            </div>   
        </form>
    </div>

    <div class="w-full flex flex-row-reverse pe-8">
        <a href={{ route('goods.index') }} class="bg-red-500 p-2 rounded-lg !text-white hover:bg-red-600">
            Return block table
        </a>
        <div class="mr-4">
            <button type="submit" class="bg-green-500 p-2 rounded-lg !text-white hover:bg-green-600">
                Save changes
            </button>
        </div>
    </div>

    </form>
    </div>
</x-app-layout>