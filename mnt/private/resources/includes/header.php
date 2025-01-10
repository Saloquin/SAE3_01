<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/tailwind.config.js"></script>
</head>
<body>
    <div class="header">
        <div id="logo">
            <a href="#">
                <figure>
                    <img src="/assets/logo.png" alt="Home" class=" w-16 md:w-32 lg:w-48 ">
                </figure>
            </a>
        </div>
        <div  id="title">
            <h1 class="triomphe"> Journal de plongée </h1>
        </div>
        <div id="profile">
            <a href="../profile">
                <figure>
                    <img src="/assets/profile.png" alt="Profile">
                    <p id="account_name">  </p>
                </figure>
            </a>
        </div>
    </div>
    <?php
        if (session()->has('superadmin')) {
            include resource_path('includes/navbar/navbar_admin.php');
        }
        if (session()->has('director')) {
            include resource_path('includes/navbar/navbar_director.php');
        } 
        if (session()->has('manager')) {
            include resource_path('includes/navbar/navbar_manager.php');
        } 
        if (session()->has('teacher')) {
            include resource_path('includes/navbar/navbar_teacher.php');
        } 
        if (session()->has('student')) {
            include resource_path('includes/navbar/navbar_student.php');
        }
    ?>
</body>
</html>
