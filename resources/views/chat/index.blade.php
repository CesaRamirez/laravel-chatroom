@extends('layouts.app')

@section('content')
    <div class="uk-container">
        {{-- <flash></flash> --}}
        <div uk-grid>
            <div class="uk-width-2-3@m uk-margin-top">
                <chat></chat>
            </div>
            <div class="uk-width-1-3@m uk-margin-top">
                <chat-users></chat-users>
            </div>
        </div>
    </div>
@endsection
