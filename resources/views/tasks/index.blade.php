<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input, textarea, button, select {
            margin: 5px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .filter-section {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Task Management</h1>

    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        <button type="submit">Add Task</button>
    </form>

    <div class="filter-section">
        <label for="filter">Filter Tasks:</label>
        <select id="filter" onchange="filterTasks()">
            <option value="all">All Tasks</option>
            <option value="completed">Completed Tasks</option>
            <option value="not_completed">Non-Completed Tasks</option>
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr class="task-row" data-status="{{ $task->completed ? 'completed' : 'not_completed' }}">
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                            @csrf @method('PATCH')
                            <input type="checkbox" {{ $task->completed ? 'checked' : '' }} onchange="this.form.submit()">
                        </form>
                    </td>
                    <td class="actions">
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="/tasks/{{ $task->id }}/edit">
                            <button type="button">Update</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function filterTasks() {
            let filterValue = document.getElementById("filter").value;
            document.querySelectorAll(".task-row").forEach(row => {
                if (filterValue === "all" || row.dataset.status === filterValue) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>