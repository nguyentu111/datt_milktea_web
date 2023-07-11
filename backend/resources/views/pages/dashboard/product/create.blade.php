<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new product</h2>
                </div>
                <form id='create-product-form' method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white">
                        <div class="">
                            <div class="h-48 rounded border-2 m-auto w-full mb-4">
                                <img src="{{ asset('assets/images/img-placeholder.png') }}" class="w-full h-full object-contain" id="preview" />
                            </div>
                            <input id="product-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose picture" />
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
                                    <x-bewama::form.input.text name="name" value="{{ old('name')}}" type="text" placeholder="Please fill product name" />
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
                            <div class="flex justify-between">
                                <div class="pt-4">
                                    <div class="mt-2 flex gap-4">
                                        <div class="flex gap-2 items-center">
                                            <input id="active" name="active" value="1" type='radio' checked />
                                            <label for="active">Active</label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input id="unactive" name="active" value="0" type='radio' />
                                            <label for="unactive">Unactive</label>
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
                    <div>


                        <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
                            <button id="add-recipes" type='button' class="bg-green-500 p-2 rounded 
                            text-white text-[13px] font-bold">+ Add size</button>
                            <div class="flex gap-4">
                                <button class="p-2 bg-red-400 text-white rounded text-[13px] font-bold" type="button" id='cancle-add-recipes' style="display: none;">Cancle</button>
                                <x-bewama::form.input.text name="search-mat" placeholder="Search materials" style="display: none;" class="w-full" />
                            </div>

                            <div id="recipes" style="display: none;" class='max-h-400 overflow-y-scroll grid grid-cols-3 gap-3 mt-5'>
                                <x-bewama::form.input.select name="size" class="w-full col-span-3" multiple>
                                    @foreach($sizes as $size)
                                    <option value="{{$size->id}}">
                                        {{$size->name}}
                                    </option>
                                    @endforeach
                                </x-bewama::form.input.select>
                                <div class="col-span-3">
                                    @foreach($sizes as $size)
                                    <div class="grid grid-cols-8 items-center mb-1">
                                        <span class="font-bold col-span-1">{{$size->name}}</span>
                                        <div class="col-span-4 gap-4 flex items-center">
                                            <label>active</label>
                                            <input type="checkbox" />
                                            <label>unactive</label>
                                            <input type="checkbox" />
                                        </div>

                                        <div class="flex gap-2 col-span-3 items-center">
                                            <label class="">Price up</label>
                                            <x-bewama::form.input.text name="price-up-{{$size->id}}" placeholder="percent" class="max-w-[100px]" />
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
                                            <x-bewama::form.input.text type="text" name="recipes-{{$mat->id}}-{{$size->id}}" placeholder="amount" class="w-full decimal-only" autocomplete="off" />
                                            <span class="absolute top-[50%] right-2  -translate-y-[50%] text-gray-400">{{$mat->uom->name}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            @push('script')
                            <script>
                                const addRecipesBtn = $("#add-recipes");
                                const cancleBtn = $("#cancle-add-recipes");
                                const recipesElement = $("#recipes");
                                const materialInput = $(".mat-input");
                                const searchMat = $("#search-mat");
                                const pictureInput = $("#product-picture");
                                const sizes = <?php echo json_encode($sizes); ?>;
                                const sizeInput = $("#size");
                                const sizesChoosed = []
                                const deleteSize = $(".delete-size");
                                const addSize = $('.add-size');
                                sizeInput.on("change", function(e) {
                                    const matItems = $('.mat-item').toArray();
                                    matItems.forEach(item => {
                                        const checked = item.children[0].children[0].children[1].checked;
                                        if (checked) {
                                            $(item).children('.mat-amount').toArray().forEach(item => {
                                                const size = $(item).data('size');
                                                if (!sizeInput.val().includes(size + '')) $(item).hide();
                                                else $(item).show();
                                            })

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
                                            if (sizeInput.val().includes(sizeId + "")) $(item).show();

                                        })
                                    } else $(e.target.closest(".mat-item")).children(".mat-amount")?.hide();
                                });
                                addRecipesBtn.on("click", function() {
                                    cancleBtn.show();
                                    addRecipesBtn.hide();
                                    recipesElement.show();
                                    searchMat.show();
                                });
                                cancleBtn.on("click", function() {
                                    cancleBtn.hide();
                                    addRecipesBtn.show();
                                    recipesElement.hide();
                                    searchMat.hide();
                                });
                                searchMat.on("input", function(e) {
                                    const searchTerm = e.target.value;
                                    clearTimeout(this.delay);
                                    this.delay = setTimeout(
                                        function() {
                                            $("#recipes > div")
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
                                $("input.decimal-only").on("keydown", function(event) {
                                    if (event.shiftKey == true) {
                                        event.preventDefault();
                                    }
                                    if (
                                        (event.keyCode >= 48 && event.keyCode <= 57) ||
                                        (event.keyCode >= 96 && event.keyCode <= 105) ||
                                        event.keyCode == 8 ||
                                        event.keyCode == 9 ||
                                        event.keyCode == 37 ||
                                        event.keyCode == 39 ||
                                        event.keyCode == 46 ||
                                        event.keyCode == 190
                                    ) {} else {
                                        event.preventDefault();
                                    }
                                    if ($(this).val().indexOf(".") !== -1 && event.keyCode == 190)
                                        event.preventDefault();
                                });
                                // const createProductForm = $("#create-product-form");
                                // createProductForm.on("submit", (e) => {
                                //     // e.preventDefault();
                                //     const data = lodash.concat(...createProductForm.serializeArray());
                                //     let mats = null;
                                //     console.log(data);
                                //     if (addRecipesBtn.is(":hidden")) {
                                //         mats = [];
                                //         data.forEach((item) => {
                                //             if (item.name.includes("mat")) {
                                //                 const id = item.name.substring(4);
                                //                 if (!isNaN(id)) {
                                //                     const amount = data.find(
                                //                         (item) => item.name === "mat-amount-" + id
                                //                     ).value;
                                //                     mats.push({
                                //                         id,
                                //                         amount: parseFloat(amount),
                                //                     });
                                //                 }
                                //             }
                                //         });
                                //     }
                                //     $.ajax({
                                //         url: "/dashboard/products/create",
                                //         method: "POST",
                                //         data: formData,
                                //         contentType: false,
                                //         processData: false,
                                //         success: function(response) {
                                //             console.log(response);
                                //         },
                                //     });
                                // });
                                const form = $('#create-product-form');
                                form.on('submit', function(e) {
                                    e.preventDefault();
                                    let size = null;
                                    if (addRecipesBtn.is(":hidden")) {
                                        size = [];
                                        // const data = lodash.concat(...form.serializeArray());
                                        const data = form.serializeArray().reduce((acc, item) => {
                                            return {
                                                ...acc,
                                                [item.name]: item.value
                                            }
                                        }, {})
                                        console.log(data);
                                        $('.decimal-only').toArray().forEach(item => {
                                            if (!$(item).is(':hidden')) {
                                                const material_id = $(item).attr('name').split('-')[1];
                                                const size_id = $(item).attr('name').split('-')[2];
                                                const amount = $(item).val();
                                                size.push()
                                            }
                                        })
                                    }
                                })
                            </script>
                            @endpush
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>