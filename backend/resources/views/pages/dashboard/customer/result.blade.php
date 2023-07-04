@if(count($customers) > 0)
    @foreach($customers as $customer)
        <tr class="list-group-customer cursor-pointer">
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $customer->id }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $customer->name }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $customer->email }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $customer->phone_number }}</td>
        </tr>
    @endforeach
@endif