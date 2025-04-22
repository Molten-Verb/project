<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список пилотов') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex justify-center">
                <table class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                    <thead class="border-b text-black text-base rounded-t-lg">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div>Номер</div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div></div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div>Гонщик</div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div>Страна</div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div>Команда</div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jsonDecodedDrivers as $driver)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $driver['driver_number'] }}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                    <img class="rounded-lg" src="{{ $driver['headshot_url'] }}" width="auto%" height="auto">
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $driver['full_name'] }}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $driver['country_code'] }}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $driver['team_name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
