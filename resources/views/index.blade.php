@extends('layouts.app')
@section('custom_css')
<!-- Styles -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="section">
    <div class="container">
        @if(count($links) > 0)
        <h1 class="title">
            Check out my awesome links
        </h1>
        <p class="subtitle">
            You can include a little description here.
        </p>
        @else
        <p class="subtitle">
            Add new links
            <a href="{{route('link.view')}}">
                Add Link
            </a>
        </p>
        @endif
        <section class="links">
            <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach ($links as $link)
                    <li class="list-group-item">
                        <h5><a href="{{ $link->url }}" target="_blank" title="Visit Link: {{ $link->url }}">{{ $link->description }}</a>  <span> {{$link->title}}</span></h5>
                        {{$link->url}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</section>

@endsection