<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
    @vite('resources/css/app.css')
    <title>User Management System</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-prod-primary" style="height:50px"></nav>

    
    <div class="card-login d-flex justify-content-center position-absolute align-items-center">
        <div class="card-blue bg-prod-primary text-light text-center h-100 px-5 d-flex flex-column justify-content-center">
            <h3>Welcome to User Management!</h3>
            <p class=" fs-6 fw-light">Login to streamline your workflow, manage users effortlessly.</p>
        </div>
        <div class="card-form h-100 w-50 d-flex flex-column justify-content-center">
            
            @yield('content')
            
        </div>
    </div>
    





    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS (loaded after jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Table JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.21.1/bootstrap-table.min.js"></script>
    
    @vite('resources/js/app.js')
</body>
</html>