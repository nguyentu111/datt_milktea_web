<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white rounded-lg">
            <span class="px-4 py-4 font-bold text-[20px]">
                Order
            </span>
            <div class="px-4 py-4 grid grid-cols-2 gap-6">
                @foreach($orders as $order)
                <div data-id="{{$order->id}}" class="order-section rounded-lg border-2 px-2 py-2" style="background-color: beige;">
                    <div class="flex justify-between">
                        <span>Created at : {{$order->created_at}}</span>
                        <div class="text-white rounded px-1 status" style="background-color:cadetblue">Status : {{$order->status}}</div>
                    </div>
                    <button onclick="test({{$order->id}},'{{ $order->status}}')" @if($order->status==='wait_for_shipping')
                        disabled
                        style="background-color:gray;"
                        @endif
                        class="btn-status bg-green-500 px-2 py-1 rounded text-white">
                        {{$order->status == 'pending' ? 'Accept' : 'Done'}}</button>
                    <div class="overflow-y-scroll" style="max-height: 300px;">
                        @foreach($order->orderDetails as $orderDetail)
                        <div class="flex py-2" onclick='openModal(<?php echo json_encode($orderDetail) ?>)'>
                            <div class="w-20 h-20 rounded border-2">
                                <img src="{{ $orderDetail->drinkSize->product->picture ??  asset('assets/images/img-placeholder.png') }}" class="object-cover w-full h-full" id="preview" />
                            </div>
                            <div class="pl-2 flex flex-col">
                                <span class="font-bold text-[13px]">{{$orderDetail->drinkSize->product->name}}</span>
                                <span class="text-[13px]">size: {{$orderDetail->drinkSize->size->name}}</span>
                                @if(count($orderDetail->toppings ) > 0)
                                <span class="text-[13px]">toppings :
                                    @foreach($orderDetail->toppings as $key=>$topping)
                                    @if($key != count($orderDetail->toppings) -1 )
                                    <span>{{$topping->product->name}},</span>
                                    @else <span>{{$topping->product->name}}</span>
                                    @endif
                                    @endforeach
                                </span>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <div id="modal" style="display: none">
                    <div class="fixed bg-gray-500/20 inset-0 z-10" onclick="closeModal()">
                    </div>
                    <div class="bg-white p-4 rounded fixed top-[50%] left-[50%]
                    -translate-x-[50%] -translate-y-[50%] flex flex-col
                     z-50 min-w-[400px] min-h-[300px]">
                        <span class="font-bold text-[20px]">Recipes</span>
                        <div class="flex">
                            <div class="w-20 h-20 rounded border-2">
                                <img src="{{ asset('assets/images/img-placeholder.png') }}" class="object-cover w-full h-full" id="preview" />
                            </div>
                            <div class="text-[13px] pl-2">
                                <span class="font-bold" id="name"></span>
                            </div>
                        </div>
                        <div class="py-2 ">
                            <span class="block" id="size"></span>
                            <div class="wrap-size max-h-[200px] overflow-y-auto">
                            </div>
                        </div>
                        <div class="py-2 ">
                            <span class="block">Topping recipes: </span>
                            <div class="wrap-topping max-h-[200px] overflow-y-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('script')
            <script>
                const orders = <?php echo json_encode($orders) ?>;
                async function test(id) {
                    const order = orders.find(o => o.id == id);
                    const url = window.location.origin;
                    const response = await axios.post(`${url}/dashboard/update-order-status`, {
                        id: id,
                        cheff_id: "{{Auth::user()->staff->id}}",
                        status: order.status == 'pending' ? 'processing' : 'wait_for_shipping'
                    })
                    if (response.status == 200) {
                        toastr.success('update status success')
                        const status = response.data.data.status;
                        order.status = status;
                        $('.order-section').each(function(i, elem) {
                            if ($(elem).data('id') == id) {
                                $(elem).children().children('.status').text('Status : ' + response.data.data.status);
                                if (status === 'processing') {
                                    $(elem).children('.btn-status').text('done');
                                }
                                if (status === 'wait_for_shipping') {
                                    $(elem).children('.btn-status').css('background-color', 'gray')
                                    $(elem).children('.btn-status').prop('disabled', true)
                                };
                            }
                        })
                    }
                }

                function closeModal() {
                    $('#modal').hide();
                }


                function openModal(data) {
                    console.log(data);
                    const modal = $('#modal');
                    modal.find('img').first().prop('src', data.drink_size.product.picture);
                    modal.find('#name').first().text(data.drink_size.product.name);
                    modal.find('#size').first().text('Size ' + data.drink_size.size.name + ' recipes:')
                    modal.find('.wrap-size').html("");
                    data.drink_size.recipes.forEach(rec => {
                        modal.find('.wrap-size').append(`
                                <div class="flex py-1 ">
                                    <div class="w-14 h-14 rounded border-2">
                                        <img src="${rec.material.picture}" class="object-cover w-full h-full" id="preview" />
                                    </div>
                                    <div class="pl-2">
                                        <span class="block">${rec.material.name}</span>
                                        <span class="block">amount: <span>${rec.amount} ${rec.material.uom.name}</span></span>
                                    </div>
                                </div>
                        `)
                    })
                    modal.find('.wrap-topping').html("");
                    data.toppings.forEach(rec => {
                        modal.find('.wrap-topping').append(`
                                <div class="flex py-1 ">
                                    <div class="w-14 h-14 rounded border-2">
                                        <img src="${rec.product.picture}" class="object-cover w-full h-full" id="preview" />
                                    </div>
                                    <div class="pl-2">
                                        <span class="block">${rec.product.name}</span>
                                        <span class="block">amount: <span>${rec.amount} ${rec.product.uom.name}</span></span>
                                    </div>
                                </div>
                        `)
                    })
                    modal.show();
                }
            </script>

            @endpush
</x-app-layout>