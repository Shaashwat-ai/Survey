<?php
$pdo = new PDO('mysql:host=localhost;dbname=survey_system', 'root', '');


$stmt = $pdo->prepare("INSERT INTO responses (survey_id, user_id) VALUES (?, ?)");
$stmt->execute([$_POST['survey_id'], 1]); // Replace 1 with actual user ID if logged in
$response_id = $pdo->lastInsertId();


foreach ($_POST['answers'] as $question_id => $answer) {
    $answer_text = is_array($answer) ? implode(', ', $answer) : $answer;
    $stmt = $pdo->prepare("INSERT INTO answers (response_id, question_id, answer) VALUES (?, ?, ?)");
    $stmt->execute([$response_id, $question_id, $answer_text]);
}

echo "Response submitted successfully!";
?>
