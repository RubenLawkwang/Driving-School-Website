<?php session_start();
require_once "../db/pdo.php";
// Retrieve data from Query String
$st = '%' . $_GET['m_fname'] . '%';
$pri ='%' . $_GET['m_email']. '%';
$loc = $_GET['loc_id'];

//Use prepared statement to help prevent SQL Injection
$stmt = $pdo->prepare("SELECT * FROM monitors WHERE m_fname  LIKE 
:st and m_address LIKE :pric AND m_status = 1");
$stmt->execute(
array(
':st' => $st,
':pric' => $pri
)
);
$display_str = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $display_str .=  '<div class="col-md-6">
    <div class="card" style="width: 18rem;">';
    $display_str .=  '<img class="img-fluid" alt="" src="../upload/' . htmlentities($row['m_profilepicture']) . '">' . "\n";
    $display_str .=  '<div class="card-body">
    <h5 class="card-title">Monitor name:</h5>
    <h4>' . htmlentities($row['m_fname']) . '</h4>
    <h5 class="card-title">Monitor email:</h5>
    <h4>' . htmlentities($row['m_email']) . '</h4>
    <h5 class="card-title">Years of experience:</h5>
    <h4>' . htmlentities($row['m_experience']) . '</h4>
    <a href="#" class="btn btn-primary">View profile</a>
    
  </div>
</div>
</div>';

echo '</div>';

}
echo $display_str;