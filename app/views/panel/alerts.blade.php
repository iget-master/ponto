@if (Session::get('messages'))
	@foreach(Session::get('messages')->all() as $type=>$message)
		{{1}}
		{{ var_dump($type, $message) }}
	@endforeach
@endif