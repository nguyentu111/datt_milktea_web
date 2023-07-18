@if(count($branches) > 0)
@foreach($branches as $branch)
<tr class="list-group-branch cursor-pointer hover:bg-slate-50">
    <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $branch->id }}</td>
    <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $branch->name }}</td>
    <td class="px-3 py-2 text-sm text-gray-500 whitespace-nowrap">{{ $branch->address }}</td>
</tr>
@endforeach
@endif