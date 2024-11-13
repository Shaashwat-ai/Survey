php
Copy code

<!DOCTYPE html>
<html>
<head>
    <title>Create a Survey</title>
</head>
<body>
    <h2>Create a New Survey</h2>
    <form action="save_survey.php" method="post">
        <label>Survey Title:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label>Description:</label><br>
        <textarea name="description" required></textarea><br><br>
        
        <h3>Questions</h3>
        <div id="questions">
            <div>
                <input type="text" name="questions[0][text]" placeholder="Question" required>
                <select name="questions[0][type]" required>
                    <option value="text">Text</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="dropdown">Dropdown</option>
                </select>
                <input type="text" name="questions[0][options]" placeholder="Options (comma-separated)">
            </div>
        </div>
        
        <button type="button" onclick="addQuestion()">Add Question</button><br><br>
        <input type="submit" value="Create Survey">
    </form>
    
    <script>
        let questionCount = 1;
        function addQuestion() {
            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `<input type="text" name="questions[${questionCount}][text]" placeholder="Question" required>
                <select name="questions[${questionCount}][type]" required>
                    <option value="text">Text</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="dropdown">Dropdown</option>
                </select>
                <input type="text" name="questions[${questionCount}][options]" placeholder="Options (comma-separated)">`;
            document.getElementById('questions').appendChild(questionDiv);
            questionCount++;
        }
    </script>
</body>
</html>
