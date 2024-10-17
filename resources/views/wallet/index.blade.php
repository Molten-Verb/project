<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Кошелек') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 800px;">

                @if (!empty($missingWallets))
                    <div class="p-6 text-gray-900">
                        <p class="font-bold">{{ __('Создайте кошелек') }}</p>
                        {{ html()->modelForm('POST', route('wallet.store', ['id => $id']))->open() }}
                        @csrf
                        @method('post')

                        {{ html()->label('Выберите валюту кошелька', 'currency') }}
                        {{ html()->select('currency', $missingWallets)->class('mt-1 block w-40 rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500') }}

                        <x-primary-button class="bg-blue-500 shadow-blue-500 shadow-lg shadow-blue-500/50 hover:bg-blue-700" style="background-color: #282aa7;">
                            {{ __('Создать кошелек') }}
                        </x-primary-button>
                        {{ html()->closeModelForm() }}
                    </div>
                @endif

                <div class="p-6 text-gray-900">
                    <p>{{ __('Ваш баланс') }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="flex flex-row gap-4">
                            @foreach ($balance as $currencyName => $value)
                                @if (in_array($currencyName, $existsWallets))
                                    <a
                                    class="mt-1 block w-40 rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $value }}
                                        {{ $currencyName }}</a>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <x-primary-button
                                onclick="window.location.href='{{ route('wallet.history', ['id => $id']) }}'"
                                class="bg-blue-500 shadow-blue-500 shadow-lg shadow-blue-500/50 hover:bg-blue-700" style="background-color: #282aa7;">
                                История транзакций
                            </x-primary-button>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    {{ html()->modelForm('POST', route('wallet.update', ['id' => $id]))->open() }}
                    @csrf
                    @method('patch')
                    <div class="flex">
                        <div class="flex flex-row gap-4">
                            {{ html()->label('Введите сумму', 'value') }}
                            {{ html()->number('value', 00.0, $min = null, $max = null, $step = 0.01)->class('mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500') }}

                            {{ html()->select('currency', $existsWallets)->class('mt-1 block w-40 rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500') }}
                        </div>
                    </div>
                    <div class="p-6 text-gray-900">
                        <x-primary-button
                            class="bg-green-500 shadow-green-500 shadow-lg shadow-green-500/50 hover:bg-green-700">
                            {{ __('Пополнить') }}
                        </x-primary-button>
                    </div>

                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
