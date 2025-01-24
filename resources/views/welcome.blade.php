<!-- resources/views/form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoBoToolbox</title>
    <!-- Add Bootstrap for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }
        .header img {
            height: 30px;
            margin-right: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            flex: 1;
        }
        .new-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .new-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <img src="https://via.placeholder.com/30" alt="" />
        <h1>KoBoToolbox</h1>
        <button class="new-button" onclick="window.location.href='{{ url('/formpage') }}'">NEW</button>
    </div>
</body>
</html>
