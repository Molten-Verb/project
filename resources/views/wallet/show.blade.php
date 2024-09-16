<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('История транзакций') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Поступления</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Валюта</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Дата поступлений</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rubleTransactions as $transaction)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->value }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">RUB</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Поступления</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Валюта</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Дата поступлений</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dollarTransactions as $transaction)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->value }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">USD</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Поступления</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Валюта</th>
                            <th class="px-4 py-2 border-b-2 border-gray-300">Дата поступлений</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($euroTransactions as $transaction)
                        <tr>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->value }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">EUR</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $transaction->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
