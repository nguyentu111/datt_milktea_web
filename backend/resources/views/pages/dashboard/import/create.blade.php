<x-app-layout>
    <div class="flex min-h-full mx-6 pb-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new import</h2>
                </div>
                <form id='create-import-form' method="POST" action="{{ route('imports.store') }}" class="">
                    @csrf
                    <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white mb-4">
                        <div class=" gap-6">
                            <div class="flex items-center ">
                                <input type="radio" id='from-supplier' name='from' class="mr-4" checked />
                                <label for='from-supplier'>From supplier</label>
                                <input type="radio" id='from-branch' name='from' class="ml-20 mr-4" />
                                <label for='from-branch'>From branch</label>
                            </div>
                            <div id="branch-section" class="pt-4" style="display: none;">
                                <label for="branch_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Branch source') }}</label>
                                <x-bewama::form.input.select name="branch_id" disabled>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" @if(old('branch_id')==$branch->id) selected @endif>{{$branch->name}}</option>
                                    @endforeach
                                </x-bewama::form.input.select>
                            </div>

                            <div id="supplier-section" class="pt-4">
                                <label for="supplier_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Supplier') }}</label>
                                <x-bewama::form.input.select name="supplier_id">
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if(old('supplier_id')==$supplier->id) selected @endif>{{$supplier->name}}</option>
                                    @endforeach
                                </x-bewama::form.input.select>
                            </div>
                            <span class="block text-sm font-medium leading-6 text-gray-900 pt-4">Products</span>
                            <div class="p-4 col-span-2  border-2 rounded-md ">
                                <div class="h-[300px] overflow-y-scroll">
                                    @foreach($products as $product)
                                    <label for="product-{{$product->id}}" class="cursor-pointer">
                                        <div class="flex items-center gap-4">
                                            <input type="checkbox" id="product-{{$product->id}}" class="product-checkbox" />
                                            <img src="{{$product->picture ?? asset('assets/images/img-placeholder.png')  }}" class="w-20 h-20 object-contain" />
                                            <span class="max-w-[400px] min-w-[200px] truncate">{{$product->name}} ({{$product->uom->name}})</span>
                                            <x-bewama::form.input.text data-product="{{$product->id}}" name="amount-{{$product->id}}" placeholder="amount" class="max-w-[200px] decimal-only moneyformat hidden amount" />
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                                <span class="hidden error-product text-red-500 col-span-2">Need at least one product</span>
                            </div>
                            <div class="flex justify-between">

                                <div class="flex items-center gap-4 pt-4">
                                    <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary'>
                                        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                        </svg>
                                        Submit
                                    </button>
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
        $('input[name="from"]').on('change', function(e) {
            if ($('#from-supplier').is(':checked')) {
                $('#supplier-section').show();
                $('#branch-section').hide();
                $('select[name="supplier_id"]').prop('disabled', false);
                $('select[name="branch_id"]').prop('disabled', true);
            } else {
                $('#supplier-section').hide();
                $('#branch-section').show();
                $('select[name="supplier_id"]').prop('disabled', true);
                $('select[name="branch_id"]').prop('disabled', false);
            }
        })
        $('.product-checkbox').on('change', function(e) {
            if (e.target.checked) {
                e.target.parentElement.lastElementChild.style.display = 'block';
                $(e.target.parentElement.lastElementChild).prop('required', true);
            } else {
                e.target.parentElement.lastElementChild.style.display = 'none';
                $(e.target.parentElement.lastElementChild).prop('required', false);

            }
        })
        const form = $('form');
        form.on('submit', function(e) {
            const data = form.serializeArray().reduce((acc, item) => {
                return {
                    ...acc,
                    [item.name]: item.value
                }
            }, {})
            if (data.products) return;
            e.preventDefault();
            const products = [];


            $('.amount').toArray().forEach(function(item) {
                if (!$(item).is(':hidden')) {
                    products.push({
                        material_id: $(item).data('product'),
                        amount: $(item).val().replace('.', '')

                    })
                }
            })
            if (products.length == 0) {
                $('.error-product').show();
                return;
            } else $('.error-product').hide();
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "products").val(JSON.stringify(products));
            form.append(input);
            console.log(form.serializeArray());
            form.submit();
        })
    </script>
    @endpush
</x-app-layout>