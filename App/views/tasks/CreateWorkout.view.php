<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Workout Plan</title>
</head>
<body>
    <h1>Create a New Workout Plan</h1>
    <form action="/workout/store" method="POST" enctype="multipart/form-data">
        <!-- Workout Plan Title -->
        <div>
            <label for="title">Workout Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <h3>Exercises</h3>
        <div id="exercises-container">
            <div class="exercise">
                <label for="exercise_name[]">Exercise Name:</label>
                <input type="text" name="exercise_name[]" required>

                <label for="description[]">Description:</label>
                <textarea name="description[]" required></textarea>

                <label for="photo[]">Photo (optional):</label>
                <input type="file" name="photo[]">
            </div>
        </div>

        <button type="button" onclick="addExercise()">Add Another Exercise</button>

        <!-- Submit Button -->
        <div>
            <button type="submit">Create Workout Plan</button>
        </div>
    </form>

    <script>
        // JavaScript to dynamically add more exercises
        function addExercise() {
            const container = document.getElementById('exercises-container');
            const exerciseDiv = document.createElement('div');
            exerciseDiv.classList.add('exercise');
            exerciseDiv.innerHTML = `
                <label for="exercise_name[]">Exercise Name:</label>
                <input type="text" name="exercise_name[]" required>

                <label for="description[]">Description:</label>
                <textarea name="description[]" required></textarea>

                <label for="photo[]">Photo (optional):</label>
                <input type="file" name="photo[]">
            `;
            container.appendChild(exerciseDiv);
        }
    </script>
</body>
</html>
