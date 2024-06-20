<!-- resources/views/apilogs/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="my-4">API Log Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $log->id }}</li>
        <li class="list-group-item"><strong>Method:</strong> {{ $log->method }}</li>
        <li class="list-group-item"><strong>URL:</strong> {{ $log->url }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $log->status }}</li>
        <li class="list-group-item"><strong>IP:</strong> {{ $log->ip }}</li>
        <li class="list-group-item"><strong>User Agent:</strong> {{ $log->user_agent }}</li>
        <li class="list-group-item"><strong>Response Time:</strong> {{ $log->response_time }}</li>
        <li class="list-group-item"><strong>Created At:</strong> {{ $log->created_at }}</li>
    </ul>
    <a href="{{ route('apilogs.index') }}" class="btn btn-secondary mt-3">Back to Logs</a>
@endsection
