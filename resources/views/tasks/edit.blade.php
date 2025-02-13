<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e3f2fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h1 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-top: 10px;
            text-align: left;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }
        textarea {
            resize: none;
            height: 80px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Task</h1>

        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $task->title }}" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $task->description }}</textarea>

            <button type="submit">Update Task</button>
        </form>

        <a href="/" class="back-link">← Back to Task List</a>
    </div>

</body>
</html>
