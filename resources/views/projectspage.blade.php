<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- Add Bootstrap for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container" id="form-container">
        <h2>Form</h2>
        <button class="add-button" onclick="addFormSection()">+</button>

        <div class="form-section" id="form-section-template" style="display: none;">
            <input type="text" placeholder="Enter your question here">
            <button class="add-question-button" onclick="showQuestionTypes(this)">Add Question</button>
            <button class="remove-options-button" onclick="removeAllOptions(this)">Remove Options</button>

            <div class="question-types">
                <h4>Select Question Type:</h4>
                <button onclick="showSingleChoice(this)"><i class="fas fa-dot-circle"></i> Select One</button>
                <button onclick="showMultipleChoice(this)"><i class="fas fa-check-square"></i> Select Many</button>
                <button onclick="showTextResponse(this)"><i class="fas fa-font"></i> Text</button>
                <button onclick="showNumberSelector(this)"><i class="fas fa-sort-numeric-up"></i> Number</button>
                <button onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date</button>
                <button onclick="showDistrict(this)"><i class="fas fa-location-dot"></i> District</button>
                <button onclick="showPhotoUploader(this)"><i class="fas fa-camera"></i> Photo</button>
                <button onclick="showRatingSelector(this)"><i class="fas fa-star"></i> Rating</button>
                <button onclick="showRankingSelector(this)"><i class="fas fa-list-ol"></i> Ranking</button>
                <button onclick="showAudioRecorder(this)"><i class="fas fa-microphone"></i> Audio</button>
                <button onclick="showVideoUploader(this)"><i class="fas fa-video"></i> Video</button>
                <button onclick="showDecimalInput(this)"><i class="fas fa-percentage"></i> Decimal</button>
                <button onclick="showPointSelector(this)"><i class="fas fa-map-marker-alt"></i> Point</button>
                <button onclick="showLineInput(this)"><i class="fas fa-pen"></i> Line</button>
                <button onclick="showAreaSelector(this)"><i class="fas fa-draw-polygon"></i> Area</button>
                <button onclick="showBarcodeScanner(this)"><i class="fas fa-barcode"></i> Barcode</button>
                <button onclick="showMatrixInput(this)"><i class="fas fa-th"></i> Question Matrix</button>
                <button onclick="showAcknowledgment(this)"><i class="fas fa-handshake"></i> Acknowledge</button>
                <button onclick="showSignaturePad(this)"><i class="fas fa-signature"></i> Signature</button>
                <button onclick="showTableInput(this)"><i class="fas fa-table"></i> Table</button>
                <button onclick="showFileUploader(this)"><i class="fas fa-file-upload"></i> File Upload</button>
            </div>

            <div class="date-pickers" style="display: none; margin-top: 20px;">
                <h4>Select Date:</h4>
                <div class="calendar-container">
                    <div class="calendar">
                        <input type="date" id="english-calendar">
                    </div>
                </div>
            </div>

            {{-- for district --}}
            <div class="district" style="display: none">
                <h4>Select District:</h4>
                <select name="district" id="district" class="district-dropdown">
                    <option value="">Select a district</option>
                </select>
                <button class="btn btn-primary mt-3" onclick="saveDistrict(this)">Save</button>
            </div>

            <div class="saved-district" style="display: none; margin-top: 20px;">
                <h4>Selected District:</h4>
                <p id="selected-district-display"></p>
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
                <img id="photo-display" src="" alt="" style="max-width: 100%;">
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
                </div>
                <button class="btn btn-secondary mt-3" onclick="addMultipleChoiceOption(this)">+</button>
                <button class="btn btn-primary mt-3" onclick="saveMultipleChoice(this)">Save</button>
            </div>

            <div class="saved-multiple-choice" style="display: none; margin-top: 20px;">
                <h4>Selected Multiple Choices:</h4>
                <p id="selected-multiple-choice-display"></p>
            </div>

            <div class="rating-selector" style="display: none; margin-top: 20px;">
                <h4>Select Rating:</h4>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1">
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

            <div class="audio-uploader" style="display: none; margin-top: 20px;">
                <h4>Upload an Audio File:</h4>
                <input type="file" id="audio-input" class="form-control" accept="audio/*">
                <button class="btn btn-primary mt-3" onclick="saveAudio(this)">Save</button>
            </div>

            <div class="saved-audio" style="display: none; margin-top: 20px;">
                <h4>Uploaded Audio:</h4>
                <audio id="audio-display" controls></audio>
            </div>
        </div>
    </div>

    <input type="hidden" id="used-options" value="">

    {{-- <button class="btn btn-success mt-3" id="submit-button" onclick="submitForm()"
        style="display: none;">Submit</button>

    <div class="summary-section" style="display: none; margin-top: 20px;">
        <h4>Summary of Selections:</h4>
        <div id="summary-content"></div>
    </div> --}}

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Add jQuery UI for datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/projectspage.js') }}" defer></script>

</body>

</html>