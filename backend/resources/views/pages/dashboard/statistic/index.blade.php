<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <form class="flex py-8 gap-8" id="form-time">
            <div>
                <label for="from" class="block  text-sm leading-6 text-gray-900 font-bold">{{ __('From day') }}</label>
                <div class="mt-2">
                    <x-bewama::form.input.text type="date" name="from-day" required />
                </div>
            </div>
            <div>
                <label for="to" class="block  text-sm leading-6 text-gray-900 font-bold">{{ __('To day') }}</label>
                <div class="mt-2">
                    <x-bewama::form.input.text type="date" name="to-day" required />
                </div>
            </div>
            <button class="mt-auto px-2 py-1 text-[17px] font-bold uppercase bg-green-500 text-white rounded">Submit</button>
        </form>
        <div class="grid grid-cols-5 gap-4">
            <div class="min-h-[100px] relative bg-blue-500 rounded-lg text-white uppercase p-2 font-bold" id="revenue">
                <span>Revenue</span>
                <br />
                <span class="mt-3 absolute right-2 bottom-2 text-[20px] info"></span>
            </div>
            <div class="min-h-[100px] relative bg-orange-400 rounded-lg text-white uppercase p-2 font-bold" id="total-import">
                <span>Total import</span>
                <br />
                <span class="mt-3 absolute right-2 bottom-2 text-[20px] info" id=""></span>
            </div>
            <div class="min-h-[100px] relative bg-green-500 rounded-lg text-white uppercase p-2 font-bold" id="success-order">
                <span>Success order</span>
                <br />
                <span class="mt-3 absolute right-2 bottom-2 text-[20px] info"></span>
            </div>
            <div class="min-h-[100px] relative bg-red-500 rounded-lg text-white uppercase p-2 font-bold" id="cancled-order">
                <span>Canceled order</span>
                <br />
                <span class="mt-3 absolute right-2 bottom-2 text-[20px] info"></span>
            </div>
            <div class="min-h-[100px] relative bg-emerald-400 rounded-lg text-white uppercase p-2 font-bold" id="top-selling">
                <span>Top selling</span>
                <br />
                <span class="mt-3 absolute right-2 left-2 bottom-2 info text-[13px]"></span>
            </div>
        </div>
        <div class="py-8 grid grid-cols-2 gap-4">
            <div>
                <span class="font-bold">Topping sell</span>
                <table class="border-2  w-full bg-white" id="tb-topping">
                    <thead class="bg-gray-400 text-white">
                        <tr class="font-bold border-b-2">
                            <td class="p-2">id</td>
                            <td class="p-2">name</td>
                            <td class="p-2">amount</td>
                            <td class="p-2">total (vnd)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="py-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-500 dark:bg-transparent dark:text-white">{{ __('No record found.') }}</h3>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <span class="font-bold">Product sell</span>
                <table class="border-2  w-full rounded-lg bg-white" id="tb-product">
                    <thead class="bg-gray-400 text-white">
                        <tr class=" font-bold border-b-2">
                            <td class="p-2">id</td>
                            <td class="p-2">name</td>
                            <td class="p-2">amount</td>
                            <td class="p-2">total (vnd)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="py-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-500 dark:bg-transparent dark:text-white">{{ __('No record found.') }}</h3>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        const initData = <?php echo json_encode($data) ?>;
        updateView(initData);
        $('form').on('submit', async function(e) {
            // $('#from-day').
            e.preventDefault();
            const from = $('#from-day').val();
            const to = $('#to-day').val();
            const {
                data
            } = await axios.get(`/api/statistics?from_time=${from}&to_time=${to}`);
            updateView(data.data)
        })

        function updateView(data) {
            $('#from-day').val(data.from_time)
            $('#to-day').val(data.to_time)
            $('#revenue .info').text(data.revenue + ' vnd');
            $('#success-order .info').text(data.success_order);
            $('#total-import .info').text(data.total_import + ' vnd');
            $('#cancled-order .info').text(data.canceled_order);
            $('#top-selling .info').text(data.top_product_sell.length > 0 ? data.top_product_sell[0].product_name : 'No product');

            $('#tb-product tbody').html('');
            $('#tb-topping tbody').html('');
            data.top_product_sell.forEach(product => {
                $('#tb-product tbody').append(`
                    <tr class="odd:bg-gray-100">
                        <td class="p-2">${product.product_id}</td>
                        <td class="p-2">${product.product_name}</td>
                        <td class="p-2">${product.total_amount_sold}</td>
                        <td class="p-2">${product.total_sales_amount}</td>
                    </tr>
                `)
            })
            data.top_topping_sell.forEach(topping => {
                $('#tb-topping tbody').append(`
                    <tr class="odd:bg-gray-100">
                        <td class="p-2">${topping.product_id}</td>
                        <td class="p-2">${topping.product_name}</td>
                        <td class="p-2">${topping.total_amount} ${topping.uom}</td>
                        <td class="p-2">${topping.total_price}</td>
                    </tr>
                `)
            })
            if (data.top_product_sell.length == 0) {
                $('#tb-product tbody').append(`
                <tr>
                            <td colspan="4">
                                <div class="py-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-500 dark:bg-transparent dark:text-white">{{ __('No record found.') }}</h3>
                                </div>
                            </td>
                        </tr>
                `)
            }
            if (data.top_topping_sell.length == 0) {
                $('#tb-topping tbody').append(`
                <tr>
                            <td colspan="4">
                                <div class="py-6 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-500 dark:bg-transparent dark:text-white">{{ __('No record found.') }}</h3>
                                </div>
                            </td>
                        </tr>
                `)
            }
        }
    </script>
    @endpush
</x-app-layout>