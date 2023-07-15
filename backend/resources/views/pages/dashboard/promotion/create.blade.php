<x-app-layout>
    <div class="flex min-h-full mx-6 dark:text-white">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Add promotion</h2>
                </div>
                <form method="POST" action="{{ route('promotions.store') }}" class="" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white dark:bg-transparent ">
                        <div class="grid grid-cols-2 gap-6">

                            <div class="">
                                <div class="h-40 rounded border-2 m-auto w-full mb-4">
                                    <img src="{{ asset('assets/images/img-placeholder.png') }}" class="w-full h-full object-contain" id="preview" />
                                </div>
                                <input id="promotion-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose picture" />
                                <x-input-error :messages="$errors->get('picture')" class="mt-2 text-error" />

                                @push('script')
                                <script>
                                    const selectImage = document.getElementById('promotion-picture');
                                    selectImage.onchange = evt => {
                                        preview = document.getElementById('preview');
                                        const [file] = selectImage.files
                                        if (file) {
                                            preview.src = URL.createObjectURL(file)
                                        } else preview.src = "{{ asset('assets/images/img-placeholder.png') }}"
                                    }
                                </script>
                                @endpush

                            </div>
                            <div class=" gap-6">

                                <div class="">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Name') }}</label>
                                    <div class="mt-2">
                                        <x-bewama::form.input.text name="name" value="{{ old('name')}}" type="text" placeholder="Please fill promotion name" required />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <label for="from-day" class="block text-sm font-medium leading-6 text-gray-900">{{ __('From') }}</label>
                                    <div class="mt-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-bewama::form.input.text name="from_day" value="{{ old('from_day')}}" type="date" required />
                                            <x-bewama::form.input.text name="from_time" value="{{ old('from_time')}}" type="time" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('from_day') ?? $errors->get('from_time')" class="mt-2 text-error" />
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <label for="to-day" class="block text-sm font-medium leading-6 text-gray-900">{{ __('To') }}</label>
                                    <div class="mt-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-bewama::form.input.text name="to_day" value="{{ old('to_day')}}" type="date" required />
                                            <x-bewama::form.input.text name="to_time" value="{{ old('to_time')}}" type="time" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('to_day') ?? $errors->get('to_time')" class="mt-2 text-error" />
                                        <span class="hidden error-time text-red-500">Time is not valid</span>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <label for="discount" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Discount') }}</label>
                                    <div class="mt-2">
                                        <x-bewama::form.input.text name="discount" value="{{ old('discount')}}" type="number" placeholder="Please fill discount" class="decimal-only" step='.1' min='0' max='1' />
                                        <x-input-error :messages="$errors->get('discount')" class="mt-2 text-error" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 col-span-2 h-[300px] border-2 rounded-md overflow-y-scroll ">
                                @foreach($products as $product)
                                <label for="product-{{$product->id}}" class="cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <input type="checkbox" id="product-{{$product->id}}" class="product-checkbox" />
                                        <img src="{{$product->picture ?? asset('assets/images/img-placeholder.png')  }}" class="w-20 h-20 object-contain" />
                                        <span class="max-w-[400px] min-w-[200px] truncate">{{$product->name}}</span>
                                        <x-bewama::form.input.text data-drink="{{$product->id}}" name="promotion-amount-{{$product->id}}" placeholder="promotion amount (vnd)" class="max-w-[200px] decimal-only moneyformat hidden promotion-amount" />
                                    </div>
                                </label>
                                @endforeach
                                <span class="hidden error-product text-red-500 col-span-2">Need at least one product</span>
                            </div>
                            <div class="flex items-center gap-4 col-span-2">

                                <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary'>
                                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                    Submit
                                </button>
                                <a href="{{ route('promotions.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                    Return promotion table
                                </a>
                            </div>


                        </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    @push('script')
    <script>
        $('.product-checkbox').on('change', function(e) {
            if (e.target.checked) {
                e.target.parentElement.lastElementChild.style.display = 'block';
            } else {
                e.target.parentElement.lastElementChild.style.display = 'none';
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
            if (data.drinks) return;
            e.preventDefault();
            const drinks = [];
            console.log($('#from_day').val() + ' ' + $('#from_time').val() + ':00', $('#to_day').val() + ' ' + $('#to_time').val() + ':00');
            if (Date.parse($('#from_day').val() + ' ' + $('#from_time').val() + ':00') >= Date.parse($('#to_day').val() + ' ' + $('#to_time').val() + ':00')) {
                $('.error-time').show();
                return;
            } else $('.error-time').hide();

            $('.promotion-amount').toArray().forEach(function(item) {
                if (!$(item).is(':hidden')) {
                    drinks.push({
                        drink_id: $(item).data('drink'),
                        promotion_amount: $(item).val()

                    })
                }
            })
            if (drinks.length == 0) {
                $('.error-product').show();
                return;
            } else $('.error-product').hide();
            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "drinks").val(JSON.stringify(drinks));
            form.append(input);
            form.submit();
        })
    </script>
    @endpush
</x-app-layout>