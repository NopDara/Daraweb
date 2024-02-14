<?php include('includes/header.php'); ?>

<div class="row">
   <div class="col-6 col-md-3 mb-4">
      <div class="bg-white border rounded-3">
         <a href="users.php" class="card-body p-3 d-block text-decoration-none">
            <div class="row align-items-center">
               <div class="col-6">
                  <div class="numbers">
                     <i class="fas fa-users fa-2x mb-2"></i>
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">User Lists</p>
                     <h5 class="font-weight-bolder mb-0">
                        <?= getCount('users') ?>
                     </h5>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>

   <div class="col-6 col-md-3 mb-4">
      <div class="bg-white border rounded-3">
         <a href="student.php" class="card-body p-3 d-block text-decoration-none">
            <div class="row align-items-center">
               <div class="col-6">
                  <div class="numbers">
                     <i class="fas fa-user-graduate fa-2x mb-2"></i>
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Student Lists</p>
                     <h5 class="font-weight-bolder mb-0">
                        <?= getCount('student') ?>
                     </h5>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>

   <div class="col-6 col-md-3 mb-4">
      <div class="bg-white border rounded-3">
         <a href="teacher.php" class="card-body p-3 d-block text-decoration-none">
            <div class="row align-items-center">
               <div class="col-6">
                  <div class="numbers">
                     <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Teacher Lists</p>
                     <h5 class="font-weight-bolder mb-0">
                        <?= getCount('teacher') ?>
                     </h5>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>

   <div class="col-6 col-md-3 mb-4">
      <div class="bg-white border rounded-3">
         <a href="course.php" class="card-body p-3 d-block text-decoration-none">
            <div class="row align-items-center">
               <div class="col-6">
                  <div class="numbers">
                     <i class="fas fa-book-open fa-2x mb-2"></i>
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Class Lists</p>
                     <h5 class="font-weight-bolder mb-0">
                        <?= getCount('course') ?>
                     </h5>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>

   <div class="col-6 col-md-3 mb-4">
      <div class="bg-white border rounded-3">
         <a href="subject.php" class="card-body p-3 d-block text-decoration-none">
            <div class="row align-items-center">
               <div class="col-6">
                  <div class="numbers">
                     <i class="fas fa-book fa-2x mb-2"></i>
                     <p class="text-sm mb-0 text-capitalize font-weight-bold">Subject Lists</p>
                     <h5 class="font-weight-bolder mb-0">
                        <?= getCount('subject') ?>
                     </h5>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>
