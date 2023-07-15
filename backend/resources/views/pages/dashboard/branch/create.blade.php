<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Add new branch</h2>
                </div>
                <form method="POST" action="{{ route('branches.store') }}" class="" enctype="multipart/form-data">
                    @csrf
                    <div class="flex gap-6">

                        <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full @error('picture') border-2 border-red-500 @enderror">
                            <div class="w-full h-48 rounded border-2 m-auto">
                                <img src="{{ asset('assets/images/img-placeholder.png') }}" class="object-contain w-full h-full" id="preview" />
                            </div>
                            <input id="staff-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose pictue" />
                            <x-input-error :messages="$errors->get('picture')" class="mt-2 text-error" />

                            @push('script')
                            <script>
                                const selectImage = document.getElementById('staff-picture');
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
                    </div>
                    <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Branch name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="name" value="{{ old('name')}}" type="name" placeholder="Please fill name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error" />
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Address') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="address" value="{{ old('address')}}" type="address" placeholder="Please fill address" />
                                    <x-input-error :messages="$errors->get('address')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <label for="phone" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Phone') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="phone" value="{{ old('phone')}}" type="phone" placeholder="Please fill phone" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-error" />
                                </div>
                            </div>

                            <div>
                                <label for="date_open" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Date open') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="date_open" type="date" value="{{ old('date_open')}}" placeholder="dd-mm-yyyy" value=""></x-bewama::form.input.text>
                                    <x-input-error :messages="$errors->get('date_open')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
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
                            <div class="flex items-center gap-4">

                                <button type="submit" class='text-white inline-flex items-center gap-x-2 rounded-md bg-slate-600 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary'>
                                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                    Submit
                                </button>
                                <a href="{{ route('branches.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                    Return branch table
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