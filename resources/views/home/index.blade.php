@title('')
@extends('app')

@section('content')
<div class="home-page">

    <div class="row">
        <div class="col-md-8">
            <h1>
                <a href="{{ act('news', 'index') }}"><span class="fa fa-newspaper-o"></span> Latest News</a>
                <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('news', 'index') }}">See all</a>
            </h1>
            <div class="news">
                @foreach ($newses as $news)
                    <div class="slot">
                        <div class="slot-heading">
                            <div class="slot-avatar">
                                @avatar($news->user small show_name=false)
                            </div>
                            <div class="slot-title">
                                <a href="{{ act('news', 'view', $news->id) }}">{{ $news->title }}</a>
                            </div>
                            <div class="slot-subtitle">
                                @avatar($news->user text) &bull;
                                @date($news->created_at) &bull;
                                <a href="{{ act('news', 'view', $news->id) }}">
                                    <span class="fa fa-comment"></span>
                                    {{ $news->stat_comments }} comment{{$news->stat_comments==1?'':'s'}}
                                </a>
                            </div>
                        </div>
                        <div class="slot-main">
                            <div class="bbcode">{!! $news->content_html !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            @if (Auth::check())
                {? $unread_count = Auth::user()->unreadPrivateMessageCount(); ?}
                {? $notify_count = Auth::user()->unreadNotificationCount(); ?}
                <h1>
                    <span class="fa fa-user"></span>
                    Welcome back!
                </h1>
                <div class="list-group">
                    <span class="list-group-item">
                        <span>
                            <span class="fa fa-sign-in"></span>
                            This is your <strong>{{ Auth::user()->stat_logins }}</strong><sup>{{ ordinal(Auth::user()->stat_logins, false) }}</sup> login
                        </span>
                    </span>
                    <a href="{{ act('message', 'index') }}" class="list-group-item list-group-item-action justify-content-between {{ $unread_count > 0 ? 'list-group-item-warning' : '' }}">
                        <span>
                            <span class="fa fa-envelope"></span>
                            {{ $unread_count > 0 ? 'New private messages' : 'Private messages' }}
                        </span>
                        <span class="badge badge-secondary badge-pill">{{  $unread_count }}</span>
                    </a>
                    <a href="{{ act('panel', 'notifications') }}" class="list-group-item list-group-item-action justify-content-between {{ $notify_count > 0 ? 'list-group-item-warning' : '' }}">
                        <span>
                            <span class="fa fa-bell"></span>
                            {{ $notify_count > 0 ? 'New notifications' : 'Notifications' }}
                        </span>
                        <span class="badge badge-secondary badge-pill">{{  $notify_count }}</span>
                    </a>
                    <a href="https://discord.gg/NgN6JBu" class="list-group-item list-group-item-action justify-content-between list-group-item-info">
                        <span>
                            <img src="images/discord.svg" alt="discord" class="discord-icon" style="height: 1.3em; margin: -10px 0 -10px -3px;" />
                            TWHL Discord
                        </span>
                    </a>
                    <a href="{{ act('auth', 'logout') . '?_token=' . csrf_token() }}" class="list-group-item list-group-item-action">
                        <span>
                            <span class="fa fa-sign-out"></span>
                            Logout
                        </span>
                  </a>
                </div>
            @else
                <h1>
                    <span class="fa fa-sign-in"></span>
                    Log in
                </h1>
                @form(auth/login)
                    {? $login_form_checked = true; ?}
                    @text(email placeholder=Email/username) = Email or Username
                    @password(password) = Password
                    <div class="row">
                        <div class="col-8">
                            @checkbox(remember $login_form_checked) = Remember Me
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-sm">Login</button>
                        </div>
                    </div>
                @endform
                <div class="text-center mt-3">
                    <a class="btn btn-outline-primary btn-sm" href="{{ url('/auth/register') }}">Register</a>
                    <a class="btn btn-secondary btn-sm" href="{{ url('/password/email') }}">Forgot password</a>
                </div>
                <div class="text-center mt-3">
                    <a href="https://discord.gg/NgN6JBu" class="btn btn-info btn-sm">
                        <img src="images/discord-white.svg" alt="discord" class="discord-icon" style="height: 1.3em; margin: -10px 0 -10px -3px;" />
                        TWHL Discord
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if (count($competitions) > 0)
        <h1>
            <a href="{{ act('competition', 'index') }}"><span class="fa fa-trophy"></span> Active Competitions</a>
            <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('competition', 'index') }}">See all</a>
        </h1>
        <div class="competition-list">
            <div class="slot">
                <div class="slot-main">
                    @foreach ($competitions->sortByDesc('close_date') as $comp)
                        @if (!$loop->first)
                            <hr />
                        @endif
                        <div class="row">
                            <div class="col-6 col-sm-4 d-flex flex-column align-items-start">
                                <h2 class="font-weight-normal my-0">
                                    <a href="{{ act('competition', 'brief', $comp->id) }}">{{ $comp->name }}</a>
                                </h2>
                                <small>{{ $comp->type->name }} &bull; {{ $comp->judge_type->name }}</small>
                            </div>
                            <div class="col-6 col-sm-4 d-flex align-items-center justify-content-center">
                                <h2 class="font-weight-normal my-0 text-center">{{ $comp->getStatusText() }}</h2>
                            </div>
                            <div class="col-12 justify-content-center col-sm-4 d-flex align-items-center justify-content-sm-end pt-3 pt-sm-0">
                                <div class="d-inline-block">
                                    @if ($comp->isOpen())
                                        <a href="{{ act('competition', 'brief', $comp->id) }}" class="btn btn-success">Enter Now</a>
                                    @elseif ($comp->isVotingOpen())
                                        <a href="{{ act('competition', 'vote', $comp->id) }}" class="btn btn-info">{{ $comp->canVote() ? 'Vote Now' : 'View Entries' }}</a>
                                    @elseif ($comp->isVoting() || $comp->isJudging())
                                        Results coming soon!
                                    @else
                                        {{ $comp->isActive() ? 'Closes' : 'Closed' }} @date($comp->close_date) ({{ $comp->close_date->format('jS F Y') }})
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <h1>
        <a href="{{ act('vault', 'index') }}"><span class="fa fa-database"></span> New in the Vault</a>
        <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('vault', 'index') }}">See all</a>
    </h1>
    <div class="vault-items">
        <div class="horizontal-scroll">
            @foreach ($new_maps as $item)
                <a href="{{ act('vault', 'view', $item->id) }}" class="tile tagged">
                    @if ($item->created_at < $item->updated_at->subWeeks(2))
                        <span class="tag"><span class="fa fa-certificate"></span> Updated</span>
                    @endif
                    <span class="tile-main">
                        <img alt="{{ $item->name }}" src="{{ asset($item->getMediumAsset()) }}">
                    </span>
                    <span class="tile-title">{{ $item->name }}</span>
                    <span class="tile-subtitle">@avatar($item->user inline link=false)</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
            <h1>
                <a href="{{ act('forum', 'index') }}"><span class="fa fa-comment"></span> From the Forums</a>
                <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('forum', 'index') }}">See all</a>
            </h1>
            <div class="forum">
                @foreach ($threads as $thread)
                    <div class="slot">
                        <div class="slot-heading">
                            <div class="slot-avatar">
                                @avatar($thread->last_post->user small show_name=false)
                            </div>
                            <div class="slot-title">
                                <a href="{{ act('thread', 'view', $thread->id) }}?page=last">{{ $thread->title }}</a>
                            </div>
                            <div class="slot-subtitle">
                                @avatar($thread->last_post->user text) &bull;
                                @date($thread->last_post->updated_at) &bull;
                                <a href="{{ act('thread', 'view', $thread->id) }}?page=last">
                                    <span class="fa fa-reply"></span>
                                    {{ $thread->stat_posts-1 }} repl{{$thread->stat_posts-1==1?'y':'ies'}}
                                </a>
                            </div>
                        </div>
                        <div class="slot-main">
                            <div class="bbcode">{!! app('bbcode')->ParseExcerpt($thread->last_post->content_text) !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h1>
                <a href="{{ act('poll', 'index') }}"><span class="fa fa-pie-chart"></span> Poll</a>
                <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('poll', 'index') }}">See all</a>
            </h1>
            <div class="poll">
                @foreach ($polls as $poll)
                    <div class="slot" id="poll-{{ $poll->id }}">
                        <div class="slot-heading">
                            <div class="slot-title">
                                <a href="{{ act('poll', 'view', $poll->id) }}">{{ $poll->title }}</a>
                            </div>
                            <div class="slot-subtitle">
                                Posted @date($poll->created_at) &bull;
                                {{ $poll->isOpen() ? 'Voting now!' : 'Voting closed' }} &bull;
                                <a href="{{ act('poll', 'view', $poll->id) }}">
                                    <span class="fa fa-comment"></span>
                                    {{ $poll->stat_comments }} comment{{$poll->stat_comments==1?'':'s'}}
                                </a>
                            </div>
                        </div>
                        <div class="slot-main">
                            <div class="bbcode">{!! $poll->content_html !!}</div>
                            <div class="card card-body">
                                @if ($poll->isOpen() && Auth::user() && array_search($poll->id, $user_polls) === false)
                                    @include('polls/_form', [ 'poll' => $poll, 'user_votes' => $user_votes ])
                                @else
                                    @include('polls/_results', [ 'poll' => $poll, 'user_votes' => $user_votes ])
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="col-md-4">

            <h1>
                <a href="{{ act('journal', 'index') }}"><span class="fa fa-quote-left"></span> Journals</a>
                <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('journal', 'index') }}">See all</a>
            </h1>
            <div class="journals">
                @foreach ($journals as $journal)
                    <a href="{{ act('journal', 'view', $journal->id) }}" class="slip">
                        <span class="slip-avatar">
                            @avatar($journal->user small link=false show_name=false)
                        </span>
                        <span class="slip-content">
                            <span class="slip-title">
                                {{ $journal->getTitle() }}
                            </span>
                            <span class="slip-subtitle">
                                @avatar($journal->user text link=false) &bull;
                                <span class="hidden-md-only">@date($journal->created_at) &bull;</span>
                                <span class="fa fa-comment"></span> {{ $journal->stat_comments }}
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>

            <h1>
                <a href="{{ act('wiki', 'index') }}"><span class="fa fa-lightbulb-o"></span> Resources</a>
                <a class="btn btn-outline-primary btn-xs hidden-sm-down" href="{{ act('wiki', 'index') }}">View wiki</a>
            </h1>
            <div class="slot wiki-feature">
                <h2>Featured tutorials</h2>
                <ul>
                    @foreach ($wiki_articles['featured_tutorials'] as $wa)
                        <li>
                            <a href="{{ act('wiki', 'page', $wa->slug) }}">{{ $wa->title }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="text-center my-2">
                    <a href="{{ act('wiki', 'page', \App\Models\Wiki\WikiRevision::CreateSlug('category:Tutorials')) }}" class="btn btn-primary btn-xs">
                        <span class="fa fa-chevron-circle-right"></span>
                        See all tutorials
                    </a>
                </div>
                <h2>Recently edited pages</h2>
                <ul>
                    @foreach ($wiki_articles['recent_edits'] as $obj)
                        <li>
                            <a href="{{ act('wiki', 'page', $obj->current_revision->slug) }}" class="d-block">
                                {{ $obj->current_revision->getNiceTitle($obj) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <h1>
                <span class="fa fa-globe"></span> Active Users
            </h1>
            <div class="slot active-users">
                <ul class="list-unstyled">
                    @foreach ($onliners as $o)
                        <li>
                            <em class="float-right">
                                {{ $o->last_access_time->diffForHumans() }}
                            </em>
                            @avatar($o inline)
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
