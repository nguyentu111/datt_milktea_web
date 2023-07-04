<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full h-full max-w-9xl mx-auto">
        <div class="mb-10 border-b-slate-400 border-b pb-2">
            <h1 class="text-2xl text-black uppercase dark:text-white font-bold">Position detail</h1>
        </div>

        <form action="{{ route('positions.update', $position) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="user_id" class="block font-semibold text-xs leading-6 uppercase text-slate-600">Position id</label>
                <div class="mt-2">
                    <x-bewama::form.input.text name="id" type="text" disabled class="bg-slate-100" placeholder="Please fill user id" value="{{ $position->id }}"></x-bewama::form.input.text>
                </div>
            </div>

            <div>
                <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Shelf name</label>
                <div class="mt-2">
                    <input name="shelf_name" type="text" value="{{ $position->shelf_name }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                    <x-input-error :messages="$errors->get('shelf_name')" class="mt-2 text-error" />
                </div>
            </div>

            <div>
                <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Block name</label>
                <div class="mt-2">
                    <input name="block_name" type="text" value="{{ $position->block_name }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                    <x-input-error :messages="$errors->get('block_name')" class="mt-2 text-error" />
                </div>
            </div>

            <div>
                <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Description</label>
                <div class="mt-2">
                    <input name="description" type="text" value="{{ $position->description }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2 text-error" />
                </div>
            </div>
            <div>
                <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Created at</label>
                <div class="mt-2">
                    <input name="created_at" type="datetime" value="{{ $position->created_at }}" class="pl-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                    <x-input-error :messages="$errors->get('created_at')" class="mt-2 text-error" />
                </div>
            </div>
        </div>

        <div class="w-full flex flex-row-reverse pe-8">
            <a href={{ route('positions.index') }} class="bg-red-500 p-2 rounded-lg !text-white hover:bg-red-600">
                Return position table
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