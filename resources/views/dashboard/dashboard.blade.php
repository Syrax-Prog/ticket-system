@extends('layouts.app')

@section('content')

    @php
        $recentTickets = [
            [
                'number' => 'HD-20261111-A1B2C3D4',
                'title' => 'Monitor not displaying',
                'category' => 'Hardware',
                'priority' => 'High',
                'status' => 'Open',
                'date' => '11 Nov 2026'
            ],
            [
                'number' => 'HD-20261111-E5F6G7H8',
                'title' => 'Unable to access company email',
                'category' => 'Account Access',
                'priority' => 'Urgent',
                'status' => 'Assigned',
                'date' => '11 Nov 2026'
            ],
            [
                'number' => 'HD-20261110-I9J0K1L2',
                'title' => 'Printer connection problem',
                'category' => 'Hardware',
                'priority' => 'Medium',
                'status' => 'In Progress',
                'date' => '10 Nov 2026'
            ],
            [
                'number' => 'HD-20261110-M3N4O5P6',
                'title' => 'Software installation request',
                'category' => 'Software',
                'priority' => 'Low',
                'status' => 'Resolved',
                'date' => '10 Nov 2026'
            ],
            [
                'number' => 'HD-20261109-Q7R8S9T0',
                'title' => 'Network connection unstable',
                'category' => 'Network',
                'priority' => 'High',
                'status' => 'Closed',
                'date' => '09 Nov 2026'
            ],
        ];
    @endphp

    <div class="container-fluid py-4">

        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Dashboard</h4>
                <p class="text-muted small mb-0">
                    Overview of helpdesk activities and ticket statistics.
                </p>
            </div>

            <div class="text-muted small">
                <i class="bi bi-calendar3 me-1"></i>
                {{ $data['today_date'] }}
            </div>
        </div>


        <!-- Total Tickets -->
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-semibold">Total Tickets</span>
                            <i class="bi bi-ticket-perforated fs-4 text-primary"></i>
                        </div>
                        <h3 class="fw-bold mt-3 mb-1">{{ $data['total_ticket'] }}</h3>
                        <small class="text-muted">All tickets submitted</small>
                    </div>
                </div>
            </div>

            @foreach ($data['status'] as $status)
                <div class="col-12 col-sm-6 col-xl">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small fw-semibold">
                                    {{ $status['name'] }}
                                </span>

                                <i class="bi {{ $status['icon'] }} fs-4 text-{{ $status['color'] }}"></i>
                            </div>

                            <h3 class="fw-bold mt-3 mb-1">
                                {{ $status['count'] }}
                            </h3>

                            <small class="text-muted">Tickets</small>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


        <!-- Statistics -->
        <div class="row g-3 mb-4">

            <!-- Priority Statistics -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4">Tickets by Priority</h6>

                        @foreach ($data['priority'] as $priority)
                            <div class="mb-4">

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="small fw-semibold">
                                        {{ $priority['name'] }}
                                    </span>

                                    <span class="small text-muted">
                                        {{ $priority['count'] }} tickets
                                    </span>
                                </div>

                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-{{ $priority['color'] }}"
                                        style="width: {{ ($priority['count'] / $data['total_ticket']) * 100 }}%">
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


            <!-- Resolution Statistics -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4">Resolution Statistics</h6>

                        <div class="row g-3">

                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Resolved This Month</small>
                                    <h3 class="fw-bold text-success mt-2 mb-0">
                                        {{ $data['resolution']['resolved'] }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Opened This Month</small>
                                    <h3 class="fw-bold mt-2 mb-0">
                                        {{ $data['resolution']['open'] }}
                                    </h3>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Average Resolution Time</small>
                                    <h4 class="fw-bold mt-2 mb-0">
                                        {{ $data['resolution']['average_time'] }}
                                    </h4>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="bg-light rounded p-3">
                                    <small class="text-muted">Resolution Rate</small>
                                    <h4 class="fw-bold text-primary mt-2 mb-0">
                                        {{ $data['resolution']['rate'] }}
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Recently Submitted Tickets -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-1">Recently Submitted Tickets</h6>
                        <small class="text-muted">Latest ticket submissions</small>
                    </div>

                    <a href="{{ url('/tickets') }}" class="btn btn-sm btn-outline-primary">
                        View All
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Ticket Number</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th class="pe-4">Submitted</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($recentTickets as $ticket)

                                @php
                                    $priorityColors = [
                                        'Low' => 'success',
                                        'Medium' => 'info',
                                        'High' => 'warning',
                                        'Urgent' => 'danger'
                                    ];

                                    $statusColors = [
                                        'Open' => 'secondary',
                                        'Assigned' => 'info',
                                        'In Progress' => 'primary',
                                        'Resolved' => 'success',
                                        'Closed' => 'dark'
                                    ];
                                @endphp

                                <tr>
                                    <td class="px-4 fw-semibold text-primary">
                                        {{ $ticket['number'] }}
                                    </td>

                                    <td>{{ $ticket['title'] }}</td>

                                    <td>{{ $ticket['category'] }}</td>

                                    <td>
                                        <span
                                            class="badge bg-{{ $priorityColors[$ticket['priority']] }}-subtle text-{{ $priorityColors[$ticket['priority']] }}">
                                            {{ $ticket['priority'] }}
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="badge bg-{{ $statusColors[$ticket['status']] }}-subtle text-{{ $statusColors[$ticket['status']] }}">
                                            {{ $ticket['status'] }}
                                        </span>
                                    </td>

                                    <td class="pe-4 text-muted small">
                                        {{ $ticket['date'] }}
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection