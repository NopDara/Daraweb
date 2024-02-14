<?php include('includes/header.php'); ?>
<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card">
            <div class="card-header">
                <h4>
                    Class Lists
                    <a href="class-create.php" class="btn btn-primary float-end">Add Class</a>
                </h4>
            </div>
            <div class="card-body">

                <?= alertMessage(); ?>
                <div class="table-responsive" >
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Class Name</th>
                            <!-- <th>Subject</th>  -->
                            <!-- <th>Teacher</th>                                                             -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $class = getAll('class');
                        if (mysqli_num_rows($class)) {
                            foreach ($class as $index=>$classItem) {
                                ?>
                                <tr>
                                    <td>
                                    <?= $invID = str_pad($index +1, 2, '0', STR_PAD_LEFT); ?>
                                    </td>
                                    <td>
                                        <?= $classItem['class']; ?>
                                    </td>                                                                 
                                    <!-- <td>
                                        <?= $classItem['subject']; ?>
                                    </td> -->
                                    <!-- <td>
                                        <?= $classItem['name']; ?>
                                    </td> -->
                        
                                    <td>
                                        <a href="class-edit.php?id=<?= $classItem['id']; ?>"class="btn btn-success btn-sm">Edit</a>
                                        <a href="class-delete.php?id=<?= $classItem['id']; ?>"
                                         class="btn btn-danger btn-sm mx-1"
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