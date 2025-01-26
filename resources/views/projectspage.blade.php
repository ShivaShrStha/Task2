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
                <button onclick="showSingleChoice(this)"><i class="fas fa-dot-circle"></i> Select One</button>
                <button onclick="showMultipleChoice(this)"><i class="fas fa-check-square"></i> Select Many</button>
                <button onclick="showTextResponse(this)"><i class="fas fa-font"></i> Text</button>
                <button onclick="showNumberSelector(this)"><i class="fas fa-sort-numeric-up"></i> Number</button>
                <button onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date & Time</button>
                <button onclick="showPhotoUploader(this)"><i class="fas fa-camera"></i> Photo</button>
                <button onclick="showRatingSelector(this)"><i class="fas fa-star"></i> Rating</button>
                <button onclick="showRankingSelector(this)"><i class="fas fa-list-ol"></i> Ranking</button>
                <button><i class="fas fa-microphone"></i>Audio</button>
                <button><i class="fas fa-video"></i>Video</button>
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

            <div class="number-selector" style="display: none; margin-top: 20px;">
                <h4>Enter a Number:</h4>
                <input type="number" id="number-input" class="form-control" placeholder="Enter a whole number">
                <button class="btn btn-primary mt-3" onclick="saveNumberSelection(this)">Save</button>
            </div>

            <div class="saved-number" style="display: none; margin-top: 20px;">
                <h4>Selected Number:</h4>
                <p id="selected-number-display"></p>
            </div>

            <div class="photo-uploader" style="display: none; margin-top: 20px;">
                <h4>Upload a Photo:</h4>
                <input type="file" id="photo-input" class="form-control">
                <button class="btn btn-primary mt-3" onclick="savePhoto(this)">Save</button>
            </div>

            <div class="saved-photo" style="display: none; margin-top: 20px;">
                <h4>Uploaded Photo:</h4>
                <img id="photo-display" src="" alt="Uploaded Photo" style="max-width: 100%;">
            </div>

            <div class="single-choice" style="display: none; margin-top: 20px;">
                <h4>Multiple Choice Question (Select One):</h4>
                <div>
                    <input type="radio" id="option1" name="single-choice" value="Option 1">
                    <label for="option1">Option 1</label>
                </div>
                <div>
                    <input type="radio" id="option2" name="single-choice" value="Option 2">
                    <label for="option2">Option 2</label>
                </div>
                <div>
                    <input type="radio" id="option3" name="single-choice" value="Option 3">
                    <label for="option3">Option 3</label>
                </div>
                <button class="btn btn-primary mt-3" onclick="saveSingleChoice(this)">Save</button>
            </div>

            <div class="saved-single-choice" style="display: none; margin-top: 20px;">
                <h4>Selected Option:</h4>
                <p id="selected-single-choice-display"></p>
            </div>

            <div class="multiple-choice" style="display: none; margin-top: 20px;">
                <h4>Multiple Choice Question; multiple answers can be selected:</h4>
                <div class="multiple-choice-options">
                    <div>
                        <input type="checkbox" id="multiOption1" name="multiple-choice" value="Option 1">
                        <input type="text" value="Option 1" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
                    </div>
                    <div>
                        <input type="checkbox" id="multiOption2" name="multiple-choice" value="Option 2">
                        <input type="text" value="Option 2" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
                    </div>
                    <div>
                        <input type="checkbox" id="multiOption3" name="multiple-choice" value="Option 3">
                        <input type="text" value="Option 3" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
                    </div>
                </div>
                <button class="btn btn-secondary mt-3" onclick="addMultipleChoiceOption(this)">+</button>
                <button class="btn btn-primary mt-3" onclick="saveMultipleChoice(this)">Save</button>
            </div>

            <div class="saved-multiple-choice" style="display: none; margin-top: 20px;">
                <h4>Selected Multiple Choices:</h4>
                <p id="selected-multiple-choice-display"></p>
            </div>

            <div class="rating-selector" style="display: none; margin-top: 20px;">
                <h4>Select Ratings:</h4>
                <div>
                    <input type="checkbox" id="star5" name="rating" value="5">
                    <label for="star5"><i class="fas fa-star"></i></label>
                </div>
                <div>
                    <input type="checkbox" id="star4" name="rating" value="4">
                    <label for="star4"><i class="fas fa-star"></i></label>
                </div>
                <div>
                    <input type="checkbox" id="star3" name="rating" value="3">
                    <label for="star3"><i class="fas fa-star"></i></label>
                </div>
                <div>
                    <input type="checkbox" id="star2" name="rating" value="2">
                    <label for="star2"><i class="fas fa-star"></i></label>
                </div>
                <div>
                    <input type="checkbox" id="star1" name="rating" value="1">
                    <label for="star1"><i class="fas fa-star"></i></label>
                </div>
                <button class="btn btn-primary mt-3" onclick="saveRatingSelection(this)">Save</button>
            </div>

            <div class="saved-rating" style="display: none; margin-top: 20px;">
                <h4>Selected Ratings:</h4>
                <p id="selected-rating-display"></p>
            </div>

            <div class="text-response" style="display: none; margin-top: 20px;">
                <h4>Enter Your Response:</h4>
                <textarea id="text-input" class="form-control" rows="3"
                    placeholder="Enter your response here"></textarea>
                <button class="btn btn-primary mt-3" onclick="saveTextResponse(this)">Save</button>
            </div>

            <div class="saved-text-response" style="display: none; margin-top: 20px;">
                <h4>Text Response:</h4>
                <p id="text-response-display"></p>
            </div>

            <div class="ranking-selector" style="display: none; margin-top: 20px;">
                <h4>Enter Ranking (Number only):</h4>
                <input type="number" id="ranking-input" class="form-control" placeholder="Enter a rank">
                <button class="btn btn-primary mt-3" onclick="saveRankingSelection(this)">Save</button>
            </div>

            <div class="saved-ranking" style="display: none; margin-top: 20px;">
                <h4>Ranking:</h4>
                <p id="selected-ranking-display"></p>
            </div>
        </div>
    </div>

    <input type="hidden" id="used-options" value="">

    <button class="btn btn-success mt-3" onclick="submitForm()">Submit</button>

    <div class="summary-section" style="display: none; margin-top: 20px;">
        <h4>Summary of Selections:</h4>
        <div id="summary-content"></div>
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
    <script src="{{ asset('js/projectspage.js') }}"></script>

</body>

</html>