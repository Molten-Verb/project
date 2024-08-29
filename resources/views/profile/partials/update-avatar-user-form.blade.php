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

    <form action="{{ route('profile.avatar.update') }}" method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
        <label class="form-label" for="inputImage">Image:</label>
                <input
                    type="file"
                    name="image"
                    id="inputImage"
                    class="form-control @error('image') is-invalid @enderror">

                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'avatar-updated')
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

