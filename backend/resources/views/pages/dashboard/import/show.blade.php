<x-app-layout>
    <div class="flex min-h-full mx-6 pb-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Import detail</h2>
                </div>
                <form id='create-import-form' method="POST" action="{{ route('imports.store') }}" class="">
                    @csrf
                    <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white mb-4">
                        <div class=" gap-6">
                            <div class="flex items-center ">
                                <input disabled type="radio" id='from-supplier' name='from' class="mr-4" @if($import->supplier_id) checked @endif/>
                                <label for='from-supplier'>From supplier</label>
                                <input disabled type="radio" id='from-branch' name='from' class="ml-20 mr-4" @if(!$import->supplier_id) checked @endif/>
                                <label for='from-branch'>From branch</label>
                            </div>
                            @if($import->supplier_id)


                            <div id="supplier-section" class="pt-4">
                                <label for="supplier_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Supplier') }}</label>
                                <x-bewama::form.input.select name="supplier_id" disabled>

                                    <option>{{$import->supplier->name}}</option>

                                </x-bewama::form.input.select>
                            </div>
                            @else
                            <div id="branch-section" class="pt-4">
                                <label for="branch_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Branch source') }}</label>
                                <x-bewama::form.input.select name="branch_id" disabled>

                                    <option>{{$import->branchSource->name}}</option>

                                </x-bewama::form.input.select>
                            </div>
                            @endif
                            <span class="block text-sm font-medium leading-6 text-gray-900 pt-4">Products</span>
                            <div class="p-4 col-span-2  border-2 rounded-md ">
                                <div class="h-[300px] overflow-y-scroll">
                                    @foreach($import->products as $product)
                                    <div class="flex items-center gap-4">
                                        <img src="{{$product->picture ?? asset('assets/images/img-placeholder.png')  }}" class="w-20 h-20 object-contain" />
                                        <span class="max-w-[400px] min-w-[200px] truncate">{{$product->name}}</span>
                                        <x-bewama::form.input.text disabled data-product="{{$product->id}}" name="amount-{{$product->id}}" placeholder="amount" class="max-w-[200px] amount" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex justify-between">

                                <div class="flex items-center gap-4 pt-4">
                                    <a href="{{ route('imports.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary">
                                        Return import table
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


            </div>

            </form>

        </div>
    </div>
    </div>
    </div>

    @push('script')
    <script>
        const _import = <?php echo json_encode($import); ?>;
        if (_import.supplier_id) {

            $('#supplier-section').children('option').toArray().forEach(option => {
                if ($(option).val() == _import.supplier_id) $(option).prop('checked', true)
            })
        } else {
            $('#supplier-section').hide()
            $('#branch-section').show()
            $('#branch-section').children('option').toArray().forEach(option => {
                if ($(option).val() == _import.branch_source_id) $(option).prop('checked', true)
            })
        }
        $('.amount').each((index, elem) => {
            _import.products.forEach(p => {
                if ($(elem).data('product') == p.pivot.material_id) {
                    $(elem).val(parseFloat(p.pivot.amount))
                }
                console.log({
                    e: elem,
                    data: $(elem).data('product'),
                    mat: p.pivot.material_id
                });
            })
        })
    </script>
    @endpush
</x-app-layout>