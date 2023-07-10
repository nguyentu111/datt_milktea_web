<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new product</h2>
                </div>
                <form method="POST" action="{{ route('products.store') }}" class="grid grid-cols-2 gap-4" enctype="multipart/form-data">
                    @csrf
                    <div class="border-slate-500 rounded-lg shadow-lg p-6 bg-white">
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

                        <div class=" border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
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
                        <div class="mt-4 border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
                            <button id="add-recipes" type='button' class="bg-green-500 p-2 rounded 
                            text-white text-[13px] font-bold">+ Add recipes</button>
                            <div class="flex gap-4">
                                <button class="p-2 bg-red-400 text-white rounded text-[13px] font-bold" type="button" id='cancle-add-recipes' style="display: none;">Cancle</button>
                                <x-bewama::form.input.text name="search-mat" placeholder="Search materials" style="display: none;" class="w-full" />
                            </div>
                            <div id="recipes" style="display: none;" class='max-h-400 overflow-y-scroll grid grid-cols-3 gap-3 mt-5'>
                                @foreach($materials as $mat)
                                <div class="relative mat-item">
                                    <label for="mat-{{$mat->id}}">
                                        <div class=' cursor-pointer'>
                                            <img class="w-full aspect-square object-cover" src="{{$mat->picture ?? asset('assets/images/img-placeholder.png') }}" />
                                            <input id="mat-{{$mat->id}}" name="mat-{{$mat->id}}" type="checkbox" class="mat-input absolute top-3 left-3" />
                                        </div>
                                    </label>

                                    <span class="truncate text-center block">{{$mat->name}}</span>
                                    <div class="relative mat-amount" style="display: none;">
                                        <x-bewama::form.input.text type="text" name="mat-amount-{{$mat->id}}" placeholder="amount" class="w-full" />
                                        <span class="absolute top-[50%] right-2  -translate-y-[50%] text-gray-400">{{$mat->uom->name}}</span>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                            @push('script')
                            <script>
                                const addRecipesBtn = $('#add-recipes');
                                const cancleBtn = $('#cancle-add-recipes');
                                const recipesElement = $('#recipes');
                                const materialInput = $('.mat-input');
                                const searchMat = $('#search-mat');
                                const matAmountInputs = $('.mat-amount');
                                materialInput.on('change', function(e) {
                                    if (e.target.checked) $(e.target.closest('.mat-item')).children('.mat-amount')?.show();
                                    else $(e.target.closest('.mat-item')).children('.mat-amount')?.hide();
                                })
                                addRecipesBtn.on('click', function() {
                                    cancleBtn.show()
                                    addRecipesBtn.hide();
                                    recipesElement.show();
                                    searchMat.show();
                                })
                                cancleBtn.on('click', function() {
                                    cancleBtn.hide()
                                    addRecipesBtn.show();
                                    recipesElement.hide();
                                    searchMat.hide();
                                })
                                searchMat.on('input', function(e) {
                                    const searchTerm = e.target.value;
                                    clearTimeout(this.delay);
                                    this.delay = setTimeout(function() {

                                        $('#recipes > div').toArray().forEach((item) => {
                                            console.log({
                                                searchTerm,
                                                a: item.children[1].textContent.toLowerCase(),
                                                ok: item.children[1].textContent.toLowerCase().includes(searchTerm.toLowerCase())
                                            })
                                            const checked = item.children[0].children[0].children[1].checked;
                                            if (!checked) item.style.display = 'none';
                                            if (!searchTerm || item.children[1].textContent.toLowerCase().includes(searchTerm.toLowerCase())) item.style.display = 'block';
                                        });

                                    }.bind(this), 800)
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