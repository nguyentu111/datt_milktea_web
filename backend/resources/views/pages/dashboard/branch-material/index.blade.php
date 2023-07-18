<x-app-layout>
    <div class="mt-6 p-6">
        <span class="block pb-4 uppercase font-bold text-gray-900 text-[20px]">{{Auth::user()->staff->branch->name}} materials</span>
        <div class="bg-white rounded-md h-[400px] overflow-auto grid grid-cols-4">
            @foreach($materials as $material)
            <div class="flex px-4 py-2">
                <img class="h-20 w-20 object-cover block" src="{{$material->picture}}" />
                <div class="ml-4 block">
                    <span class="block">{{$material->name}}</span>
                    <span class="block">{{floatval($material->pivot->amount)}} {{$material->uom->name}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @push('script')
    <script>
        console.log(<?php echo json_encode($materials) ?>);
    </script>
    @endpush
</x-app-layout>