<?php

require_once("db.php");

class Mindset {
    private $db;

    public function __construct() {
        // Aktualisieren Sie hier die Zugangsdaten entsprechend Ihrer Datenbankkonfiguration
        $servername = "db";
        $username = "user";
        $password = "password";
        $dbname = "phptestdb";

        $this->db = new Database();
        $this->db->connect($servername, $username, $password, $dbname);
    }


    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // simple method
    public function getAllUsersSimple()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getID($id, $mindset)
    {
        $sql = "SELECT id, answer, file_upload 
        FROM answers WHERE mindset = :mindset AND question_id = :id";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array(":id" => $id, ":mindset" => $mindset));
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>{$row['id']}</td>";
            echo "<td> {$row['answer']}</td>";
            echo "<td> {$row['file_upload']}</td>";
        }
    }
    
    public function getQuestion($id)
    {
        $sql = "SELECT * FROM questions WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array(":id" => $id));
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['question'];
        }
    }
    
    public function updateQuestion($id, $question)
    {
        $sql = "UPDATE questions SET question = :question WHERE id = :id";
        $stmt = $this->connect()->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);   
        $stmt->bindParam(':question', $question, PDO::PARAM_STR);       
        $stmt->execute(); 
    }
    
    public function getAllAnswers($id)
    {
        $sql = "SELECT questions.question, answer, answers.file_upload, answers.mindset 
        FROM questions 
        INNER JOIN answers 
        ON questions.id = answers.question_id 
        WHERE questions.id = :id";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array(":id" => $id));
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "<td>{$row['mindset']}</td></tr>";
        }
    }
    
    

    public function setCategorie($categorie)
    {
        $sql = "INSERT INTO categories(categorie) VALUES (:categorie)";  
        $stmt = $this->connect()->prepare($sql);                                         
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);                           
        $stmt->execute(); 
    }
    
    public function getAllQuestions()
    {
        $sql = "SELECT questions.id, questions.question, categories.categorie FROM questions
        INNER JOIN categories ON questions.categorie_id = categories.id
        ORDER BY questions.id ASC";
        
        $stmt = $this->db->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deleteQuestion($delID)
    {
        $sql = "DELETE FROM questions WHERE id = :id";
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $delID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function createAnswer($answer, $fileupload, $mindset, $id)
    {
        $sql = "INSERT INTO answers(answer, file_upload, mindset, question_id) 
            VALUES (:answer, :file_upload, :mindset, :question_id)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);       
        $stmt->bindParam(':file_upload', $fileupload, PDO::PARAM_STR);
        $stmt->bindParam(':mindset', $mindset, PDO::PARAM_STR); 
        $stmt->bindParam(':question_id', $id, PDO::PARAM_STR); 
        $stmt->execute();
    }
}
?>
