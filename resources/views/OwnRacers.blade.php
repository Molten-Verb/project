<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои пилоты') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">

            <div class="w-full grid grid-rows-2 grid-flow-col gap-4">
                @foreach ($racers as $racer)
                    <div class="grid grid-rows-3 grid-flow-col gap-4 bg-white shadow-sm sm:rounded-lg p-3 flex">
                        <div class="row-span-3">
                            <img class="rounded-lg" src="{{ $racer->avatar }}">
                        </div>
                        <div class="col-span-2">
                            <h2 class="text-lg font-medium text-gray-800">{{ $racer->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $racer->country }}</p>
                            <p class="text-sm text-gray-600 mt-2"> Стоимость:
                                {{ number_format($racer->price, 0, ' ', ' ') }} USD</p>
                        </div>
                        <div class="row-span-2 col-span-2 flex flex-col justify-center items-center">

                            <button
                                class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2">
                                Выставить на продажу
                            </button>

                            <button
                                class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2 mt-2">
                                Продать за 50% от стоимости
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</x-app-layout>
