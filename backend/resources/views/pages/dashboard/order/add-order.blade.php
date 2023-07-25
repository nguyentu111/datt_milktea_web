<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class=" rounded-lg">
            <span class="px-4 py-4 font-bold text-[20px]">
                Add order
            </span>
            <div class="grid grid-cols-10 gap-4">
                <div class="col-span-6 ">
                    <div class="bg-white px-4 py-2 mb-4">
                        <div class="flex font-bold justify-between py-2">
                            <div> Customer</div>
                            <div class="flex gap-4">
                                <button class="default-cus-btn rounded block ml-auto px-3 py-2 font-bold bg-red-500 text-white">Use default customer</button>
                                <button onclick="openModalCus()" class="rounded block ml-auto px-3 py-2 font-bold bg-green-500 text-white"> Add customer</button>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="col-span-3 relative focus:fixed focus:-mt-2 focus:w-[40%]">
                                <svg class="absolute inset-y-0 right-0 me-2 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                                <x-bewama::form.input.text name="search-cus" id="search-cus" type="text" placeholder="Search customer" />
                                <div id="result-cus" style="display: none;" class="absolute top-full left-0 right-0 bg-white p-2 border-2 rounded-lg overflow-auto  col-span-3  z-50">
                                    <table class="divide-y divide-gray-300 min-w-full">
                                        <tbody class="table-body bg-white divide-y divide-gray-200" id="cus-list">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div id="cus-info" class="flex flex-col py-2 font-bold">
                                <span>Customer id: <span id="cus-id"></span></span>
                                <span>Customer name: <span id="cus-name"></span></span>
                                <span>Customer phone: <span id="cus-phone"></span></span>
                            </div>
                            <div id="default-cus" style="display: none;" class="py-2 font-bold">
                                <span>Using default cus<span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 max-h-[400px] bg-white px-4 py-4 overflow-y-auto">
                        <div class="">
                            @foreach($drinks as $drink)
                            <div class="flex gap-2 my-1" onclick="openModalDrink({{$drink['id']}})">
                                <div class="w-20 h-20 rounded border-2">
                                    <img src="{{ $drink['picture'] ??  asset('assets/images/img-placeholder.png') }}" class="object-cover w-full h-full" id="preview" />
                                </div>
                                <div>
                                    <div>{{$drink['name']}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="px-4 py-4 bg-white col-span-4">
                    <div class="">
                        <div class="py-2"> checkout info</div>
                        <div class="py-2 max-h-[350px] overflow-y-auto" id="cart-wrap">
                        </div>
                        <div class="">
                            <!-- <div class="flex justify-between border-t-2">
                                <span class="font-bold">Subtotal : </span>
                                <span class="font-bold" id="sub-total">0 đ</span>
                            </div> -->
                            <!-- <div class="flex justify-between border-t-2">
                                <span class="font-bold">Tax : </span>
                                <span class="font-bold" id="tax">0 đ</span>
                            </div> -->
                            <div class="flex justify-between border-t-2">
                                <span class="font-bold text-[20px]">Total : </span>
                                <span class="font-bold text-[20px] text-blue-500" id="total">0 đ</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div id="modal-customer" style="display: none">
                <div class="fixed bg-gray-500/20 inset-0 z-10" onclick="closeModalCus()">
                </div>
                <div class="bg-white p-4 rounded fixed top-[50%] left-[50%]
                    -translate-x-[50%] -translate-y-[50%] flex flex-col
                     z-50 min-w-[400px] min-h-[300px]">
                    <span class="font-bold block">Add customer</span>
                    <div>
                        <div>
                            <label for="first_name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('First name') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="first_name" type="text" />
                            </div>
                        </div>
                        <div>
                            <label for="last_name" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Last name') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="last_name" type="text" required />
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Phone') }}</label>
                            <div class="mt-2">
                                <x-bewama::form.input.text name="phone" type="text" required />
                            </div>
                        </div>
                        <button id="add-cus-confirm" class="mt-2 rounded block ml-auto px-3 py-2 font-bold bg-green-500 text-white">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
            <div id="modal-drink" style="display: none;">
                <div class="fixed bg-gray-500/20 inset-0 z-10" onclick="closeModalDrink()">
                </div>
                <div class="bg-white p-4 rounded fixed top-[50%] left-[50%]
                    -translate-x-[50%] -translate-y-[50%] flex flex-col
                     z-50 min-w-[400px] min-h-[300px]">
                    <div class="flex gap-2">
                        <div class="w-20 h-20 rounded border-2">
                            <img id="modal-drink-picture" src="{{asset('assets/images/img-placeholder.png') }}" class="object-cover w-full h-full" id="preview" />
                        </div>
                        <div>
                            <div id="modal-drink-name">name</div>
                            <div>
                                <span id="modal-drink-regular-price"></span>
                                <span id="modal-drink-promotion-price"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>Sizes :</div>
                        <div id="modal-drink-sizes" class="py-2">
                        </div>
                    </div>
                    <div class="mt-2">
                        <div>Toppings:</div>
                        <div id="modal-drink-toppings" class="py-2">
                        </div>
                    </div>
                    <button id="add-drink-confirm" class="mt-2 rounded block ml-auto px-3 py-2 font-bold bg-green-500 text-white">
                        Confirm
                    </button>
                </div>
            </div>
            @push('script')
            <script>
                async function searchCus(term) {
                    const response = await axios.get('/dashboard/search-cus?search=' + term);
                    return response.data?.data ?? [];
                }
                const seachInput = $('#search-cus');
                const drinks = <?php echo json_encode($drinks) ?>;
                const cart = {
                    items: [],
                };
                console.log(drinks);
                seachInput.on('input', function() {
                    clearTimeout(this.delay);
                    $('.table-body').html('');
                    const term = seachInput.val();
                    if (!term) {
                        $('#result-cus').hide();
                        return;
                    }
                    this.delay = setTimeout(async function() {

                        const data = await searchCus(term);
                        if (data.length == 0) {
                            $('.table-body').append(`
                                <tr>
                                    <td>Not found any customer</td>
                                </tr>
                            `);
                            return;
                        }
                        data.forEach(cus => {
                            $('.table-body').append(`
                                <tr onclick="handleCheckCus(${cus.id},'${cus.first_name} ${cus.last_name}','${cus.phone}')">
                                    <td>${cus.id}</td>
                                    <td>${cus.first_name} ${cus.last_name}</td>
                                    <td>${cus.phone}</td>
                                </tr>
                            `);
                        })
                        $('#result-cus').show();
                    }.bind(this), 800)
                })

                function handleCheckCus(id, name, phone) {
                    $('#result-cus').hide();
                    $('#cus-id').text(id);
                    $('#cus-name').text(name);
                    $('#cus-phone').text(phone);
                }
                let isDefaultCus = false;
                const btnDefaultCus = $('.default-cus-btn');
                let oldId = "";
                const defaultCus = <?php echo json_encode($defaultCus) ?>;
                btnDefaultCus.on('click', bool => {
                    $('#result-cus').hide();
                    if (isDefaultCus) {
                        isDefaultCus = false;
                        btnDefaultCus.text('Use default customer')
                        $('#cus-info').show();
                        $('#default-cus').hide();
                    } else {
                        isDefaultCus = true;
                        btnDefaultCus.text('Undo')
                        $('#cus-info').hide();
                        $('#default-cus').show();
                    }
                })
                const modalCus = $('#modal-customer');
                const modalDrink = $('#modal-drink');

                function closeModalCus() {
                    modalCus.hide();
                }

                function openModalCus() {
                    modalCus.show();
                }
                $('#add-cus-confirm').on('click', async function() {
                    try {
                        const result = await axios.post('/dashboard/add-cus', {
                            first_name: $('#first_name').val(),
                            last_name: $('#last_name').val(),
                            phone: $('#phone').val(),
                        })
                        $('#cus-id').text(result.data.data.id);
                        $('#cus-name').text(result.data.data.first_name + ' ' + result.data.data.last_name);
                        $('#cus-phone').text(result.data.data.phone);
                        modalCus.hide();
                        toastr.success('success');
                    } catch (error) {
                        toastr.error('failed');
                    }
                })

                function closeModalDrink() {
                    modalDrink.hide();
                }


                const sizeWrap = $('#modal-drink-sizes');
                const toppingWrap = $('#modal-drink-toppings');
                let drink = null

                function openModalDrink(id) {
                    drink = drinks.find(v => v.id == id);
                    $('#modal-drink-picture').prop('src', drink.picture);
                    $('#modal-drink-name').text(drink.name);

                    toppingWrap.html("");
                    sizeWrap.html("");
                    $('#modal-drink-regular-price').text(drink.regular_amount + drink.regular_amount * drink.tax);

                    if (drink.promotion_amount) {
                        console.log(drink.promotion_amount + drink.promotion_amount * drink.tax, drink.name);
                        $('#modal-drink-promotion-price').text(drink.promotion_amount + drink.promotion_amount * drink.tax);
                        $('#modal-drink-regular-price').replaceWith('<strike id ="modal-drink-regular-price">' +
                            $('#modal-drink-regular-price').html() + '</strike>');
                    } else {
                        $('#modal-drink-promotion-price').text('');
                        $('#modal-drink-regular-price').replaceWith('<span id ="modal-drink-regular-price">' +
                            $('#modal-drink-regular-price').html() + '</span>');
                    }
                    drink.sizes.forEach(size => {
                        sizeWrap.append(`
                            <div class="size-item">
                                <input type="radio" name="size-input" checked class="checkbox-size" 
                                data-sizeid="${size.id}" data-sizename="${size.name}" data-sizeprice="${size.price}"/>
                                <span>${size.name}</span>
                                <span>${size.price}</span>
                            </div>
                        `)
                    })
                    drink.toppings.forEach(topping => {
                        toppingWrap.append(`
                            <div class="topping-item">
                                <input type="checkbox" name="topping-input" class="checkbox-topping" data-toppingid="${topping.id}"
                                data-toppingname="${topping.name}" data-toppingtax="${topping.tax}" data-toppingprice="${topping.price}"/>
                                <span>${topping.name}</span>
                                <span>${topping.price + topping.price*topping.tax}</span>
                            </div>
                        `)
                    })

                    modalDrink.show();
                }
                $('#add-drink-confirm').first().on('click', function() {
                    const toppingChoosing = [];
                    $('.checkbox-topping:checked').each((i, e) => toppingChoosing.push({
                        id: $(e).data('toppingid'),
                        name: $(e).data('toppingname'),
                        tax: $(e).data('toppingtax'),
                        price: $(e).data('toppingprice'),
                    }))
                    const sizeId = $('.checkbox-size:checked').first().data('sizeid');
                    const item = cart.items.find(item => item.drink.id == drink.id &&
                        sizeId == item.size.id &&
                        JSON.stringify(toppingChoosing) == JSON.stringify(item.toppings));
                    if (item) {
                        item.quantity += 1;
                    } else
                        cart.items.push({
                            drink,
                            size: {
                                id: sizeId,
                                name: $('.checkbox-size:checked').first().data('sizename'),
                                price: $('.checkbox-size:checked').first().data('sizeprice')
                            },
                            toppings: toppingChoosing,
                            quantity: 1
                        })
                    updateCartView()
                })

                function updateCartView() {
                    $('#cart-wrap').html('');
                    cart.items.forEach(function(item) {
                        const toppings = item.toppings.reduce((acc, val, i) => {
                            if (i !== item.toppings.length - 1) {
                                return acc + val.name + ', ';
                            } else return acc + val.name;
                        }, '')
                        const price = (item.drink.promotion_amount ?? item.drink.regular_amount)
                        const total = (price + item.size.price + price * item.drink.tax +
                            item.toppings.reduce((acc, val) => acc + val.price, 0)) * item.quantity

                        $('#cart-wrap').append(`
                            <div>
                                <div class="flex gap-2 my-1">
                                    <div class="w-20 h-20 rounded border-2">
                                        <img src="${item.drink.picture}" class="object-cover w-full h-full" id="preview" />
                                    </div>
                                    <div>
                                        <div>${item.drink.name}</div>
                                        <div>Quantity : ${item.quantity}</div>
                                        <div>Size : ${item.size.name}</div>
                                        ${ toppings ? `<div>Topping: ${toppings}</div>` : '' }
                                        <div>Total : ${total}</div>

                                    </div>
                                </div>
                            </div>
                        `)
                    })
                }
            </script>
            @endpush
</x-app-layout>