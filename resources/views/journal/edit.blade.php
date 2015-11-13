@extends('app')

@section('content')
    <hc>
        <h1>Edit Journal Post #{{ $journal->id }} by @include('user._avatar', [ 'class' => 'inline', 'user' => $journal->user ])</h1>
        <ol class="breadcrumb">
            <li><a href="{{ act('journal', 'index') }}">Journals</a></li>
            <li><a href="{{ act('journal', 'view', $journal->id) }}">Journal #{{ $journal->id }}</a></li>
            <li class="active">Edit Journal</li>
        </ol>
    </hc>
    @form(journal/edit)
        @hidden(id $journal)
        @textarea(content_text:text $journal) = Journal Content
        <div class="form-group">
            <h4>
                Journal preview
                <button id="update-preview" type="button" class="btn btn-info btn-xs">Update Preview</button>
            </h4>
            <div id="preview-panel" class="well bbcode"></div>
        </div>
        @submit = Edit Journal
    @endform
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#update-preview').click(function() {
            $('#preview-panel').html('Loading...');
            $.post('{{ url("api/format") }}?field=text', $('form').serializeArray(), function(data) {
                $('#preview-panel').html(data);
            });
        });
    </script>
@endsection