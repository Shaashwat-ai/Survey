<?php
$pdo = new PDO('mysql:host=localhost;dbname=survey_system', 'root', '');


$survey_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM surveys WHERE id = ?");
$stmt->execute([$survey_id]);
$survey = $stmt->fetch();

$questions_stmt = $pdo->prepare("SELECT * FROM questions WHERE survey_id = ?");
$questions_stmt->execute([$survey_id]);
$questions = $questions_stmt->fetchAll();

?>

<h2><?php echo $survey['title']; ?></h2>
<p><?php echo $survey['description']; ?></p>

<form action="submit_response.php" method="post">
    <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
    
    <?php foreach ($questions as $question): ?>
        <p><?php echo $question['question_text']; ?></p>
        
        <?php if ($question['question_type'] == 'text'): ?>
            <input type="text" name="answers[<?php echo $question['id']; ?>]">
        
        <?php elseif ($question['question_type'] == 'radio' || $question['question_type'] == 'checkbox'): ?>
            <?php foreach (explode(',', $question['options']) as $option): ?>
                <label>
                    <input type="<?php echo $question['question_type']; ?>" name="answers[<?php echo $question['id']; ?>][]" value="<?php echo $option; ?>">
                    <?php echo $option; ?>
                </label>
            <?php endforeach; ?>
        
        <?php elseif ($question['question_type'] == 'dropdown'): ?>
            <select name="answers[<?php echo $question['id']; ?>]">
                <?php foreach (explode(',', $question['options']) as $option): ?>
                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <input type="submit" value="Submit">
</form>
