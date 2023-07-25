<?php require_once("header.php");

// get id 
$id = $_GET['id'];

// Überprüfen, ob die ID eine ganze Zahl ist
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Invalid ID");
}

// SELECT
$sql = "SELECT * FROM answers WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id' => $id));
$result = $stmt->fetchAll();

?>

<div class="container col-sm-12">
    <div class="row">
        <!-- Einzelne Anzeigen des gewählten Beitrags -->
        <div class="col-sm-offset-3 col-sm-6">
            <?php if (count($result) > 0) : ?>
                <h3 class="text-center">Topic</h3>
                <table class="table table-bordered table-striped" style="width:1000px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Topic</th>
                            <th>Content</th>
                            <th>Beweis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['answer']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td><?php echo $row['file_upload']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href='read.php?id=<?php echo $row['question_id']; ?>'>Zurück</a>
            <?php else : ?>
                <p>Keine Daten gefunden</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once("footer.php");?>
