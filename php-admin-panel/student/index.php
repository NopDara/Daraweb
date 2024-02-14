<?php include('includes/header.php'); ?>
<div class="row">
<div class="col-md-3 mb-4 bg-white border rounded-3 ">
      <a href="#">
         <div class="card-body p-3">
            <div class="row">
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
         </div>
      </a>
   </div>



</div>




<?php include('includes/footer.php'); ?>