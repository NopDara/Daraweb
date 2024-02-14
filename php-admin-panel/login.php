<?php 
$pageTitle = "Login";
include('includes/header.php');

if(isset($_SESSION['auth'])){
    redirect('index.php','You are already logged in');
}

?>

<div class="py-3 text-center">
    <h3 class="mt-5 fw-bold text-secondary " >Educational Management System</h3>
</div>

<div class="py-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?=alertMessage()?>

                    <form action="login-code.php" method="POST" >

                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" ></input>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" ></input>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="loginBtn" class="btn btn-primary w-100 text-white fw-bold  " >Login</button>
                        </div>
                    </form>
                </div>
            </div>

            </div>
         
        </div>
    </div>
</div>


<?php include('includes/footer.php')?>
    


