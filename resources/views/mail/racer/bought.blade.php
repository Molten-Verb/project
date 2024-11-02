<x-mail::message>
# Уважаемый пользователь,
уведомляем, что пилот {{ $racer->name }} успешно приобретен!
    <div style="text-align: center;">
        <img class="rounded-lg" src="{{ asset($racer->avatar) }}" style="width: 50%">
    </div>
</x-mail::message>
