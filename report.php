<?php
$pdo = new PDO('mysql:host=localhost;dbname=survey_system', 'root', '');

$survey_id = $_GET['id'];


$stmt = $pdo->prepare("
    SELECT q.question_text, a.answer, COUNT(a.answer) AS response_count 
    FROM answers a
    JOIN questions q ON a.question_id = q.id
    JOIN responses r ON a.response_id = r.id
    WHERE r.survey_id = ?
    GROUP BY q.id, a.answer
");
$stmt->execute([$survey_id]);
$results = $stmt->fetchAll();

foreach ($results as $row) {
    echo "<p><strong>{$row['question_text']}</strong>: {$row['answer']} ({$row['response_count']} responses)</p>";
}
?>

