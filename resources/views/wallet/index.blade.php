<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Кошелек') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 800px;">

                @if (!empty($existsWallets))
                    <div class="p-6 text-gray-900">
                        <p>{{ __('Создайте кошелек') }}</p>
                        {{ html()->modelForm('POST', route('wallet.store', ['id => $id']))->open() }}
                            @csrf
                            @method('post')

                            {{  html()->label('Выберите валюту кошелька', 'currency') }}
                            {{  html()->select('currency', $existsWallets) }}

                            <x-primary-button style="background-color: #282aa7; color: white;">
                                {{ __('Создать кошелек') }}
                            </x-primary-button>
                        {{ html()->closeModelForm() }}
                    </div>
                @endif

                <div class="p-6 text-gray-900">
                    <p>{{ __("Ваш баланс") }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            @foreach ($balance as $currencyName => $value)
                            <a style="display: inline-block; border: 1px solid black; padding: 5px; text-align: center;">{{ $value }} {{ $currencyName }}</a>
                            @endforeach
                        </div>
                        <div>
                            <x-primary-button onclick="window.location.href='{{ route('wallet.history', ['id => $id']) }}'" style="background-color: #007bff; color: white;">
                                История транзакций
                            </x-primary-button>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    {{ html()->modelForm('POST', route('wallet.update', ['id' => $id]))->open() }}
                    @csrf
                    @method('patch')

                    {{  html()->label('введите сумму', 'value') }}
                    {{ html()->number('value', 00.00, $min = null, $max = null, $step = 0.01) }}

                    {{  html()->label('Выберите валюту', 'currency') }}
                    {{  html()->select('currency', ['RUB' => 'RUB', 'USD' => 'USD', 'EUR' => 'EUR']) }}

                    <div class="p-6 text-gray-900">
                        <x-primary-button style="background-color: #28a745; color: white;">
                            {{ __('Пополнить') }}
                        </x-primary-button>
                    </div>

                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
