<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Биржа пилотов Формулы 1') }}
        </h2>
    </x-slot>

    <!-- ссылка для иконок сортировки -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    @if (session()->has('message'))
        <div class="py-3">
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex justify-center bg-green-100 text-base rounded-lg font-bold text-green-700">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="py-3">
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex justify-center bg-red-100 text-base rounded-lg font-bold text-red-700">
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex justify-center">
                <table class="min-w-full text-center text-sm font-light text-surface dark:text-white">
                    <thead class="border-b bg-green text-black text-base rounded-t-lg">
                        <tr>
                            <th scope="col" class="px-6 py-4 flex items-center justify-between">
                                <div class="text-center">Гонщик</div>
                                <div class="flex flex-col">
                                    <a href="?sort=name" class="fa fa-sort-up"></a>
                                    <a href="?sort=-name" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 justify-between">
                                <div class="text-center">Страна</div>
                                <div class="flex flex-col">
                                    <a href="?sort=country" class="fa fa-sort-up"></a>
                                    <a href="?sort=-country" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 flex items-center justify-between">
                                <div class="text-center">Рыночная цена USD</div>
                                <div class="flex flex-col">
                                    <a href="?sort=-price" class="fa fa-sort-up"></a>
                                    <a href="?sort=price" class="fa fa-sort-down"></a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4">
                                <div class="flex flex-col">
                                    Купить
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($racers as $racer)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 font-medium flex flex-col items-center">
                                    <img class="rounded-lg" src="{{ $racer->avatar }}" width="50%" height="auto">
                                    <p>{{ $racer->name }}</p>
                                </td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $racer->country }}</td>
                                <td class="whitespace-nowrap  px-6 py-4 font-medium">
                                    {{ number_format($racer->price, 0, ' ', ' ') }}</td>
                                <th class="whitespace-nowrap px-6 py-4 font-medium">
                                    <div class="flex space-x-2">
                                        <div>
                                            {{ html()->form('POST', route('market.buy', $racer))->open() }}
                                            @csrf
                                            @method('post')

                                            <button
                                                class="bg-green-500 shadow-green-500 shadow-lg shadow-green-500/50
                                                hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Купить
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
    <div>
        {{ $racers->links() }}
    </div>
</x-app-layout>
