<?php
$pdo = new PDO('mysql:host=localhost;dbname=survey_system', 'root', '');


$stmt = $pdo->prepare("INSERT INTO surveys (title, description) VALUES (?, ?)");
$stmt->execute([$_POST['title'], $_POST['description']]);
$survey_id = $pdo->lastInsertId();

foreach ($_POST['questions'] as $question) {
    $stmt = $pdo->prepare("INSERT INTO questions (survey_id, question_text, question_type, options) VALUES (?, ?, ?, ?)");
    $options = $question['type'] == 'text' ? '' : $question['options'];
    $stmt->execute([$survey_id, $question['text'], $question['type'], $options]);
}

echo "Survey created successfully!";
?>
