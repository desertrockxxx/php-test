<?php
require_once("header.php");

if(isset($_POST['categorie'])) {
    $categorie = $_POST['categorie'];
}
if(isset($_GET['delete'])) {
    $delete = $_GET['delete'];
}
if(isset($_POST['question'])) {
    $question = $_POST['question'];
}
if(isset($_POST['categorie_id'])) {
    $categorie_id = $_POST['categorie_id'];
}

$object = new Mindset;

?>
<div class="row col-sm-6"></div>
<div class="container col-sm-6 text-center">
    <div class="row">
        <div class="col-sm-4 text-center">
            <h1>Questions</h1>
            <!-- Formular um neue Fragen hinzuzufügen -->
            <form method="POST" action="index.php">
                <label for="question">Add new question</label>
                <input id="question" type="text" name="question" placeholder="Add New Question" required/>
                <select style="width:150px" class="form-control" id="categorie_id" name="categorie_id">
                    <?php
                    
                    // $object ist eine Instanz der Mindset-Klasse
                    $categories = $object->getAllCategories();

                    // Durchlaufe alle Kategorien und erstelle ein Dropdown-Menü mit den Kategorien als Optionen
                    foreach ($categories as $row) {
                        echo "<option value='{$row['id']}'>{$row['categorie']}</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Create New Question</button>
            </form>
            
            <?php
            // INSERT
            // Wenn title und content gesetzt, dann beide in Datenbank einfügen
            if (isset($question) && isset($categorie_id)){
                $object->setQuestion($question, $categorie_id);
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            
            <!-- Tabelle um Datensätze anzuzeigen-->
            <table class="table table-bordered table-striped" style="width:800px">
            <p>Test1</p>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Read</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Wiki</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lesen von Datensätzen
                $questions = $object->getAllQuestions();
                if ($questions) {
                    foreach($questions as $row) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['question']}</td>";
                        echo "<td>{$row['categorie']}</td>";
                        echo "<td><a href='read.php?id={$row['id']}'>read</a></td>";
                        echo "<td><a href='update.php?id={$row['id']}'>o</a></td>";
                        echo "<td><a href='?delete={$row['id']}'>x</a></td>";
                        echo "<td><a href='https://de.wikipedia.org/wiki/{$row['question']}' target='_blank'>wiki</a></td>";
                        echo "</tr>";
                    }
                }
                
                // wenn delete=id gesetzt, dann löschen
                if(isset($delete) && !empty($delete)){
                    // nimm die delete=id
                    $delID = $delete;
                    // DELETE
                    $object->deleteQuestion($delID);
                }
                ?>
            </tbody>
            <p>Test1</p>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Categories</h3>
            <!--Formular um neue Kategorien hinzuzufügen-->
            <form method="POST" action="index.php">
                <label for="categorie">Add new categorie</label>
                <input id="categorie" type="text" name="categorie" placeholder="add new categorie" required/>
                <button type="submit" class="btn btn-primary">Create New Categorie</button>
            </form>
            
            <?php
            if (isset($categorie)){
                $object->setCategorie($categorie);
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Categorie Tabelle Datensätze anzuzeigen-->
            <table class="table table-bordered table-striped" style="width:800px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categories</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = $object->getAllCategories();
                if ($categories) {
                    foreach($categories as $row) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['categorie']}</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            
            <button class="btn btn-info" data-toggle="collapse" data-target="#mindsetinfo">Mindset Info</button>
            <div id="mindsetinfo" class="collapse">
                <?php include 'mindsetinfo.php';?>
            </div>
            <p>Advantage, Disadvantage, Argument, Counter-argument, Thesis, Antithesis, Hypothesis & Fact </p>
            <p>Quellen: <a href="https://de.wiktionary.org/wiki/" target="_blank">Wiktionary</a></p>
        </div>
    </div>
</div>

<?php require_once("footer.php");?>
