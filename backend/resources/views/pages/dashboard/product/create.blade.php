<x-app-layout>
    <div class="flex min-h-full mx-6 pb-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new product</h2>
                </div>
                <form id='create-product-form' method="POST" action="{{ route('products.store') }}" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white mb-4">
                        <span class="font-bold">INFOMATION</span>

                        <div class="">
                            <div class="h-48 rounded border-2 m-auto w-full mb-4">
                                <img src="{{ asset('assets/images/img-placeholder.png') }}" class="w-full h-full object-contain" id="preview" />
                            </div>
                            <input id="product-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose picture" required />
                            <x-input-error :messages="$errors->get('picture')" class="mt-2 text-error" />

                            @push('script')
                            <script>
                                const selectImage = document.getElementById('product-picture');
                                selectImage.onchange = evt => {
                                    preview = document.getElementById('preview');
                                    // preview.style.display = 'block';
                                    const [file] = selectImage.files
                                    if (file) {
                                        preview.src = URL.createObjectURL(file)
                                    } else preview.src = "{{ asset('assets/images/img-placeholder.png') }}"
                                }
                            </script>
                            @endpush

                        </div>
                        <div class=" gap-6">

                            <div class="pt-4">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="name" value="{{ old('name')}}" type="text" placeholder="Please fill product name" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div class="pt-4">
                                <label for="description" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Desciption') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.textarea name="description" value="{{ old('description')}}" type="text" placeholder="Please fill description" />
                                    <x-input-error :messages="$errors->get('description')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div class="pt-4">
                                <label for="tax_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Tax') }}</label>
                                <x-bewama::form.input.select name="tax_id">
                                    @foreach($taxs as $tax)
                                    <option value="{{ $tax->id }}" @if(old('tax_id')==$tax->id) selected @endif>{{$tax->name}} -- {{$tax->percent}}</option>
                                    @endforeach
                                </x-bewama::form.input.select>
                            </div>

                            <div class="pt-4">
                                <label for="uom_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Uom') }}</label>
                                <x-bewama::form.input.select name="uom_id">
                                    @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}" @if(old('uom_id')==$uom->id) selected @endif>{{$uom->name}}</option>
                                    @endforeach
                                </x-bewama::form.input.select>
                            </div>
                            <div class="pt-4">
                                <label for="type" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Type') }}</label>
                                <x-bewama::form.input.select name="type_id">
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" @if(old('type_id')==$type->id) selected @endif>{{$type->name}}</option>
                                    @endforeach
                                </x-bewama::form.input.select>
                            </div>
                            <div class="pt-4">
                                <label for="type" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Import price (vnd)') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="import_price" value="{{ old('import_price')}}" type="text" placeholder="Please fill import price" class="decimal-only moneyformat" />
                                    <x-input-error :messages="$errors->get('import_price')" class="mt-2 text-error " />
                                </div>

                            </div>
                            <div class="pt-4">
                                <label for="type" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Export price (vnd)') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="export_price" value="{{ old('export_price')}}" type="text" placeholder="Please fill export price" class="decimal-only moneyformat" />
                                    <x-input-error :messages="$errors->get('export_price')" class="mt-2 text-error" />
                                </div>

                            </div>
                            <div class="flex justify-between">
                                <div class="pt-4">
                                    <div class="mt-2 flex gap-4">
                                        <div class="flex gap-2 items-center">
                                            <input id="active" name="active" value="1" type='radio' checked />
                                            <label for="active">Active</label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input id="unactive" name="active" value="0" type='radio' />
                                            <label for="unactive">Deactive</label>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('active')" class="mt-2 text-error" />

                                </div>
                                <div class="flex items-center gap-4 pt-4">
                                    <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary'>
                                        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                        </svg>
                                        Submit
                                    </button>
                                    <a href="{{ route('products.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary">
                                        Return products table
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-2 gap-4">


                        <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
                            <span class="font-bold">ADD SIZES AND RECIPES</span>

                            <x-bewama::form.input.text name="search-mat" placeholder="Search materials" class="w-full" />

                            <div id="recipes" class='max-h-400 overflow-y-scroll grid grid-cols-3 gap-3 mt-5'>
                                <x-bewama::form.input.select name="size" class="w-full col-span-3" multiple>
                                    @foreach($sizes as $size)
                                    <option value="{{$size->id}}">
                                        {{$size->name}}
                                    </option>
                                    @endforeach
                                </x-bewama::form.input.select>
                                <div class="col-span-3 ">
                                    @foreach($sizes as $size)
                                    <div data-size="{{$size->id}}" style="display: none;" class="size-section grid grid-cols-8 items-center mb-1">
                                        <span class="font-bold col-span-1">{{$size->name}}</span>
                                        <div class="col-span-4 gap-4 flex items-center select-none">
                                            <label for="active-{{$size->id}}">active</label>
                                            <input id="active-{{$size->id}}" name="active-{{$size->id}}" value="1" type='radio' checked />
                                            <label for="unactive-{{$size->id}}">Deactive</label>
                                            <input id="unactive-{{$size->id}}" name="active-{{$size->id}}" value="0" type='radio' />
                                        </div>

                                        <div class="flex gap-2 col-span-3 items-center">
                                            <label class="">Price up</label>
                                            <x-bewama::form.input.text name="price-up-{{$size->id}}" placeholder="percent" class="max-w-[100px] decimal-only" />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @foreach($materials as $mat)
                                <div class="relative mat-item">
                                    <label for="mat-{{$mat->id}}">
                                        <div class=' cursor-pointer'>
                                            <img class="w-full aspect-square object-cover" src="{{$mat->picture ?? asset('assets/images/img-placeholder.png') }}" />
                                            <input id="mat-{{$mat->id}}" name="mat-{{$mat->id}}" type="checkbox" class="mat-input absolute top-3 left-3" />
                                        </div>
                                    </label>

                                    <span class="truncate text-center block">{{$mat->name}}</span>
                                    @foreach ($sizes as $size)
                                    <div class=" mat-amount mt-2" style="display: none;" data-size="{{$size->id}}">
                                        <span>Size {{$size->name}} :</span>
                                        <button type='button' class="ml-auto px-1 float-right rounded bg-red-500 text-white delete-size">delete</button>
                                        <button type='button' style="display: none;" class="ml-auto px-1 float-right rounded bg-green-500 text-white add-size">add</button>
                                        <div class="relative mt-1">
                                            <x-bewama::form.input.text type="text" name="recipes-{{$mat->id}}-{{$size->id}}" placeholder="amount" class="w-full decimal-only mat-amount-input" autocomplete="off" />
                                            <span class="absolute top-[50%] right-2  -translate-y-[50%] text-gray-400">{{$mat->uom->name}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
                            <span class="font-bold">ADD TOPPING</span>
                            <x-bewama::form.input.text name="search-topping" placeholder="Search toppings" class="w-full" />
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($toppings as $topping)
                                <div class="relative topping-item">
                                    <label for="topping-{{$topping->id}}">
                                        <div class=' cursor-pointer'>
                                            <img class="w-full aspect-square object-cover" src="{{$topping->picture ?? asset('assets/images/img-placeholder.png') }}" />
                                            <input id="topping-{{$topping->id}}" name="topping-{{$topping->id}}" type="checkbox" class="topping-input absolute top-3 left-3" />
                                        </div>
                                    </label>

                                    <span class="truncate text-center block">{{$topping->name}}</span>

                                    <div class=" topping-amount mt-2" style="display: none;">

                                        <div class="flex items-center gap-4">
                                            <input id="active-topping-{{$topping->id}}" name="active-topping-{{$topping->id}}" type='checkbox' class="active-topping" @if(old('active-topping-{{$topping->id}}')) @if( old('active-topping-{{$topping->id}}')=='on' ) ) checked @endif @else checked @endif />
                                            <label for="active-topping-{{$topping->id}}" class="select-none">active</label>
                                        </div>
                                        <!-- <button type='button' style="display: none;" class="ml-auto px-1 float-right rounded bg-green-500 text-white add-size">add</button> -->
                                        <div class="relative mt-1">
                                            <x-bewama::form.input.text type="text" data-material="{{$topping->id}}" name="" placeholder="amount" class="w-full decimal-only topping-amount-input" autocomplete="off" />
                                            <span class="absolute top-[50%] -translate-y-[50%] right-2 text-gray-400">{{$topping->uom->name}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @push('script')
                        <script>
                            const recipesElement = $("#recipes");
                            const materialInput = $(".mat-input");
                            const toppingInput = $('.topping-input');

                            const searchMat = $("#search-mat");
                            const searchTopping = $("#search-topping");
                            const pictureInput = $("#product-picture");
                            const sizes = <?php echo json_encode($sizes); ?>;
                            const sizeInput = $("#size");
                            const deleteSize = $(".delete-size");
                            const addSize = $('.add-size');
                            const sizeSection = $('.size-section');
                            const imgInput = $('#product-picture');
                            const activeToppings = $('.active-topping');
                            const toppingAmountInput = $('.topping-amount-input');
                            const updateRequiredAmountInput = () => {
                                $('.mat-amount-input').toArray().forEach(item => {
                                    if ($(item).is(':hidden')) {
                                        $(item).attr('required', false);
                                    } else $(item).attr('required', true);
                                })
                            }
                            const updateRequiredAmountToppingInput = () => {
                                toppingAmountInput.toArray().forEach(item => {
                                    if ($(item).is(':hidden')) {
                                        $(item).attr('required', false);
                                    } else $(item).attr('required', true);
                                })
                            }
                            sizeInput.on("change", function(e) {
                                const matItems = $('.mat-item').toArray();
                                matItems.forEach(item => {
                                    const checked = item.children[0].children[0].children[1].checked;
                                    if (checked) {
                                        $(item).children('.mat-amount').toArray().forEach(item => {
                                            const size = $(item).data('size');
                                            if (!sizeInput.val().includes(size + '')) $(item).hide({
                                                complete: updateRequiredAmountInput
                                            });
                                            else $(item).show({
                                                complete: updateRequiredAmountInput
                                            });
                                        })

                                    }
                                })
                                sizeSection.toArray().forEach(item => {
                                    const size = $(item).data('size');
                                    if (sizeInput.val().includes(size + '')) {
                                        $(item).show();
                                        //set price up input required
                                        $(item.children[2].children[1]).attr("required", true);

                                    } else {
                                        $(item).hide();
                                        $(item.children[2].children[1]).attr("required", false);
                                    }
                                })
                            });
                            deleteSize.on('click', function(e) {
                                $(e.target).hide();
                                $(e.target).next().next().hide();
                                $(e.target).next().show();

                            })
                            addSize.on('click', function(e) {
                                $(e.target).prev().show();
                                $(e.target).hide();
                                $(e.target).next().show();
                            })

                            materialInput.on("change", function(e) {
                                if (e.target.checked) {
                                    const element = $(e.target.closest(".mat-item")).children(".mat-amount").toArray();
                                    element.forEach(item => {
                                        const sizeId = $(item).data('size');
                                        if (sizeInput.val().includes(sizeId + "")) {
                                            $(item).show({
                                                complete: updateRequiredAmountInput
                                            });
                                        };

                                    })
                                } else {
                                    $(e.target.closest(".mat-item")).children(".mat-amount")?.hide({
                                        complete: updateRequiredAmountInput
                                    })

                                };
                            });
                            toppingInput.on("change", function(e) {
                                if (e.target.checked) {
                                    const element = $(e.target.closest(".topping-item")).children(".topping-amount");
                                    element.show({
                                        complete: updateRequiredAmountToppingInput
                                    });
                                } else {
                                    $(e.target.closest(".topping-item")).children(".topping-amount")?.hide({
                                        complete: updateRequiredAmountToppingInput
                                    })

                                };
                            });
                            searchMat.on("input", function(e) {
                                const searchTerm = e.target.value;
                                clearTimeout(this.delay);
                                this.delay = setTimeout(
                                    function() {
                                        $("#recipes > div.mat-item")
                                            .toArray()
                                            .forEach((item) => {
                                                const checked =
                                                    item.children[0].children[0].children[1].checked;
                                                if (!checked) item.style.display = "none";
                                                if (
                                                    !searchTerm ||
                                                    item.children[1].textContent
                                                    .toLowerCase()
                                                    .includes(searchTerm.toLowerCase())
                                                )
                                                    item.style.display = "block";
                                            });
                                    }.bind(this),
                                    800
                                );
                            });
                            searchTopping.on("input", function(e) {
                                const searchTerm = e.target.value;
                                clearTimeout(this.delay);
                                this.delay = setTimeout(
                                    function() {
                                        $("div.topping-item")
                                            .toArray()
                                            .forEach((item) => {
                                                const checked =
                                                    item.children[0].children[0].children[1].checked;
                                                if (!checked) item.style.display = "none";
                                                if (
                                                    !searchTerm ||
                                                    item.children[1].textContent
                                                    .toLowerCase()
                                                    .includes(searchTerm.toLowerCase())
                                                )
                                                    item.style.display = "block";
                                            });
                                    }.bind(this),
                                    800
                                );
                            });
                            const form = $('#create-product-form');
                            form.on('submit', function(e) {
                                const data = form.serializeArray().reduce((acc, item) => {
                                    return {
                                        ...acc,
                                        [item.name]: item.value
                                    }
                                }, {})
                                console.log(data);
                                if (data.sizes && data.toppings) return;
                                e.preventDefault();
                                const sizes = [];
                                const toppings = [];
                                $('.size-section').toArray().forEach(item => {

                                    if (!$(item).is(':hidden')) {

                                        const size_id = $(item).data('size');
                                        const active = item.children[1].children[1].checked
                                        const price_up_percent = +item.children[2].children[1].value
                                        const materials = []
                                        sizes.push({
                                            size_id,
                                            active,
                                            price_up_percent,
                                            materials
                                        })
                                    }
                                })
                                $('.mat-amount-input').toArray().forEach(item => {
                                    if (!$(item).is(':hidden')) {
                                        const material_id = +$(item).attr('name').split('-')[1];
                                        const size_id = +$(item).attr('name').split('-')[2];
                                        const amount = +$(item).val();
                                        const size = sizes.find((item) => item.size_id == size_id)
                                        size.materials.push({
                                            material_id,
                                            amount
                                        })
                                    }
                                })
                                toppingAmountInput.toArray().forEach(item => {
                                    if (!$(item).is(':hidden')) {
                                        const materialId = $(item).data('material');
                                        toppings.push({
                                            'material_id': materialId,
                                            active: $(item).closest('.topping-amount').toArray()[0].children[0].children[0].checked,
                                            amount: +$(item).val()
                                        })
                                    }
                                })
                                console.log({
                                    toppings
                                });
                                var input1 = $("<input>")
                                    .attr("type", "hidden")
                                    .attr("name", "sizes").val(JSON.stringify(sizes));
                                var input2 = $("<input>")
                                    .attr("type", "hidden")
                                    .attr("name", "toppings").val(JSON.stringify(toppings));
                                form.append(input1);
                                form.append(input2);
                                form.submit();

                            })
                        </script>
                        @endpush
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>