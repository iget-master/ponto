@extends((Request::ajax())?"layout.ajax":"layout.panel")

@section('content')
	@include('panel.alerts')
	<div class="table-wrapper">
		<table id="users_table" class="table table-condensed" >
			<thead>
				<th><input type="checkbox"></th>
				<th>ID</th>
				<th>Nome</th>
				<th>Email</th>
				<th></th>
			</thead>
			<tbody>
			@foreach ($users as $user)
				<tr data-id="{{ $user->id }}" data-delete-url="{{ route('user.destroy', [$user->id], false) }}">
					<td><input type="checkbox"></td>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td class="actions" style="width:100px">
						{{ link_to_route('user.report', 'Relatórios', [$user->id], ['role'=>'reports']) }}
					</td>
					<td class="actions">
						{{ link_to_route('user.edit', 'Modificar', [$user->id], ['role'=>'edit']) }}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	{{ $users->links() }}
@stop

@section('title')
	Usuários
@stop

@section('toolbar')
	<a href="/user/create" class="btn btn-round primary"><i class="fa fa-plus"></i></a>
    {{ Form::open(array('method'=>'DELETE', 'id'=>'delete_users', 'route' => array('user.multiple_destroy'))) }}
		<button type="submit" class="btn btn-round btn-sm btn-bulk danger"><i class="fa fa-trash-o"></i></button>
	{{ Form::close() }}
@stop

@section('script')
	{{ HTML::script('js/app/users.js') }}
@stop