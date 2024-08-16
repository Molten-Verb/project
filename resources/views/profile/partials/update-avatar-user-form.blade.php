<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Ваш аватар') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Вы можете изменить свой аватар") }}
        </p>
    </header>

    <div class="flex items-center gap-4">
        <img class="TopNavBtn__profileImg" src="{{ Auth::user()->avatar }}" style="width: 100px; height: 100px; border-radius: 75px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);">
    </div>

    <form method="post" action="{{ route('avatar.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- <form action="/action_page.php" method="post" enctype="multipart/form-data"> -->
<!-- <input type="file" name="avatar" accept="image/*"> -->
<!-- <input type="submit" value="Загрузить аватар"> -->