<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биржа пилотов Формулы 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex justify-center">
                <table class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                    <thead class="border-b bg-blue-900 text-white font-medium">
                        <tr>
                            <th scope="col" class=" px-6 py-4">Гонщик</th>
                            <th scope="col" class=" px-6 py-4">Национальность</th>
                            <th scope="col" class=" px-6 py-4">Рыночная цена</th>
                            <th scope="col" class=" px-6 py-4">Владелец</th>
                            <th scope="col" class=" px-6 py-4">Купить/продать</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($racersList as $racer)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <img class="rounded-lg" src="{{ $racer->avatar }}" width="50%" height="auto">
                                    <p>{{ $racer->name }}</p>
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $racer->country }}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $racer->price }}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $racer->holder ?? 'нет' }}</td>
                                <th class="whitespace-nowrap  px-6 py-4 font-medium">Купить/продать</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
