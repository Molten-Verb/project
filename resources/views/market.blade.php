<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биржа пилотов Формулы 1') }}
        </h2>
    </x-slot>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <div class="py-3">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-start">
                @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                @endif

                @if (session('status') === 'successfully purchased')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="font-bold text-green-600">
                        {{ __('Вы приобрели пилота.') }}</p>
                @endif

                @if (session('status') === 'unsuccessfully purchased')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="font-bold text-red-600">
                        {{ __('Недостаточно средств.') }}</p>
                @endif

                @if (session('status') === 'successfully sold')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="font-bold text-green-600">
                        {{ __('Пилот успешно продан.') }}</p>
                @endif

                @if (session('status') === 'unsuccessfully sold')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="font-bold text-red-600">
                        {{ __('Пилот не приобретен.') }}</p>
                @endif
            </div>
            <div class="flex justify-center text-base">
                Ваш баланс: {{ $balanceUSD ?? 'Авторизуйтесь для отображения баланса' }}
            </div>
        </div>
    </div>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex justify-center">
                <table class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                    <thead class="border-b bg-green text-black text-base rounded-t-lg">
                        <tr>
                            <th scope="col" class="px-6 py-4 flex items-center justify-between">
                                <div class="text-center">Гонщик</div>
                                <div class="flex flex-col">
                                    <a href="?sort=name&order=asc" class="fa fa-sort-up"></a>
                                    <a href="?sort=name&order=desc" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 justify-between">
                                <div class="text-center">Страна</div>
                                <div class="flex flex-col">
                                    <a href="?sort=country&order=asc" class="fa fa-sort-up"></a>
                                    <a href="?sort=country&order=desc" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 flex items-center justify-between">
                                <div class="text-center">Рыночная цена USD</div>
                                <div class="flex flex-col">
                                    <a href="?sort=price&order=asc" class="fa fa-sort-up"></a>
                                    <a href="?sort=price&order=desc" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4">
                                <div class="flex flex-col">
                                    Владелец
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4">
                                <div class="flex flex-col">
                                    Купить/продать
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($racersList as $racer)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 font-medium flex flex-col items-center">
                                    <img class="rounded-lg" src="{{ $racer->avatar }}" width="50%" height="auto">
                                    <p>{{ $racer->name }}</p>
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $racer->country }}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{ number_format($racer->price, 0, ' ', ' ') }}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{ $allUsers->where('id', $racer->user_id)->value('name') ?? 'в поиске контракта' }}
                                </td>
                                <th class="whitespace-nowrap  px-6 py-4 font-medium">
                                    <div class="flex space-x-2">
                                        <div>
                                            {{ html()->form('POST', route('market.buy', $racer->id))->open() }}
                                            @csrf
                                            @method('post')

                                            {{ html()->hidden($name = 'balanceUSD', $value = $balanceUSD) }}

                                            <button
                                                class="bg-green-500 shadow-green-500 shadow-lg shadow-green-500/50
                                                hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Купить
                                            </button>

                                            {{ html()->form()->close() }}
                                        </div>

                                        <div>
                                            {{ html()->form('POST', route('market.sell', $racer->id))->open() }}
                                            @csrf
                                            @method('post')

                                            <button
                                                class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                                Продать
                                            </button>

                                            {{ html()->form()->close() }}
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
