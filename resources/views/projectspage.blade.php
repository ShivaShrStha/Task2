<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- @vite('resources/css/app.css') --}}
    <style>
        .form-section {
            position: relative;
            padding: 20px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background: none;
            border: none;
            color: red;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .delete-button:hover {
            color: darkred;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4">
        <h2 class="text-2xl font-bold text-center mb-6">Form</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-6" onclick="addFormSection()">+ Add</button>

        <div id="form-container">
            <div class="form-section bg-white p-6 rounded-lg shadow-md mb-6 hidden" id="form-section-template"
                style="display: none;">
                <button class="delete-button" onclick="deleteFormSection(this)">×</button>
                <input type="text" placeholder="Enter your question here"
                    class="w-full p-2 border border-gray-300 rounded-md mb-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4" onclick="showQuestionTypes(this)">Add
                    Question</button>
                <button class="remove-options-button" onclick="removeAllOptions(this)">Remove Options</button>

                <div class="question-types grid grid-cols-4 gap-4 mb-4">
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showSingleChoice(this)"><i class="fas fa-dot-circle"></i> Select One</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMultipleChoice(this)"><i class="fas fa-check-square"></i> Select Many</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTextResponse(this)"><i class="fas fa-font"></i> Text</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showNumberSelector(this)"><i class="fas fa-sort-numeric-up"></i> Number</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDistrict(this)"><i class="fas fa-location-dot"></i> District</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPhotoUploader(this)"><i class="fas fa-camera"></i> Photo</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRatingSelector(this)"><i class="fas fa-star"></i> Rating</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRankingSelector(this)"><i class="fas fa-list-ol"></i> Ranking</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAudioRecorder(this)"><i class="fas fa-microphone"></i> Audio</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showVideoUploader(this)"><i class="fas fa-video"></i> Video</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDecimalInput(this)"><i class="fas fa-percentage"></i> Decimal</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPointSelector(this)"><i class="fas fa-map-marker-alt"></i> Point</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showLineInput(this)"><i class="fas fa-pen"></i> Line</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAreaSelector(this)"><i class="fas fa-draw-polygon"></i> Area</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showBarcodeScanner(this)"><i class="fas fa-barcode"></i> Barcode</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMatrixInput(this)"><i class="fas fa-th"></i> Question Matrix</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAcknowledgment(this)"><i class="fas fa-handshake"></i> Acknowledge</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showSignaturePad(this)"><i class="fas fa-signature"></i> Signature</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTableInput(this)"><i class="fas fa-table"></i> Table</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showFileUploader(this)"><i class="fas fa-file-upload"></i> File Upload</button>
                </div>

                {{-- <div class="date-pickers" style="display: none; margin-top: 20px;">
                    <h4>Select Date:</h4>
                    <div class="calendar-container">
                        <div class="calendar">
                            <input type="date" id="english-calendar">
                        </div>
                    </div>
                </div>

                <div class="district" style="display: none; margin-top: 20px;">
                    <h4>Select District:</h4>
                    <select name="district" class="district-dropdown">
                        <option value="">Select a district</option>
                    </select>
                    <button class="btn btn-primary mt-3" onclick="saveDistrict(this)">Save</button>
                </div>

                <div class="saved-district" style="display: none; margin-top: 20px;">
                    <h4>Selected District:</h4>
                    <p class="selected-district-display"></p>
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
                        <input type="radio" id="multiOption1" name="single-choice" value="Option 1">
                        <input type="text" placeholder="Option 1" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
                    </div>
                    <div>
                        <input type="radio" id="multiOption2" name="single-choice" value="Option 2">
                        <input type="text" placeholder="Option 2" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
                    </div>
                    <div>
                        <input type="radio" id="multiOption3" name="single-choice" value="Option 3">
                        <input type="text" placeholder="Option 3" class="form-control d-inline-block w-auto"
                            oninput="updateOptionValue(this)">
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
                            <input type="text" placeholder="Option 1" class="form-control d-inline-block w-auto"
                                oninput="updateOptionValue(this)">
                        </div>
                        <div>
                            <input type="checkbox" id="multiOption2" name="multiple-choice" value="Option 2">
                            <input type="text" placeholder="Option 2" class="form-control d-inline-block w-auto"
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
            </div> --}}
        </div>

        <input type="hidden" id="used-options" value="">

        {{-- <button class="btn btn-success mt-3" id="submit-button" onclick="submitForm()"
            style="display: none;">Submit</button>

        <div class="summary-section" style="display: none; margin-top: 20px;">
            <h4>Summary of Selections:</h4>
            <div id="summary-content"></div>
        </div> --}}

        <script src="{{ asset('js/projectspage.js') }}" defer></script>
        <script>
            function deleteFormSection(button) {
                const formSection = button.closest(".form-section");
                formSection.remove();
            }
        </script>

</body>

</html>