<?php
include 'Employee.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Employee</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-4">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select name="civil_status" id="civil_status" class="form-select">
                            <option disabled selected>Select Civil Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select name="position" id="position" class="form-select" required>
                            <option disabled selected>Select Position</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="employment_status" class="form-label">Employment Status</label>
                        <select name="employment_status" id="employment_status" class="form-select" required>
                            <option disabled selected>Select Employment Status</option>
                            <option value="contractual">Contractual</option>
                            <option value="probationary">Probationary</option>
                            <option value="regular">Regular</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="regular_hours_rendered" class="form-label">Regular Hours Rendered</label>
                        <input type="number" name="regular_hours_rendered" id="regular_hours_rendered" class="form-control" min="0"required>
                    </div>
                    <div class="mb-3">
                        <label for="computation" class="form-label">Computation</label>
                        <select name="computation" id="computation" class="form-select" required>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            
                        </select>
                    </div>
                    <input type="submit" value="Submit" name="submit" class="btn btn-success w-100">
                   
                </form>
            </div>
            <div class="col-8">
                <?php
                    if( isset($_POST["submit"]))
                    {
                        //INPUT
                        $name = $_POST["name"];
                        $civil_status = $_POST["civil_status"];
                        $position = $_POST["position"];
                        $employment_status = $_POST["employment_status"];
                        $regular_hours_rendered = $_POST["regular_hours_rendered"];
                        // $ot_hours = $_POST["ot_hours"];
                        $computation = $_POST['computation'];
                        
                        $employee = new Employee($name, $civil_status,$position,$employment_status, $regular_hours_rendered,$computation);
                ?>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="bg-dark text-white w-25">Full Name</th>
                            <td><?php echo ucfirst($employee->getName()); ?></td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Civil Status</th>
                            <td><?php echo ucfirst($employee->getCivilStatus());?></td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Position</th>
                            <td><?php echo ucfirst($employee->getPosition());?></td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Employment Status</th>
                            <td>
                                <?php echo ucfirst($employee->getEmploymentStatus());?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Regular Hours</th>
                            <td><?= $employee->getRegularHours()?></td>
                        </tr>
              
                        <tr>
                            <th class="bg-dark text-white">Overtime Hours</th>
                            <td>
                                <?php echo $employee->getOTHours();?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Computation</th>
                            <td><?php echo ucfirst($employee->computation())?></td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Days Rendered</th>
                            <td>
                                <?= $employee->daysRendered();?> days <?php echo $employee->getRegularHours() % 8 ?> hours
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Gross Income</th>
                            <td>
                                <?php echo number_format($employee->computeGrossIncome(),2);?>
                                <br>
                                <small class="text-muted fst-italic">Regular Pay: (<?php echo ($employee->getRegularHours() - $employee->getOTHours())."hrs";?> x <?php echo $employee->getRegularRate();?>) + OT Pay: (<?php echo $employee->getOTHours()."hrs";?> x <?php echo $employee->getOTRate();?>)</small>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-dark text-white">Net Income</th>
                            <td>
                                <?php echo number_format($employee->computeNetIncome(),2);?>
                                <br>
                                <small class="text-muted fst-italic">
                                    Gross Income: (<?php echo number_format($employee->computeGrossIncome(),2);?>) - ( Tax: <?php echo number_format($employee->computeTax(),2);?> + Health Care: <?php echo number_format($employee->getHealthCare(),2);?>)
                                </small>
                            </td>
                        </tr>
                    </table>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>