@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				{{ trans('admin/general.modules.roles') }}
				<a href="{{ route('permission.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="sorting" aria-sort="descending">{{ trans('form.perm_name') }}</th>
								<th class="sorting" aria-sort="descending">{{ trans('form.perm_key') }}</th>
								<th colspan="2" align="center">{{ trans('table.actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($permissions as $key => $permission)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $permission->display_name }}</td>
									<td>{{ $permission->name }}</td>
									<td><a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td><a href="{{ route('permission.destroy', $permission->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $permissions, 'appended' => []])
				</div>
			</div>
		</div>
	</section>
@stop
