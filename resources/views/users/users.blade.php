<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список пользователей') }}
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
                    <thead class="border-b text-black text-center text-base rounded-t-lg">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                    <div>Имя</div>
                                    <div class="flex flex-col ml-2">
                                        <a href="?sort=name" class="fa fa-sort-up"></a>
                                        <a href="?sort=-name" class="fa fa-sort-down"></a>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                <div >Email</div>
                                <div class="flex flex-col ml-2">
                                    <a href="?sort=email" class="fa fa-sort-up"></a>
                                    <a href="?sort=-email" class="fa fa-sort-down"></a>
                                </div>
                            </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                <div>День рождения</div>
                                <div class="flex flex-col ml-2">
                                    <a href="?sort=-birthday" class="fa fa-sort-up"></a>
                                    <a href="?sort=birthday" class="fa fa-sort-down"></a>
                                </div>
                            </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-row items-center justify-center">
                                <div>Дата создания аккаунта</div>
                                <div class="flex flex-col ml-2">
                                    <a href="?sort=-created_at" class="fa fa-sort-up"></a>
                                    <a href="?sort=created_at" class="fa fa-sort-down"></a>
                                </div>
                            </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center">
                                    Возможные действия
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <p>{{ $user->name }}</p>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->birthday ?? 'не указан' }}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{ $user->created_at }}</td>
                                <th class="whitespace-nowrap px-6 py-4">
                                    <div class="flex space-x-2">
                                        <div>
                                            @include('users.delete-form')
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
        {{ $users->links() }}
    </div>
</x-app-layout>
