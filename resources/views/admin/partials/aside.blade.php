<!--sidebar start-->
<aside>
	<div id="sidebar" class="nav-collapse">
		<!-- sidebar menu start-->
		<div class="leftside-navigation">
			<ul class="sidebar-menu" id="nav-accordion">
				<li>
					<a class="{{ Request::is("admin/dashboard") ? 'active' : '' }}" href="{{ route('dashboard') }}">
						<i class="fa fa-dashboard"></i>
						<span>{{ trans('admin/general.modules.dashboard') }}</span>
					</a>
				</li>
				<li class="sub-menu">
					<a href="javascript:;">
						<i class="fa fa-cog"></i>
						<span>{{ trans('admin/general.modules.setting') }}</span>
					</a>
					<ul class="sub">
						<li><a href="">{{ trans('admin/general.modules.module') }}</a></li>
						<li><a href="horizontal_menu.html">{{ trans('admin/general.modules.site') }}</a></li>
						<li><a href="language_switch.html">{{ trans('admin/general.modules.metadata') }}</a></li>
						<li><a href="language_switch.html">{{ trans('admin/general.modules.social') }}</a></li>
					</ul>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="{{ (Request::is("admin/users*") or Request::is("admin/roles*") or Request::is("admin/permissions*")) ? 'active' : '' }}">
						<i class="fa fa-user"></i>
						<span>{{ trans('admin/general.modules.user') }}</span>
					</a>
					<ul class="sub">
						<li class="{{ Request::is("admin/users*") ? 'active' : '' }}"><a href="{{ route('user.index') }}">{{ trans('admin/general.modules.users') }}</a></li>
						<li class="{{ Request::is("admin/roles*") ? 'active' : '' }}"><a href="{{ route('role.index') }}">{{ trans('admin/general.modules.roles') }}</a></li>
						<li class="{{ Request::is("admin/permissions*") ? 'active' : '' }}"><a href="language_switch.html">{{ trans('admin/general.modules.permissions') }}</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- sidebar menu end-->
	</div>
</aside>
<!--sidebar end-->
