<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои пилоты') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            @foreach ($racers as $racer)
            <div class="w-full grid grid-rows-2 grid-flow-col gap-4 flex">



                    <div class="bg-white shadow-sm sm:rounded-lg p-6 flex justify-center">
                        <div>
                            <img class="rounded-lg" src="{{ $racer->avatar }}">
                        </div>
                        <div class="flex space-y-2">
                            <div>
                            <h2 class="text-lg font-medium text-gray-800">{{ $racer->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $racer->country }}</p>
                            </div>
                            <div>
                            <button
                                class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2">
                                Выставить на продажу
                            </button>
                            </div>
                            <div>
                            <button
                                class="bg-red-500 shadow-red-500 shadow-lg shadow-red-500/50
                                                hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded ml-2">
                                Продать со скидкой 50% прямо сейчас
                            </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</x-app-layout>
