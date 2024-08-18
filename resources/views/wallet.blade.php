<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Кошелек') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($isWalletCreate === null)
                <div class="p-6 text-gray-900">
                    <p>{{ __('Ваш кошелек ещё не создан') }}</p>
                    {{ html()->modelForm('POST', route('wallet.create'))->open() }}
                    <x-primary-button>{{ __('Создать кошелек') }}</x-primary-button>
                    {{ html()->closeModelForm() }}
                </div>

                @else
         
                <div class="p-6 text-gray-900">
                    <p>{{ __("Ваш баланс") }}</p>
                    <p>00.00</p>
                </div>
                    
                <div class="p-6 text-gray-900">
                    {{ html()->modelForm('PUT', route('wallet.update'))->open() }}

                    {{  html()->label('введите сумму', 'value') }}
                    {{ html()->text('value') }}
                
                    {{  html()->label('Выберите валюту', 'currency') }}
                    {{  html()->select('валюта', ['USD' => 'USD', 'EUR' => 'EUR']) }}

                    <div class="p-6 text-gray-900">
                        <x-primary-button>{{ __('Пополнить') }}</x-primary-button>
                    </div>

                    {{ html()->closeModelForm() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>