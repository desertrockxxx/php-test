<?php
require_once("header.php");

// Get id 
$id = $_GET['id'];
$question = $_POST['question'];

$object = new Mindset;

?>

<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
        <form id="send" method="POST" action="update.php?id=<?php echo $id;?>">
            <?php $questionValue = $object->getQuestion($id); ?>
            <input type='text' name='question' value='<?php echo htmlspecialchars($questionValue); ?>' placeholder='Enter New Question' />
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" onclick="location.href='/';">Go Back</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($question) && !empty($question)){
                $object->updateQuestion($id, $question);
                echo "Question title for " . $id . " updated";
            }
        }
        ?>
        </div>
    </div>
</div>

<?php require_once("footer.php");?>
