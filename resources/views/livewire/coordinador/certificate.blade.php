<div class="mt-4 overflow-x-auto">
    @if ($users->count())
        <table class="table-auto w-full sm:w-5/6 mx-auto p-2">
            <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 whitespace-nowrap font-semibold">Nombres</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Documento</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Ficha</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Programa</th>
                    </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($users as $user)
                    @foreach ($user->fichas as $ficha)
                    @endforeach
                    <tr class="hover:bg-orange-50">
                        <td class="text-left font-bold text-gray-800">
                            <a class="block p-2" href="{{ route('fichas.users.show', [$ficha->code, $user]) }}">
                                {{ Str::limit($user->profile->names." ".$user->profile->surnames, 30) }}
                            </a>
                        </td>
                        <td class="text-center font-bold text-gray-800">
                            <a class="block p-2" href="{{ route('fichas.users.show', [$ficha->code, $user]) }}">
                                {{ $user->document }}
                            </a>
                        </td>
                        <td class="text-center font-bold text-gray-800">
                            <a class="block p-2" href="{{ route('fichas.users.show', [$ficha->code, $user]) }}">
                                {{ $ficha->code }}
                            </a>
                        </td>
                        <td class="text-center font-bold text-gray-800">
                            <a class="block p-2" href="{{ route('fichas.users.show', [$ficha->code, $user]) }}">
                                {{ $ficha->program->name }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="w-full sm:w-5/6 mx-auto p-2">
            {{ $users->links() }}
        </div>
    @else
        <div class="flex items-center bg-sky-600 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>No Hay aprendices en este estado.</p>
        </div>
    @endif
</div>
