<!doctype html>
<html lang="en">

<head>


 
    <title>Shop đồ câu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/style_login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup" style="margin-top: -32px;">
            <label for="chk" class="log-in" aria-hidden="true">Sign up</label>
            <form action="?controller=usercontroller&action=register" method="POST">
                <input type="text"     name="user_name" placeholder="Full Name" required="">
                <input type="text"    name="phone" placeholder="phone number" required="">
                <input type="email"    name="email" placeholder="Email" required="">
                <input type="text"     name="use_account" placeholder="User Account" required="">
                <input type="text" name="pass" placeholder="Password" required="">
                <button class="button-r" type="submit">Sign up</button>
            </form>
        </div>
        <div class="login" style="margin-top: 92px;">
            <label for="chk" aria-hidden="true">Login</label>
            <form action="?controller=logincontroller&action=login"  method="POST">
                <input type="text" name="email" placeholder="tên tài khoản hoặc email" required="">
                <input id="showpass" type="password" name="pass" placeholder="Password" required="">
                <input id="checkbox" class="float-end" type="checkbox">
                <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
            </form>
        </div>
    </div>
</body>
<script>
    $('#checkbox').on('change',function(){
        if($('#checkbox').is(':checked')){
            $('#showpass').removeAttr('type');
            $('#showpass').attr('type', 'text');
        }else{
            $('#showpass').attr('type', 'password');
        }     
    })
</script>
<script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>   


</html>