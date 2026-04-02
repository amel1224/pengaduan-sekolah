<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 350px;">
        <div class="card-body">
            <h4 class="text-center mb-3">Login Sistem</h4>

            <form action="proses_login.php" method="post">
                <div class="mb-3">
                    <label>Username / NIS</label>
                    <input type="text" name="user" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
