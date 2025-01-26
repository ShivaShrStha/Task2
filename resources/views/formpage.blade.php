<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - KoBoToolbox</title>
    <!-- Add Bootstrap for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .hero {
            background-color: #007bff;
            color: #fff;
            padding: 40px 20px;
            text-align: center;
        }
        .hero h1 {
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons a {
            margin: 0 10px;
        }
        .feature {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .feature i {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="hero">
        <h1>Welcome to KoBoToolbox</h1>
        <p>A powerful tool for mobile data collection, form design, and analysis.</p>
        <div class="buttons">
        
            <a href="#" class="btn btn-outline-light btn-lg">Learn More</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mt-5">       
    
            <div class="col-md-4">
                <div class="feature">
                    <i class="fas fa-database"></i>
                    <h4>Build form Scratch</h4>
                    <p>Build form from scratch using advanced tools like drag-and-drop and question libraries.</p>
                    <a href="{{ url('/projectspage') }}" class="btn btn-primary mt-2">Build from Scratch</a>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
