@if(count($users) > 0)
    @foreach($users as $user)
        <tr class="list-group-user cursor-pointer hover:bg-slate-50">
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $user->id }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $user->name }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $user->email }}</td>
            <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $user->phone_number }}</td>
        </tr>
    @endforeach
@endif