
@if (Session::get('messages'))
	@foreach(Session::get('messages')->getMessages() as $type=>$messages)
		@foreach($messages as $message)
			<div class="alert alert-{{$type}}">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{$message}}
			</div>
		@endforeach
	@endforeach
@endif