<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Subject Lists
                    <a href="subject-create.php" class="btn btn-primary float-end">Add Subject</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <div class="table-responsive">
                <table id="myTable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Subject Name</th>                                                                                                                                                                                                 
                            <!-- <th>Teacher</th>                                                     -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subject = getAll('subject');
                                                                                                                                        

                        if (mysqli_num_rows($subject)) {
        
                            foreach ($subject as $index=> $userItem) {
                            
                                ?>
                                <tr>
                                    <td>
                                    <?= $invID = str_pad($index +1, 2, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td>
                                        <?= $userItem['subject']; ?>
                                    </td>                             
                                                            
                                    <!-- <td>
                                        <?= $userItem['name']; ?>
                                    </td>                               -->
                                    <td>
                                        <a href="subject-edit.php?id=<?= $userItem['id']; ?>"class="btn btn-success btn-sm">Edit</a>
                                        <a href="subject-delete.php?id=<?= $userItem['id']; ?>"
                                         class="btn btn-danger btn-sm mx-1 "
                                         onclick="return confirm('Are you sure you want to delete data?')"
                                         >
                                         Delete
                                        </a>

                                    </td>
                                </tr>
                                <?php
                            }

                        } else {
                            ?>
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            <?php
                        }
                        ?>


                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>