<h1>Submit a Ticket</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form action="/tickets/store" method="POST">
    @csrf

    <label>Title</label>
    <input type="text" name="title">

    <br><br>

    <label>Category</label>
    <select name="category_id">
        <option value="">-- Select Category --</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label>Priority</label>
    <select name="priority">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select>

    <label>Description</label>
    <textarea name="description"></textarea>

    <br><br>

    <button type="submit" name="submit" value="submit">Submit Ticket</button>
</form>