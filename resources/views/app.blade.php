<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    @yield('styles', '')

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- Sometimes we use some inline javascript that uses jQuery, so include it in the header -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo_icon.png') }}" alt="">
                    The Whole Half-Life
                </a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    <li><a href="{{ url('/forum') }}">Forums</a></li>
                    <li><a href="{{ url('/wiki') }}">Wiki</a></li>
                    <li><a href="{{ url('/vault') }}">Vault</a></li>
                    <li><a href="{{ url('/competition') }}">Competitions</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="{{ act('panel', 'index') }}" class="dropdown-toggle navbar-user-info" data-toggle="dropdown">
                                <img src="{{ Auth::user()->getAvatarUrl('small') }}" alt="{{ Auth::user()->name }}"/>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
							<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ act('panel', 'index') }}">Control Panel</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

    <div class="container">
	    @yield('content')
    </div>

    @if (app('config')->get('app.debug'))
        <div class="container" style="padding-top: 20px;">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Query</th>
                        <th>Parameters</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                @foreach (DB::getQueryLog() as $query)
                    <tr>
                        <td>{{ $query['query'] }}</td>
                        <td>{{ print_r($query['bindings'], true) }}</td>
                        <td>{{ $query['time'] }}ms</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

	<!-- Scripts -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.12/jquery.mousewheel.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/all.js') }}"></script>
    <script type="text/javascript">$('body').shoutbox({url:'{{ url("shout/{action}") }}', userUrl:'{{ url("user/view/{id}") }}', active: '{{ Auth::user() != null ? "true" : "false" }}' });</script>
    @yield('scripts', '')
</body>
</html>
