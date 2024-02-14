<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="index.php">
            <h4>Admin</h4>
        </a>
    </div>

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  active" href="index.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home text-white text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Site Management</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="class.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-globe text-dark text-lg"></i>

                    </div>
                    <span class="nav-link-text ms-1">Class Name</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="course.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-graduation-cap text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Class</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="subject.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-book text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Subject</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="student.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-plus text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Student</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="teacher.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chalkboard-teacher text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teacher</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  " href="users.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Admin / Users</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-dark text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Report</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="reportDropdown">
                    <a class="dropdown-item" href="user-report.php">User Report</a>
                    <a class="dropdown-item" href="student-report.php">Student Report</a>
                    <a class="dropdown-item" href="teacher-report.php">Teacher Report</a>
                    <a class="dropdown-item" href="class-report.php">Class Report</a>
                </div>
            </li> -->


        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
    </div>
    <a class="btn bg-gradient-primary mt-3 w-100" onclick="return confirm('Are you sure you want to logout?')"
        href="../logout.php">Logout</a>
</aside>