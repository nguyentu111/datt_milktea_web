<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Update category</h2>
                </div>
                <form method="POST" action="{{ route('categories.update',$category) }}" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-6">

                        <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full @error('picture') border-2 !border-red-500 @enderror">
                            <div class="w-full h-48 rounded border-2 m-auto">
                                <img src="{{$category->picture ?? asset('assets/images/img-placeholder.png') }}" class="object-contain w-full h-full" id="preview" />
                            </div>
                            <input id="type-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose pictue" />
                            <x-input-error :messages="$errors->get('picture')" class="mt-2 text-error" />
                            <button class="p-2 bg-red-400 text-white mt-3 rounded" type="button" id='cancle-change-picture' style="display: none">Cancle</button>

                            @push('script')
                            <script>
                                const preview = document.getElementById('preview');
                                const oldPictureUrl = "{{$category->picture}}";
                                const cancleBtn = document.getElementById('cancle-change-picture');
                                const selectImage = document.getElementById('type-picture');
                                cancleBtn.onclick = () => {
                                    preview.src = oldPictureUrl ? oldPictureUrl : "{{asset('assets/images/staff-placeholder.jpg')}}";
                                    cancleBtn.style.display = 'none'
                                    selectImage.value = null;
                                }
                                selectImage.onchange = evt => {
                                    cancleBtn.style.display = 'block';
                                    const [file] = selectImage.files
                                    if (file) {
                                        preview.src = URL.createObjectURL(file)
                                    } else preview.src = "{{ asset('assets/images/img-placeholder.png') }}"
                                }
                            </script>
                            @endpush
                        </div>
                    </div>
                    <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Category name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="name" value="{{ old('name') ??  $category->name}}" type="name" placeholder="Please fill name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <label for="parent_id" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Parent category (optional)') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.select name="parent_id" value="{{ old('parent_id') ?? $category->parent_id}}">
                                        <option value="" selected>-- none --</option>
                                        @foreach($categories as $item)
                                        @if($item->id !== $category->id)
                                        <option value="{{$item->id}}" @if($item->id == $category->parent_id) selected @endif>{{$item->name}}</option>
                                        @endif

                                        @endforeach
                                    </x-bewama::form.input.select>
                                    <x-input-error :messages="$errors->get('parent_id')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <!-- <label class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Can ') }}</label> -->

                            <div class="flex items-center gap-4">
                                <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary'>
                                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                    Submit
                                </button>
                                <a href="{{ route('categories.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                    py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                     focus-visible:outline-primary">
                                    Return category table
                                </a>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>