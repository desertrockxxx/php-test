<?php
require_once("header.php");

// get id 
$id = $_GET['id'];

// Überprüfen, ob die ID eine ganze Zahl ist
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Invalid ID");
}

$object = new Mindset;
$mindsets = array(
    "Advantage", "Disadvantage", "Argument", "Counter-argument", "Thesis", "Antithesis"
);

?>

<div class="container col-sm-12">
    <div class="row">
        <!-- Anzeige der gewählten Frage -->
        <div class="col-sm-offset-3 col-sm-6">
            <h3 class="text-center">Topic</h3>
            <table class="table table-bordered table-striped" style="width:1000px">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Topic</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php $object->getQuestion($id); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php foreach ($mindsets as $mindset) : ?>
        <div class="row">
            <div class="col-sm-offset-3 col-sm-3">
                <!-- Mindset Section -->
                <h3 class="text-center"><?php echo $mindset; ?></h3>
                <table class="table table-bordered table-striped" style="width:500px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><?php echo $mindset; ?></th>
                            <th>Beweise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $object->getID($id, $mindset); ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success" onclick="location.href='create.php?id=<?php echo $id; ?>&mindset=<?php echo $mindset; ?>';">Create New <?php echo $mindset; ?></button>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <!--INNER JOIN Alle Antworten zu der Frage-->
            <h3>All Answers to <?php echo $id; ?></h3>
            <table class="table table-bordered table-striped" style="width:1000px">
                <thead>
                    <tr>
                        <th>Antworten</th>
                        <th>Beweise</th>
                        <th>Mindset</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $object->getAllAnswers($id); ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-success" onclick="location.href='create.php?id=<?php echo $id; ?>';">Create New Answer</button>
            <button type="button" class="btn btn-primary" onclick="location.href='/';">Create New Question</button>
            <button type="button" class="btn btn-danger" onclick="location.href='/';">Go Back</button>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>
