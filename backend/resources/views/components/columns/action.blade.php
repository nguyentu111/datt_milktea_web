<td class="inline-flex relative whitespace-nowrap border-b border-gray-200 py-4 pr-4 pl-3 text-sm font-medium sm:pr-8 lg:pr-8 space-x-2">
    @foreach($actions as $action)
        {{ $action->render($model) }}
    @endforeach
</td>