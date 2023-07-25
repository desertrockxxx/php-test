<?php
require_once("header.php");

// Get ID
$id = isset($_GET['id']) ? $_GET['id'] : "";

// Get mindset
$mindset = isset($_GET['mindset']) ? $_GET['mindset'] : "";

$object = new Mindset;
$advantage = "Advantage";
$disadvantage = "Disadvantage";
$argument = "Argument";
$counterargument = "Counter-argument";
$thesis = "Thesis";
$antithesis = "Antithesis";

?>

<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h1><?php echo htmlspecialchars($object->getQuestion($id)); ?></h1>   
        
            <!-- Frage neue Antworten hinzuzufügen -->
            <form id="send" method="POST" action="create.php?id=<?php echo $id; ?>">
                <div>
                    <input id="answer" type="text" name="answer" placeholder="new answer" required/>
                </div>
                <div>
                    <input id="file_upload" type="text" name="file_upload" placeholder="new file_upload" required/>
                </div>
                <div>
                    <select class="form-control" id="sel1" name="mindset" style="width:175px" required>
                        <?php if (!empty($mindset)) : ?>
                            <option value="<?php echo htmlspecialchars($mindset); ?>" selected><?php echo htmlspecialchars($mindset); ?></option>
                        <?php endif; ?>
                        <option value="Advantage">Advantage</option>
                        <option value="Disadvantage">Disadvantage</option>
                        <option value="Argument">Argument</option>
                        <option value="Counter-argument">Counter-argument</option>
                        <option value="Thesis">Thesis</option>
                        <option value="Antithesis">Antithesis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Create New Answer</button>
                    <button type="button" onclick="location.href='/read.php?id=<?php echo $id; ?>';" 
                        class="btn btn-danger">Go Back to Question 10</button>
                </div>
            </form>
        
            <?php
            // Get answer and file_upload
            $answer = isset($_POST['answer']) ? $_POST['answer'] : "";
            $fileupload = isset($_POST['file_upload']) ? $_POST['file_upload'] : "";
            
            if (!empty($answer) && !empty($fileupload) && !empty($mindset)) {
                // Basic input validation could be added here
                
                $object->createAnswer($answer, $fileupload, $mindset, $id);
                echo "Antwort erstellt zu " . htmlspecialchars($id) . "!";
            }
            ?>
        </div>
    </div> 
</div>

<?php require_once("footer.php");?>
