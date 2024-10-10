<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация о пользователе') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Обновите Вашу информацию.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('День рождения')" />
            <x-text-input id="birthday" name="birthday" type="date" :value="old('birthday', $user->birthday)" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

            <script>
                const birthdayInput = document.getElementById('birthday');
                const minDate = new Date('1925-01-01'); // Минимальная дата в календаре
                const maxDate = new Date(); // Текущая дата

                birthdayInput.min = minDate.toISOString().slice(0, 10); // Устанавливаем минимальную дату
                birthdayInput.max = maxDate.toISOString().slice(0, 10); // Устанавливаем максимальную дату
            </script>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Ваш email адрес не подтвержден.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Отправить письмо для подтверждения email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Ссылка с подтверждением email адреса отправлена на Ваш email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>
