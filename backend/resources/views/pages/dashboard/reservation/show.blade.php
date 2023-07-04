<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
 <div class="mb-10 border-b-slate-400 border-b pb-2">
            <h1 class="text-2xl text-black uppercase dark:text-white font-bold">Reservation detail</h1>
        </div>
        
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-6">
            @csrf
            <label for="id" class="block  text-sm font-semibold leading-6 uppercase text-slate-700">reservation id: {{ $reservation->id }}</label>
            
                <div class="col-span-1 grid grid-cols-2 gap-4 bg-white p-4 pb-6 rounded-lg shadow-lg border-slate-500">
                    <div class="col-span-1">
                        <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Name</label>
                        <div class="mt-2">
                            <input  name="name" type="text" disabled value="{{ $reservation->name }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"/>
                        </div>
                    </div>  

                    <div class="col-span-1">
                        <label  class="block font-semibold text-xs leading-6 uppercase text-slate-600">unit</label>
                        <div class="mt-2">
                            <input name="description" type="text" disabled value="{{ $reservation->description }}" class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"/>
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label 
                            for="created_at"  
                            class="block ms-1 font-semibold text-xs leading-6 uppercase text-slate-600"
                        >
                            Created at
                        </label>

                        <input 
                            type="datetime" 
                            name="created_at" 
                            value="{{ $reservation->created_at }}" 
                            class="p-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                        />
                    </div>
                    <div class="col-span-1">
                        <label 
                            for="created_at"  
                            class="block ms-1 font-semibold text-xs leading-6 uppercase text-slate-600"
                        >
                            Updated at
                        </label>

                        <input 
                            type="datetime" 
                            name="created_at" 
                            value="{{ $reservation->updated_at }}" 
                            class="p-2 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                        />
                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-row-reverse">
                <a href={{ route('reservations.index') }} class="bg-red-500 p-2 rounded-lg !text-white hover:bg-red-600">
                    Return reservation table
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