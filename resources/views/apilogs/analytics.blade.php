<!-- resources/views/apilogs/analytics.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="my-4">API Analytics</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Requests</h5>
                    <p class="card-text">{{ $totalRequests }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Successful Requests</h5>
                    <p class="card-text">{{ $successfulRequests }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Failed Requests</h5>
                    <p class="card-text">{{ $failedRequests }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-4">
                <canvas id="dailyRequestsChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-4">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dailyRequestsCtx = document.getElementById('dailyRequestsChart').getContext('2d');
            var dailyRequestsChart = new Chart(dailyRequestsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($dailyRequests->pluck('date')->toArray()) !!},
                    datasets: [{
                        label: 'Daily Requests',
                        data: {!! json_encode($dailyRequests->pluck('count')->toArray()) !!},
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            },
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        yAxes: {
                            title: {
                                display: true,
                                text: 'Number of Requests'
                            },
                            beginAtZero: true,
                        }
                    }
                }
            });

            var statusCtx = document.getElementById('statusChart').getContext('2d');
            var statusChart = new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statuses->pluck('status')->toArray()) !!},
                    datasets: [{
                        label: 'Status Codes',
                        data: {!! json_encode($statuses->pluck('count')->toArray()) !!},
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Status Code'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Requests'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
