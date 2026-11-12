@extends('layouts.app')
@section('content')
    <style>
        .ticket-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .ticket-container h1 {
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .ticket-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        .ticket-table th,
        .ticket-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .ticket-table th {
            background: #1e293b;
            color: white;
            font-weight: 600;
        }

        .ticket-table td {
            font-size: 14px;
            color: #475569;
        }

        .ticket-table tr:hover {
            background: #f8fafc;
        }

        .ticket-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    <div class="ticket-container">
        <h1>All Tickets</h1>

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
            </table>

            <div class="pagination-laravel">
                <div class="d-flex justify-content-end mt-4">
                    {{ $ticket->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection