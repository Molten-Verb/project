<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('История транзакций') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            @if ($userWallets->every(fn ($wallet) => $wallet->transactions->isEmpty()))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                У вас ещё нет транзацкий
            </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex justify-center" style="max-width: 800px;">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b-2 border-gray-300">Поступления</th>
                                <th class="px-4 py-2 border-b-2 border-gray-300">Валюта</th>
                                <th class="px-4 py-2 border-b-2 border-gray-300">Дата поступлений</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userWallets as $wallet)
                                @foreach ($wallet->transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->value }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300">{{ $wallet->currency_type }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->created_at }}</td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
