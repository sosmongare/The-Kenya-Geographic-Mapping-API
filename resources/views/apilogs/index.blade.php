<!-- resources/views/apilogs/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="my-4">API Logs</h1>
    <form method="GET" action="{{ route('apilogs.index') }}" class="form-inline mb-4">
        <input type="text" name="method" class="form-control mr-2" placeholder="Method" value="{{ request('method') }}">
        <input type="text" name="url" class="form-control mr-2" placeholder="URL" value="{{ request('url') }}">
        <input type="text" name="status" class="form-control mr-2" placeholder="Status" value="{{ request('status') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Method</th>
                <th>URL</th>
                <th>Endpoint</th>
                <th>Status</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Response Time</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->method }}</td>
                    <td>{{ $log->url }}</td>
                    <td>{{ $log->endpoint }}</td>
                    <td>{{ $log->status }}</td>
                    <td>{{ $log->ip }}</td>
                    <td>{{ $log->user_agent }}</td>
                    <td>{{ $log->response_time }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td><a href="{{ route('apilogs.show', $log->id) }}" class="btn btn-info btn-sm">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
@endsection
