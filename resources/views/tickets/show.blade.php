@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/ticket.css') }}">

    @include('tickets.search')

    <div class="ticket-container">
        <h1>{{ in_array($status, array('open', 'closed', 'assigned')) ? ucfirst($status) : 'All' }} Tickets</h1>

        <div class="table-wrapper">
            <table class="ticket-table">
                <tr>
                    <th>Ticket Number</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Assigned To</th>
                    <th>Created At</th>
                    <th>Assigned At</th>
                    <th>Resolved At</th>
                    <th>Resolution Details</th>
                    <th>Closed At</th>
                </tr>

                @if (!$ticket->isEmpty())
                    @foreach ($ticket as $row)
                        <tr>
                            <td>{{ $row->ticket_number }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->category?->name ?? '-' }}</td>
                            <td>{{ $row->priority }}</td>
                            <td>
                                <span class="ticket-status">
                                    {{ $row->status }}
                                </span>
                            </td>
                            <td>{{ $row->creator?->name ?? '-' }}</td>
                            <td>{{ $row->assignee?->name ?? '-' }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->assigned_at ?? '-' }}</td>
                            <td>{{ $row->resolved_at ?? '-' }}</td>
                            <td>{{ $row->resolution_details ?? '-' }}</td>
                            <td>{{ $row->closed_at ?? '-' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="13" class="text-center py-4 text-muted">
                            No tickets found.
                        </td>
                    </tr>
                @endif
            </table>

            <div class="pagination-laravel">
                <div class="d-flex justify-content-end mt-4">
                    {{ $ticket->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection