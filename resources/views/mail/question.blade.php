<h4>Контакт:</h4>
    <p>{{ $data->user->name }}, {{ $data->user->contact }}</p>
@if ($data->message)
    <h4>Сообщение:</h4>
    <p>{{ $data->message }}</p>
@endif

<br>
<p>-----<br>{{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y') }}</p>