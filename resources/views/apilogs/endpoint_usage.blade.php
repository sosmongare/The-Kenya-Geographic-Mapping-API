<!-- resources/views/apilogs/endpointUsage.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="my-4">Endpoint Usage</h1>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Endpoint</th>
                <th>Requests</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($endpointUsage as $endpoint)
                <tr>
                    <td>{{ $endpoint->endpoint }}</td>
                    <td>{{ $endpoint->hits }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
