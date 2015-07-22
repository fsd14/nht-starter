@extends('admin/layouts/master')

@section('main-content')
	<h3>{{ trans('admin/general.create_info') . ' ' . trans('admin/general.modules.roles') }}</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action="{{ url('/admin/roles') }}">
			<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
				<label for="display_name" class="col-sm-3 control-label">{{ trans('form.role_name') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="display_name" class="form-control" id="display_name" name="display_name" placeholder="{{ trans('form.role_name') }}" value="{{ Request::old('display_name') }}" />
					<i class="help-inline text-muted">Ex: Nhân viên</i>
					{!! $errors->first('display_name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
				<label for="name" class="col-sm-3 control-label">{{ trans('form.role_key') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('form.role_key') }}" value="{{ Request::old('name') }}" />
					<i class="help-inline text-muted">Ex: staff</i>
					{!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
				<label for="description" class="col-sm-3 control-label">{{ trans('form.description') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="description" name="description" placeholder="{{ trans('form.description') }}">{{ Request::old('description') }}</textarea>
					{!! $errors->first('description', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
					<a href="{{ url('/admin/roles') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop