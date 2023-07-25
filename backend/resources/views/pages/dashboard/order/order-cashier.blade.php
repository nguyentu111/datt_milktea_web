<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class=" rounded-lg px-4 py-4">
            <div class="flex py-2">
                <span class=" font-bold text-[20px]">
                    Order
                </span>
                <a href="{{route('orders.addOrder')}}" class="rounded block ml-auto px-3 py-2 font-bold bg-green-500 text-white">Add order</a>
            </div>
            <div class="grid grid-cols-2 gap-2">
                @foreach($orders as $order)
                <div class="rounded bg-white p-2 order-item" data-id="{{$order->id}}">
                    <div>
                        <div class="flex justify-between">
                            <span>Order type: {{$order->ship_to ? 'online' : 'offline'}}</span>
                            <span>Time: {{$order->created_at}}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Customer : {{$order->customer->last_name != 'default' ? $order->customer->first_name.' '.$order->customer->last_name.' - '.$order->customer->phone : 'Default' }}</span>
                            <span class="">Status : <span class="status">{{$order->status}}</span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="">Payment type : {{$order->payment_type}}</span>
                            <span>Paid : {{$order->is_paid ? 'yes' : 'no'}}</span>
                        </div>
                    </div>
                    <div class="border-t-2 p-2 flex ">
                        @foreach($order->orderDetails as $key=>$detail)
                        @if($key < 3) <div class="flex mr-2">
                            <div class="w-20 h-20">
                                <img src="{{$detail->drinkSize->product->picture ?? asset('assets/images/img-placeholder.png') }}" class="object-cover w-full h-full" />
                            </div>
                    </div>
                    @endif
                    @endforeach
                    @if(count($order->orderDetails) > 3)
                    <span>+ {{count($order->orderDetails) - 3}} others</span>
                    @endif
                    <div class="flex flex-col gap-4 ml-auto">
                        <button onclick="openModalInfo('{{$order->id}}')" class=" bg-blue-500 h-fit text-white rounded p-2">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="white">
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </svg> -->
                            info
                        </button>
                        <button onclick="openModelStatus('{{$order->id}}','{{$order->status}}')" class=" bg-blue-500 h-fit text-white rounded p-2">status</button>
                    </div>
                </div>

            </div>

            @endforeach
        </div>
        <div id="modal-info" style="display: none;">
            <div class="fixed bg-gray-500/20 inset-0 z-10" onclick="closeModalInfo()">
            </div>
            <div class="bg-white p-4 rounded fixed top-[50%] left-[50%]
                        -translate-x-[50%] -translate-y-[50%] flex flex-col
                        z-50 min-w-[900px] min-h-[500px]">
                <div class="grid grid-cols-10 gap-4">
                    <div class="col-span-6">
                        <div class="bg-green-200 rounded-md p-4">
                            <div class="flex justify-between">
                                <div class="flex mt-2">
                                    <span class="text-blue-600 font-bold">Type: </span>
                                    <span class="ml-2" id="type"></span>
                                </div>
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Order time: </div>
                                    <div class="ml-2" id="time"></div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Payment type: </div>
                                    <div class="ml-2" id="payment-type"></div>
                                </div>
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Is paid: </div>
                                    <div class="ml-2" id="paid"></div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Cheff: </div>
                                    <div class="ml-2" id="cheff"></div>
                                </div>
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Status: </div>
                                    <div class="ml-2" id="status"></div>
                                </div>
                            </div>
                            <div class="flex justify-between" id="shipto-wrap">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Shipto: </div>
                                    <div class="ml-2" id="shipto"></div>
                                </div>

                            </div>
                        </div>
                        <div class="bg-green-200 rounded-md p-4 mt-4">
                            <div class="text-blue-600 font-bold">Items: </div>
                            <div class="max-h-[300px] overflow-y-auto" id="items-wrap">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="bg-green-200 rounded-md p-4 ">
                            <div class="text-blue-600 font-bold " id="cus-default" style="display: none;">Default customer</div>
                            <div class="text-blue-600 font-bold " id="cus-wrap">Customer info</div>
                            <div class="flex justify-between">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Name: </div>
                                    <div class="ml-2" id="cus-name"></div>
                                </div>

                            </div>
                            <div class="flex justify-between">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Phone: </div>
                                    <div class="ml-2" id="cus-phone"></div>
                                </div>

                            </div>
                        </div>
                        <div class="bg-green-200 rounded-md p-4 mt-4">
                            <div class="">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Subtotal: </div>
                                    <div class="ml-2" id="subtotal"></div>
                                </div>

                            </div>
                            <div class="">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Shipping fee: </div>
                                    <div class="ml-2" id="ship-fee"></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Discount: </div>
                                    <div class="ml-2" id="discount"></div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Tax: </div>
                                    <div class="ml-2" id="tax"></div>
                                </div>
                            </div>
                            <div class="border-t-2 border-black">
                                <div class="flex mt-2">
                                    <div class="text-blue-600 font-bold">Total: </div>
                                    <div class="ml-2" id="total"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="modal-status" style="display: none;">
            <div class="fixed bg-gray-500/20 inset-0 z-10" onclick="closeModalStatus()">
            </div>
            <div class="bg-white p-4 rounded fixed top-[50%] left-[50%]
                        -translate-x-[50%] -translate-y-[50%] flex flex-col
                        z-50 min-w-[400px] min-h-[100px]">
                <div class="font-bold">Update status</div>
                <div>
                    <div class="pt-4">
                        <label for="status" class="block  text-sm font-medium leading-6 text-gray-900">{{ __('Category') }}</label>
                        <x-bewama::form.input.select name="status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="wait_for_shipping">Wait for shipping</option>
                            <option value="shipping">Shipping</option>
                            <option value="success">Success</option>
                            <option value="canceled">Canceled</option>
                        </x-bewama::form.input.select>
                    </div>
                </div>
                <button class="py-2 bg-green-500 rounded text-white mt-8" onclick="updateStatus()">Confirm</button>
            </div>
        </div>
        @push('script')
        <script>
            const orders = <?php echo json_encode($orders) ?>;
            let orderIdChoosing = null;
            async function updateStatus() {
                if (orderIdChoosing) {
                    try {
                        const response = await axios.post('/dashboard/update-order-status', {
                            id: orderIdChoosing,
                            status: $('#modal-status #status').val()

                        });
                        $('#modal-status').hide();
                        toastr.success('Success');
                        $('.order-item').each((i, e) => {
                            if ($(e).data('id') == orderIdChoosing) {
                                $(e).find('.status').text(response.data?.data?.status)
                            }
                        })
                        console.log(response.data);
                    } catch (error) {
                        toastr.error('Something wrong, try again later!');
                        console.log(error);
                    }
                } else {
                    toastr.error('Something wrong, try again later!');
                }

            }
            console.log(orders);

            function closeModalStatus() {
                $('#modal-status').hide();
            }

            function openModelStatus(id, status) {
                orderIdChoosing = id;
                console.log(status);
                $('#modal-status').show();
                $('#modal-status').find('option').each((i, e) => {

                    if ($(e).val() == status) {
                        $(e).parent().val(status)
                    }
                })
            }

            function openModalInfo(id) {
                const order = orders.find(o => o.id == id);
                $('#modal-info #type').text(order.ship_to ? 'Online' : 'Offline')
                $('#modal-info #time').text(order.created_at)
                $('#modal-info #payment-type').text(order.payment_type)
                $('#modal-info #paid').text(order.is_paid ? 'Yes' : 'No')
                $('#modal-info #cheff').text(order.cheff ? order.cheff.first_name + ' ' + order.cheff.last_name : 'null')
                $('#modal-info #status').text(order.status)
                if (order.ship_to) {
                    $('#modal-info #shipto').text(order.ship_to)
                    $('#modal-info #shipto-wrap').show()
                } else {
                    $('#modal-info #shipto-wrap').hide()

                }
                $('#modal-info #items-wrap').html('');
                order.order_details.forEach(detail => {
                    const toppings = detail.toppings.reduce((acc, val, i) => {
                        if (i !== detail.toppings.length - 1) {
                            return acc + val.product.name + ', ';
                        } else return acc + val.product.name;
                    }, '')
                    const price = +(detail.promotion_amount ?? detail.regular_amount)
                    const total = (price + detail.drink_size.price + price * detail.drink_size.product.tax +
                        detail.toppings.reduce((acc, val) => acc + val.price, 0)) * detail.amount
                    $('#modal-info #items-wrap').append(
                        `
                        <div class="p-2 text-[13px]">
                                <div class="flex gap-2 my-1">
                                    <div class="w-16 h-16 rounded border-2">
                                        <img src="${detail.drink_size.product.picture}" class="object-cover w-full h-full" id="preview" />
                                    </div>
                                    <div>
                                        <div>${detail.drink_size.product.name}</div>
                                        <div>Quantity : ${detail.amount}</div>
                                        <div>Size : ${detail.drink_size.size.name}</div>
                                        ${ toppings ? `<div>Topping: ${toppings}</div>` : '' }
                                        <div>Total : ${total}</div>

                                    </div>
                                </div>
                            </div>
                        `
                    )
                })
                //cus info
                if (order.customer.last_name != 'default') {
                    $('#modal-info #cus-default').hide()

                    $('#modal-info #cus-name').text(order.customer.first_name + ' ' + order.customer.last_name);
                    $('#modal-info #cus-phone').text(order.customer.phone)
                } else {
                    $('#modal-info #cus-default').show()
                    $('#modal-info #cus-wrap').hide()
                }

                ///end 
                $('#modal-info').show();

                console.log(order);
            }

            function closeModalInfo() {
                $('#modal-info').hide();
            }
        </script>
        @endpush
</x-app-layout>