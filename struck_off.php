<?php
include 'confiq.php'; // Include database configuration
include 'header.php';
include 'sidebar.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch all struck-off students
$struckOffQuery = "SELECT 
                      sos.id,
                      s.student_id,
                      s.family_code,
                      s.student_name,
                      s.class_id,
                      s.section_id,
                      sos.struck_off_date
                   FROM struck_off_students sos
                   JOIN students s ON sos.student_id = s.student_id
                   ORDER BY sos.struck_off_date DESC";

$struckOffResult = $conn->query($struckOffQuery);
?>

<div class="content-body">
	<div class="row page-titles mx-0">
		<div class="col p-md-0">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
				<li class="breadcrumb-item active"><a href="javascript:void(0)">Struck-Off Students</a></li>
			</ol>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Struck-Off Students</h4>
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Student Name</th>
										<th>Family Code</th>
										<th>Class</th>
										<th>Section</th>
										<th>Struck Off Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($struckOffResult->num_rows > 0) {
										$sno = 1;
										while ($studentRow = $struckOffResult->fetch_assoc()) {
											echo "<tr>
                                                    <td>" . $sno++ . "</td>
                                                    <td>" . htmlspecialchars($studentRow['family_code']) . "</td>
                                                    <td>" . htmlspecialchars($studentRow['student_name']) . "</td>
                                                    <td>" . htmlspecialchars($studentRow['class_id']) . "</td>
                                                    <td>" . htmlspecialchars($studentRow['section_id']) . "</td>
                                                    <td>" . htmlspecialchars($studentRow['struck_off_date']) . "</td>
                                                    <td>
                                                        <form method='POST' action='reinstate_student.php' style='display:inline;'>
                                                            <input type='hidden' name='struck_off_id' value='" . $studentRow['id'] . "'>
                                                            <button type='submit' class='btn btn-success'>Reinstate</button>
                                                        </form>
                                                    </td>
                                                  </tr>";
										}
									} else {
										echo "<tr><td colspan='6'>No struck-off students found</td></tr>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
