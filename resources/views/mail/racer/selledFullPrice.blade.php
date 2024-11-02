<x-mail::message>
# Уважаемый пользователь,
уведомляем, что пилот {{ $racer->name }} успешно продан за полную стоимость!
<div style="text-align: center;">
    <img class="rounded-lg" src="{{ $racer->avatar }}" style="width: 50%">
</div>
</x-mail::message>
