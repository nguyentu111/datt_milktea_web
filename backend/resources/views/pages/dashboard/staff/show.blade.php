<x-app-layout>
    <div class="flex min-h-full mx-6">
        <div class="flex flex-1 flex-col justify-center w-full">
            <div class=" w-full">
                <div>
                    <h2 class="mt-2 text-2xl font-bold leading-9 tracking-tight text-gray-900">Update staff</h2>
                </div>
                <form method="POST" action="{{ route('staffs.update',$staff) }}" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-6">
                        <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full @error('branch_id') border-2 !border-red-500 @enderror">
                            <div class="col-span-3 relative focus:fixed focus:-mt-2 focus:w-[40%] z-20">
                                <svg class="absolute inset-y-0 right-0 me-2 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                                <x-bewama::form.input.text name="search-branch" id="search-branch" type="text" placeholder="Search branch" />
                                <div style="display : none;" id="result-branches" class="absolute top-full left-0 right-0 bg-white p-2 border-2 rounded-lg overflow-auto  col-span-3  z-50">
                                    <table class="divide-y divide-gray-300 min-w-full">
                                        <tbody class="table-body bg-white divide-y divide-gray-200" id="branch-list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="branch-error" class="col-span-3">
                                @error('branch-id')
                                <span class="text-sm text-red-500 font-semibold">{{ $message }}</span>
                                @enderror
                            </div>


                            @push('script')
                            <script>
                                const staff = <?php echo json_encode($staff); ?>;
                                if (staff?.branch_id) {
                                    getBranchInfo(staff.branch_id);
                                }
                                const searchBranchElement = $('#search-branch');
                                const brachList = $('#branch-list');

                                searchBranchElement.on('input', function() {
                                    clearTimeout(this.delay);
                                    this.delay = setTimeout(function() {
                                        const searchTerm = searchBranchElement.val();
                                        const url = window.location.origin;
                                        // searchBranchElement.parent().css('z-index', 20);
                                        if (searchTerm == "") {
                                            $("#branch-list").html("");
                                            $("#result-branches").hide();
                                        } else {
                                            $.ajax({
                                                type: "GET",
                                                data: {
                                                    search: searchTerm,
                                                },
                                                url: `${url}/dashboard/search-branch`,
                                                success(response) {
                                                    if (!response.error && response !== "") {
                                                        // $('#backdrop').show();
                                                        $("#branch-list").empty().html(response);
                                                        $("#branch-list .list-group-branch td").on("click", function(event) {
                                                            const _self = event.target;
                                                            const branchId = _self.parentElement.firstElementChild.textContent;
                                                            getBranchInfo(branchId);

                                                        })
                                                        $("#result-branches").show();
                                                    } else {
                                                        $("#result-branches").hide();
                                                    }
                                                },
                                            });
                                        }
                                    }.bind(this), 800);
                                });

                                function getBranchInfo(branchId) {
                                    const url = window.location.origin;
                                    $.ajax({
                                        type: "GET",
                                        data: {
                                            branch_id: branchId,
                                        },
                                        url: `${url}/dashboard/search-branch`,
                                        success(response) {
                                            if (!response.error && response) {
                                                $('input[name="branch_id"]').val(response.id);
                                                $('input[name="branch_name"]').val(response.name);
                                                $('input[name="branch_address"]').val(response.address);
                                                $('input[name="branch_phone"]').val(response.phone);
                                                // handleBackDrop()
                                                $("#result-branches").hide();
                                            }
                                        },
                                    });
                                }
                            </script>
                            @endpush
                            <input style="display : none;" name="branch_id" />
                            <div class="col-span-2">
                                <label class="block font-semibold text-xs leading-6 uppercase text-slate-600">Name</label>
                                <div class="mt-2">
                                    <input name="branch_name" type="text" disabled class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            <div class="col-span-3">
                                <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Address</label>
                                <div class="mt-2">
                                    <input name="branch_address" type="datetime" disabled class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label class="block font-semibold  text-xs leading-6 uppercase text-slate-600">Phone number</label>
                                <div class="mt-2">
                                    <input name="branch_phone" type="text" disabled class="pl-2 bg-slate-100 outline-transparent block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6" />
                                </div>
                            </div>


                        </div>
                        <div class="mt-7 border-slate-500 rounded-lg shadow-lg p-6 bg-white w-full">
                            <div class="w-32 h-48 rounded border-2 m-auto">
                                <img src="{{$staff->picture ?? asset('assets/images/staff-placeholder.jpg') }}" class="object-cover w-full h-full" id="preview" />
                            </div>
                            <input id="staff-picture" name="picture" type="file" accept=".png,.jpg,.jepg" placeholder="Choose pictue" />
                            <button class="p-2 bg-red-400 text-white mt-3 rounded" type="button" id='cancle-change-picture' style="display: none">Cancle</button>
                            @push('script')
                            <script>
                                const preview = document.getElementById('preview');
                                const oldPictureUrl = "{{$staff->picture}}";
                                const cancleBtn = document.getElementById('cancle-change-picture');
                                const selectImage = document.getElementById('staff-picture');
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
                                <label for="first_name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('First name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="first_name" value="{{ old('first_name') ?? $staff->first_name}}" type="text" placeholder="Please fill staff first name" />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div class="flex gap-10">
                                <div>
                                    <label class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Gender') }}</label>
                                    <div class="mt-2 ">
                                        <div class="flex gap-2 items-center">
                                            <input id="male" name="gender" value="male" type='radio' @if(old('gender')!==null ? old('gender')=='male' : $staff->gender == 'male' ) checked @endif />
                                            <label for="male">Male</label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input id="female" name="gender" value="female" type='radio' @if(old('gender')!==null ? old('gender')=='female' : $staff->gender == 'female' ) checked @endif />
                                            <label for="female">Femail</label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Role') }}</label>
                                    <div class="mt-2 flex gap-3 items-start">
                                        <div>
                                            <div class="flex gap-2 items-center">
                                                <input name="roles[]" id="admin" type="checkbox" value="admin" @if($staff->isAdmin()) checked @endif/>
                                                <label for="admin">Admin</label>
                                            </div>
                                            <div class="flex gap-2 items-center">
                                                <input name="roles[]" id="cheff" type="checkbox" value="cheff" @if($staff->isCheff()) checked @endif />
                                                <label for="cheff">Cheff</label>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex gap-2 items-center">
                                                <input name="roles[]" id="warehouse_manager" type="checkbox" value="warehouse_manager" @if($staff->isWarehouseManager()) checked @endif />
                                                <label for="warehouse_manager">Warehouse manager</label>
                                            </div>
                                            <div class="flex gap-2 items-center">
                                                <input name="roles[]" id="business_manager" type="checkbox" value="business_manager" @if($staff->isBusinessManager()) checked @endif />
                                                <label for="business_manager">Business manager</label>
                                            </div>
                                        </div>

                                        <div class="flex gap-2 items-center">
                                            <input name="roles[]" id="cashier" type="checkbox" value="cashier" @if($staff->isCashier()) checked @endif />
                                            <label for="cashier">Cashier</label>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('roles')" class="mt-2 text-error" />
                                </div>
                            </div>


                            <div>
                                <label for="last_name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Last name') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="last_name" value="{{ old('last_name') ?? $staff->last_name}}" type="text" placeholder="Please fill staff last name" />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Email address') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="email" value="{{ old('email') ?? $staff->user->email}}" type="email" placeholder="Please fill email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-error" />
                                </div>
                            </div>

                            <div>
                                <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Date of birth') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="dob" type="date" value="{{ old('dob')  ?? $staff->dob}}" placeholder="dd-mm-yyyy" value="" />
                                    <x-input-error :messages="$errors->get('dob')" class="mt-2 text-error" />
                                </div>
                            </div>
                            @push('script')
                            <script>
                                const date = "{{old('dob') ?? $staff->dob }}";
                                $('input[name="dob"]').val(date)
                            </script>
                            @endpush
                            <div>
                                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">{{ __('Phone number') }}</label>
                                <div class="mt-2">
                                    <x-bewama::form.input.text name="phone" type="text" value="{{ old('phone')  ?? $staff->phone}}" placeholder="Please fill phone number" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-error" />
                                </div>
                            </div>
                            <div>
                                <div class="mt-2 flex gap-4">
                                    <div class="flex gap-2 items-center">
                                        <input id="active" name="active" value="1" type='radio' @if(old('active') ?? $staff->active ) checked @endif />
                                        <label for="active">Active</label>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input id="unactive" name="active" value="0" type='radio' @if(old('active') !==null ? !old('active') : !$staff->active) checked @endif/>
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
                                <a href="{{ route('staffs.index') }}" class="inline-flex  text-white items-center gap-x-2 rounded-md bg-red-500 px-3.5 
                                py-2.5 text-sm font-semibold shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                 focus-visible:outline-primary">
                                    Return staff table
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