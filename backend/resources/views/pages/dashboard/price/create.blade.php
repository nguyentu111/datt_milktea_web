<x-app-layout>
    <div class="flex min-h-full mx-6 dark:text-white">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Detail Product price</h2>
                </div>
                <form method="POST" action="{{ route('prices.store') }}" class="">
                    @csrf

                    <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white dark:bg-transparent ">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Product') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.select name="product_id" type="name" placeholder="Please fill name">
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}" @if(old('product_id')==$product->id ) selected @endif>{{$product->name}}</option>
                                        @endforeach
                                    </x-bewama::form.input.select>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <table>
                                    <thead>
                                        <tr class="">
                                            <th class="p-2 border-2">
                                                import price
                                            </th>
                                            <th class="p-2 border-2">
                                                apply from
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="import-table-body">
                                    </tbody>
                                </table>
                                <table class="mt-4">
                                    <thead>
                                        <tr class="">
                                            <th class="p-2 border-2">
                                                export price
                                            </th>
                                            <th class="p-2 border-2">
                                                apply from
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="export-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('price (vnd)') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="price" value="{{ old('price')}}" type="text" placeholder="Please fill price" class="moneyformat decimal-only" required />
                                    <x-input-error :messages="$errors->get('price')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('apply from') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="apply_from" value="{{ old('apply_from')}}" type="date" placeholder="Please fill name" required />
                                    <x-input-error :messages="$errors->get('apply_from')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="mt-2 flex gap-4">
                                    <div class="flex gap-2 items-center">
                                        <input id="import" name="is_import" value="1" type='radio' checked />
                                        <label for="import">Import price</label>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input id="export" name="is_import" value="0" type='radio' />
                                        <label for="export">Export price</label>
                                    </div>
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
                                <a href="{{ route('prices.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                    Return price table
                                </a>
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
        const products = <?php echo json_encode($products); ?>;
        const updateTables = (id) => {
            const product = products.find(v => v.id == id);
            product.import_prices.forEach(p => {
                $('.import-table-body').append(
                    `<tr>
                   <td class="p-2 border-2">
                        ${p.price} vnd
                    </td>
                    <td class="p-2 border-2">
                        ${p.apply_from}
                    </td>
                    </tr> 
                   `
                )

            })
            product.export_prices.forEach(p => {
                $('.export-table-body').append(
                    `<tr>
                   <td class="p-2 border-2">
                        ${p.price} vnd
                    </td>
                    <td class="p-2 border-2">
                        ${p.apply_from}
                    </td>
                    </tr> 
                   `
                )

            })
        }
        updateTables($('select').val())
        $('select').on('change', function(e) {
            $('.import-table-body').html('')
            $('.export-table-body').html('')
            updateTables(e.target.value)
        })
    </script>
    @endpush
</x-app-layout>