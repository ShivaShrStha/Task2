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
      display: none;
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
  </style>
</head>
<body>
  <div class="container">
    <h2>Interactive Form</h2>
    <button class="add-button" onclick="showFormSection()">+</button>

    <div class="form-section" id="form-section">
      <input type="text" id="question-input" placeholder="Enter your question here">
      <button class="add-question-button" onclick="showQuestionTypes()">Add Question</button>
    </div>

    <div class="question-types" id="question-types">
      <h4>Select Question Type:</h4>
      <button onclick="addQuestion('select-one')"><i class="fas fa-dot-circle"></i> Select One</button>
      <button onclick="addQuestion('select-many')"><i class="fas fa-check-square"></i> Select Many</button>
      <button onclick="addQuestion('text')"><i class="fas fa-font"></i> Text</button>
      <button onclick="addQuestion('number')"><i class="fas fa-sort-numeric-up"></i> Number</button>
      <button onclick="showDatePickers()"><i class="fas fa-calendar-alt"></i> Date & Time</button>
      <button onclick="addQuestion('photo')"><i class="fas fa-camera"></i> Photo</button>
      <button onclick="addQuestion('rating')"><i class="fas fa-star"></i> Rating</button>
      <button onclick="addQuestion('ranking')"><i class="fas fa-list-ol"></i> Ranking</button>
      <button onclick="addQuestion('audio')"><i class="fas fa-microphone"></i> Audio</button>
    </div>

    <div id="date-pickers" style="display: none; margin-top: 20px;">
      <h4>Select Date:</h4>
      <div class="mb-3">
        <label for="english-date" class="form-label">English Date</label>
        <input type="text" class="form-control" id="english-date">
      </div>
      <div class="mb-3">
        <label for="nepali-date" class="form-label">Nepali Date</label>
        <input type="text" class="form-control" id="nepali-date">
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
    function showFormSection() {
      document.getElementById('form-section').style.display = 'block';
    }

    function showQuestionTypes() {
      const input = document.getElementById('question-input').value;
      if (input.trim() === '') {
        alert('Please enter a question first.');
        return;
      }

      document.getElementById('question-types').style.display = 'block';
    }

    function showDatePickers() {
      document.getElementById('date-pickers').style.display = 'block';

      // Initialize Nepali Datepicker
      const nepaliInput = document.getElementById('nepali-date');
      const englishInput = document.getElementById('english-date');

      $(nepaliInput).nepaliDatePicker({
        ndpEnglishInput: englishInput
      });

      // Set today's date in English Date Picker
      const today = new Date();
      const formattedToday = today.toISOString().split('T')[0];
      englishInput.value = formattedToday;

      // Set today's date in Nepali Date Picker
      const nepaliToday = NepaliFunctions.GetBsDate(today.getFullYear(), today.getMonth() + 1, today.getDate());
      nepaliInput.value = `${nepaliToday.bsYear}-${nepaliToday.bsMonth}-${nepaliToday.bsDate}`;
    }

    function addQuestion(type) {
      const questionInput = document.getElementById('question-input').value;
      if (questionInput.trim() === '') {
        alert('Please enter a question first.');
        return;
      }

      // Add logic to handle different question types
      alert(`Question added: ${questionInput} (Type: ${type})`);
    }
  </script>
</body>
</html>
