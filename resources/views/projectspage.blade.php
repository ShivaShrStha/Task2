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
    <!-- Add necessary CSS for date pickers -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

        .calendar-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .calendar {
            width: 48%;
        }

        .calendar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
                <button onclick="alert('Select One functionality coming soon!')"><i class="fas fa-dot-circle"></i>
                    Select One</button>
                <button onclick="alert('Select Many functionality coming soon!')"><i class="fas fa-check-square"></i>
                    Select Many</button>
                <button onclick="alert('Text functionality coming soon!')"><i class="fas fa-font"></i> Text</button>
                <button onclick="alert('Number functionality coming soon!')"><i class="fas fa-sort-numeric-up"></i>
                    Number</button>
                <button onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date</button>
                <button onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date & Time</button>
                <button onclick="alert('Time functionality coming soon!')"><i class="fas fa-clock"></i> Time</button>
                <button onclick="alert('Photo functionality coming soon!')"><i class="fas fa-camera"></i> Photo</button>
                <button onclick="alert('Video functionality coming soon!')"><i class="fas fa-video"></i> Video</button>
                <button onclick="alert('Rating functionality coming soon!')"><i class="fas fa-star"></i> Rating</button>
                <button onclick="alert('Ranking functionality coming soon!')"><i class="fas fa-list-ol"></i>
                    Ranking</button>
                <button onclick="alert('Audio functionality coming soon!')"><i class="fas fa-microphone"></i>
                    Audio</button>
                <button onclick="alert('Note functionality coming soon!')"><i class="fas fa-bars"></i>
                    Note</button>
            </div>

            <div class="date-pickers" style="display: none; margin-top: 20px;">
                <h4>Select Date:</h4>
                <div class="calendar-container">
                    <div class="calendar">
                        <h5>English Date</h5>
                        <input type="text" id="english-calendar">
                    </div>
                    <div class="calendar">
                        <h5>Nepali Date</h5>
                        <input type="text" id="nepali-calendar">
                        <div id="nepali-date-display"></div> <!-- Add this line -->
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Time</label>
                    <input type="text" class="form-control time-picker" readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Add jQuery UI for datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add Nepali Date Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/nepali-datepicker/js/nepali.datepicker.v4.0.min.js"></script>
    <!-- Add Nepali Date Functions JS -->
    <script src="https://cdn.jsdelivr.net/npm/nepali-date-functions/dist/nepali-date-functions.min.js"></script>
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
            const englishCalendar = formSection.querySelector('#english-calendar');
            const nepaliCalendar = formSection.querySelector('#nepali-calendar');
            const timePickerInput = formSection.querySelector('.time-picker');
            const nepaliDateDisplay = formSection.querySelector('#nepali-date-display'); // Add this line

            datePickers.style.display = 'block';

            // Get today's AD date
            const today = new Date();
            const todayISO = today.toISOString().slice(0, 10);

            // Set today's date in the English calendar
            $(englishCalendar).val(todayISO);

            // Initialize English Date Picker
            $(englishCalendar).datepicker({
                dateFormat: "yy-mm-dd",
                defaultDate: today,
                onSelect: function (dateText) {
                    // Send the selected date to the server for conversion
                    $.ajax({
                        url: '/convert-date',
                        method: 'POST',
                        data: {
                            engDate: dateText,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            $(nepaliCalendar).val(response.nepaliDate);
                            nepaliDateDisplay.textContent = response.nepaliDate; // Add this line
                        }
                    });
                },
            }).datepicker("setDate", today);

            // Initialize Nepali Date Picker
            $(nepaliCalendar).nepaliDatePicker({
                onChange: function () {
                    const nepaliDateText = $(this).val();
                    const englishDate = LaravelNepaliDate.from(nepaliDateText).toEnglishDate(); // Convert BS to AD
                    $(englishCalendar).val(englishDate);
                    nepaliDateDisplay.textContent = nepaliDateText; // Add this line
                },
            });

            // Set current time
            const hours = today.getHours().toString().padStart(2, "0");
            const minutes = today.getMinutes().toString().padStart(2, "0");
            timePickerInput.value = `${hours}:${minutes}`;
        }
    </script>
</body>

</html>