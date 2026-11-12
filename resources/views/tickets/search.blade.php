<form action="{{ route('ticket.index') }}" method="GET" class="ticket-search">

    {{-- Preserve the current status filter --}}
    @if(request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif

    <select name="field">
        <option value="ticket_number">Ticket Number</option>
        <option value="title">Title</option>
        <option value="description">Description</option>
        <option value="category">Category</option>
        <option value="priority">Priority</option>
        <option value="status">Status</option>
        <option value="creator">Created By</option>
        <option value="assignee">Assigned To</option>
        <option value="created_at">Created At</option>
        <option value="assigned_at">Assigned At</option>
        <option value="resolved_at">Resolved At</option>
        <option value="resolution_details">Resolution Details</option>
        <option value="closed_at">Closed At</option>
    </select>

    <select name="operator">
        <option value="contains">Contains</option>
        <option value="equals">Equals</option>
        <option value="not_equals">Not Equal</option>
        <option value="greater_than">Greater Than</option>
        <option value="less_than">Less Than</option>
        <option value="before">Before</option>
        <option value="after">After</option>
    </select>

    <input type="text" name="search" placeholder="Enter search value..." value="{{ request('search') }}">

    <button type="submit">Search</button>

    <a href="{{ route('ticket.index') }}">Reset</a>

</form>