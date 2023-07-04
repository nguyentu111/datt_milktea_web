<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            @if($heading)
                <h1 class="text-xl text-black uppercase font-bold dark:text-white">{{ __($heading) }}</h1>
            @endif
            @if($description)
                <p class="mt-4 text-sm text-slate-500 dark:text-slate-100">{{ __($description) }}</p>
            @endif
        </div>
        <div>
            <a href="{{ $add_route }}" class=" hover:bg-green-700 hover:text-slate-100 bg-green-500 cursor-pointer text-white p-4 rounded-lg ">
                {{ $add_label }}
            </a>
        </div>
    </div>
    <div class="flow-root mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 ">
                <div class="overflow-hidden shadow ring-1 ring-black border-slate-200 border dark:border-white ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 ">
                        <thead class="bg-gray-50 dark:bg-transparent ">
                        <tr>
                            @foreach($columns as $column)
                                <th scope="col" class="px-3 dark:text-slate-100 uppercase py-3.5 text-left text-xs !font-semibold text-slate-700">
                                    {{ $column->getLabel() }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:devide-white divide-gray-200 dark:bg-transparent">
                        @forelse($rows as $model)
                            <tr>
                                @foreach($columns as $column)
                                    @if($column instanceof \App\Tables\Columns\ActionColumn)
                                        {!! $column->render($model) !!}
                                    @else
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:bg-transparent dark:text-white">
                                            @if($column->getUrl($model))
                                                <a href="{{ $column->getUrl($model) }}" target="{{ $column->isOpenInNewTab() ? '_blank' : '_self' }}" class="transition-all hover:text-green-600">
                                                    {!! $column->render($model) !!}
                                                </a>
                                            @else
                                                {!! $column->render($model) !!}
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) }}">
                                    <div class="py-6 text-center">
                                        <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-semibold text-gray-500 dark:bg-transparent dark:text-white">{{ __('No record found.') }}</h3>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    @if($rows->hasPages())
                        <div class="p-4">
                            {{ $rows->links('bewama::components.table.partials.pagination') }}
                        </div>
                    @endif

                    @foreach($modals as $modal)
                        {!! $modal !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>