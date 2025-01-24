<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Form</title>
    <!-- Add Bootstrap for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add Nepali Date Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nepali-datepicker/css/nepali.datepicker.v4.0.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
        }
        .add-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
        }
        .form-section {
            margin-top: 20px;
        }
        .question-types {
            display: none;
            margin-top: 20px;
        }
        .question-types button {
            display: inline-block;
            margin: 5px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f8f8;
            cursor: pointer;
        }
        .question-types button:hover {
            background-color: #e0e0e0;
        }
        .form-section input {
            width: calc(100% - 120px);
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-section .add-question-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .dynamic-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container" id="form-container">
        <h2>Interactive Form</h2>
        <button class="add-button" onclick="addFormSection()">+</button>

        <div class="form-section" id="form-section-template" style="display: none;">
            <input type="text" placeholder="Enter your question here">
            <button class="add-question-button" onclick="showQuestionTypes(this)">Add Question</button>

            <div class="question-types">
                <h4>Select Question Type:</h4>
                <button onclick="alert('Select One functionality coming soon!')"><i class="fas fa-dot-circle"></i> Select One</button>
                <button onclick="alert('Select Many functionality coming soon!')"><i class="fas fa-check-square"></i> Select Many</button>
                <button onclick="alert('Text functionality coming soon!')"><i class="fas fa-font"></i> Text</button>
                <button onclick="alert('Number functionality coming soon!')"><i class="fas fa-sort-numeric-up"></i> Number</button>
                <button onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date & Time</button>
                <button onclick="alert('Photo functionality coming soon!')"><i class="fas fa-camera"></i> Photo</button>
                <button onclick="alert('Rating functionality coming soon!')"><i class="fas fa-star"></i> Rating</button>
                <button onclick="alert('Ranking functionality coming soon!')"><i class="fas fa-list-ol"></i> Ranking</button>
                <button onclick="alert('Audio functionality coming soon!')"><i class="fas fa-microphone"></i> Audio</button>
            </div>

            <div class="date-pickers" style="display: none; margin-top: 20px;">
                <h4>Select Date:</h4>
                <div class="mb-3">
                    <label class="form-label">English Date</label>
                    <input type="text" class="form-control english-date">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nepali Date</label>
                    <input type="text" class="form-control nepali-date">
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add Nepali Date Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/nepali-datepicker/js/nepali.datepicker.v4.0.min.js"></script>
    <script>
        function addFormSection() {
            const container = document.getElementById('form-container');
            const template = document.getElementById('form-section-template');
            const clone = template.cloneNode(true);
            clone.style.display = 'block';
            clone.id = '';
            container.appendChild(clone);
        }

        function showQuestionTypes(button) {
            const formSection = button.parentElement;
            const questionTypes = formSection.querySelector('.question-types');
            const input = formSection.querySelector('input').value;

            if (input.trim() === '') {
                alert('Please enter a question first.');
                return;
            }

            questionTypes.style.display = 'block';
        }

        function showDatePickers(button) {
            const formSection = button.parentElement.parentElement;
            const datePickers = formSection.querySelector('.date-pickers');
            const englishDateInput = formSection.querySelector('.english-date');
            const nepaliDateInput = formSection.querySelector('.nepali-date');

            datePickers.style.display = 'block';

            // Initialize Nepali Date Picker
            $(nepaliDateInput).nepaliDatePicker({
                ndpEnglishInput: englishDateInput
            });

            // Set today's date for English Date Picker
            const today = new Date().toISOString().split('T')[0];
            englishDateInput.value = today;

            // Set today's date for Nepali Date Picker
            const nepaliToday = NepaliFunctions.GetCurrentBsDate();
            nepaliDateInput.value = `${nepaliToday.bsYear}-${nepaliToday.bsMonth}-${nepaliToday.bsDate}`;
        }
    </script>
</body>
</html>
