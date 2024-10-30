<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои пилоты') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                @foreach ($racers as $racer)
                    <div class="bg-white shadow-sm sm:rounded-lg p-3 flex">
                        <div class="w-2/3">
                            <img class="rounded-lg" src="{{ $racer->avatar }}">
                        </div>
                        <div class="w-2/3 flex flex-col">
                            <div>
                                <h2 class="text-lg font-medium text-gray-800">{{ $racer->name }}</h2>
                                <p class="text-sm text-gray-600">{{ $racer->country }}</p>
                                <p class="text-sm text-gray-600 mt-2"> Стоимость:
                                    {{ number_format($racer->price, 0, ' ', ' ') }} USD</p>
                            </div>
                            <div class="flex flex-col items-center mt-4">

                                {{ html()->form('POST', route('ownRacers.update', $racer))->open() }}
                                @csrf
                                @method('patch')
                                @if (!$racer->on_market)
                                    <button
                                        class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                    hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2 mt-2">
                                        Выставить на продажу
                                    </button>
                                @else
                                    <button
                                        class="bg-gray-500 shadow-gray-500 shadow-lg shadow-gray-500/50
                                                    hover:bg-gray-700 text-white text-sm font-bold py-2 px-4 rounded ml-2 mt-2">
                                        Снять с продажи
                                    </button>
                                @endif

                                {{ html()->form()->close() }}


                                {{ html()->form('POST', route('ownRacers.sell.half-price', $racer))->open() }}
                                <button
                                    class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2 mt-2">
                                    Продать за {{ config('racers.discount') }}% от стоимости
                                </button>
                                {{ html()->form()->close() }}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div>
        {{ $racers->links() }}
    </div>


</x-app-layout>
