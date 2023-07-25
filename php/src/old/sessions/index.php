<?php
require_once("header.php");

$object = new Mindset;

if(isset($_POST['categorie'])){$categorie = $_POST['categorie'];}
if(isset($_GET['delete'])){$delete = $_GET['delete'];}
if(isset($_POST['question'])){$question = $_POST['question'];}
if(isset($_POST['categorie_id'])){$categorie_id = $_POST['categorie_id'];}


?>


<div class="row col-sm-3"></div>
<div class="container col-sm-6 text-center">
    <div class="row">
       
        <div class="col-sm-4 text-center">
            <h1>Questions</h1>
            <!--Formular um neue Fragen hinzuzufügen-->
            <form id="send" method="POST" action="index.php">
            <input id="question" type="text" name="question" placeholder="add new question" required/>
            <select style="width:150px" class="form-control" id="categorie_id" name="categorie_id">
            <?php
                // SELECT from categorie die id und categorie name gebe als foreach aus
                $sql= "SELECT id, categorie FROM categories";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $row){
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
                // put data in questions 
                $sql = "INSERT INTO questions (question, categorie_id) VALUES (:question, :categorie_id)";
                // prepare statement                                      
                $stmt = $conn->prepare($sql);
                // bind parameters                                             
                $stmt->bindParam(':question', $question, PDO::PARAM_STR);  
                $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_STR); 
                // execute                                
                $stmt->execute();
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Tabelle um Datensätze anzuzeigen-->
            <table class="table table-bordered table-striped" style="width:800px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Categorie</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Wiki</th>
                </tr>
            </thead>
            <tbody>
                <?php $object->getAllQuestions(); ?>
            
                <!--Lesen von Datensätzen-->
                <td><a href='read.php?id={$row['id']}'>read</a></td>
                <!--Link der zu update.php führt und id von Beitrag dranhängt-->
                <td><a href='update.php?id={$row['id']}'>o</a></td>
                <!--führt zu index.php und hängt id an delete an-->
                <td><a href='?delete={$row['id']}'>x</a></td>
                <td><a href='https://de.wikipedia.org/wiki/{$row['question']}' target='_blank'>wiki</a></td></tr>
                
                <?php
                // wenn delete=id gesetzt, dann löschen
                if(isset($delete) && !empty($delete)){
                    // nimm die delete=id
                    $delID = $delete;
                    // DELETE
                    $object->deleteQuestion($delID);
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Categories</h3>
            <!--Formular um neue Kategorien hinzuzufügen-->
            <form id="send" method="POST" action="index.php">
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
                <?php $object->getAllCategories(); ?>
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
