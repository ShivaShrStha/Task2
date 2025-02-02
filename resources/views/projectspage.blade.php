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

        .question-types {
            display: none;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4 mt-10 border border-green-200 ">
        <h2 class="text-2xl font-bold text-center mb-6">Form</h2>


        <div id="form-container">
            <div class="form-section bg-white p-6 rounded-lg shadow-md mb-6 hidden" id="form-section-template"
                style="display: none;">
                <button class="delete-button" onclick="deleteFormSection(this)">×</button>
                <input type="text" placeholder="Enter your question here"
                    class="w-full p-2 border border-gray-300 rounded-md mb-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4" onclick="showQuestionTypes(this)">Add
                    Question</button>

                <div class="question-types grid grid-cols-4 gap-4 mb-4">
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showSingleChoice(this)"><i class="fas fa-dot-circle"></i> Select One</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMultipleChoice(this)"><i class="fas fa-check-square"></i> Select Many</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTextResponse(this)"><i class="fas fa-font"></i> Text</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showNumberSelector(this)"><i class="fas-solid fa-7 "></i> Number</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDecimalInput(this)"><i class="fas fa-percentage"></i> Decimal</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDatePickers(this)"><i class="fas fa-calendar-alt"></i> Date</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTimeInput(this)"><i class="fas fa-clock"></i> Time</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDistrict(this)"><i class="fas fa-location-dot"></i> District</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPointSelector(this)"><i class="fas fa-map-marker-alt"></i> Point</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPhotoUploader(this)"><i class="fas fa-camera"></i> Photo</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAudio(this)"><i class="fas fa-volume-high"></i> Audio</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showVideoUploader(this)"><i class="fas fa-video"></i> Video</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showLineInput(this)"><i class="fas fa-arrow-trend-up"></i> Line</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showNoteInput(this)"><i class="fa-solid fa-bars"></i> Note</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showBarcodeScanner(this)"><i class="fas fa-barcode"></i> Barcode</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAcknowledgment(this)"><i class="fas fa-square-check"></i> Acknowledge</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAreaSelector(this)"><i class="fas fa-square"></i> Area</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRatingSelector(this)"><i class="fas fa-star"></i> Rating</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMatrixInput(this)"><i class="fas fa-th"></i> Question Matrix</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRankingSelector(this)"><i class="fas fa-list-ol"></i> Ranking</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showCalculator(this)"><i class="fas fa-calculator"></i> Calculate</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showSignature(this)"><i class="fas fa-signature"></i> Signature</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTableInput(this)"><i class="fas fa-table"></i> Table</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showFileUploader(this)"><i class="fas fa-file-upload"></i> File Upload</button>
                </div>

                {{-- <i class="fas fa-search absolute mt-4 ml-3"></i>
                <input type="search" placeholder="      Search for options"
                    class="w-full p-2 border border-gray-300 rounded-md mb-2"> --}}
                <!-- Single Choice Section -->
                <div class="single-choice mt-4" style="display: none;">
                    <select name="single-choice-options" id="single-choice-options" onchange="populateOptions(this)">
                        <option value="select">Select</option>
                        <option value="gender">Gender</option>
                        <option value="relation">Relation</option>
                        <option value="marital">Marital Status</option>

                    </select>
                    <h4 class="text-lg font-semibold mb-2">Select One:</h4>
                    <div class="single-choice-options space-y-2">
                        <div class="flex items-center">
                            <input type="radio" name="single-choice" class="mr-2">
                            <input type="text" placeholder="Option 1"
                                class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionVal(this)">
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="single-choice" class="mr-2">
                            <input type="text" placeholder="Option 2"
                                class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionVal(this)">
                        </div>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3"
                        onclick="addSingleChoiceOption(this)">+ Add Option</button>
                </div>

                <!-- Multiple Choice Section -->
                <div class="multiple-choice mt-4" style="display: none;">
                    <h4 class="text-lg font-semibold mb-2">Select Many:</h4>
                    <div class="multiple-choice-options space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="multiple-choice" class="mr-2">
                            <input type="text" placeholder="Option 1"
                                class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionValue(this)">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="multiple-choice" class="mr-2">
                            <input type="text" placeholder="Option 2"
                                class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionValue(this)">
                        </div>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3"
                        onclick="addMultipleChoiceOption(this)">+ Add Option</button>
                </div>
            </div>

        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-6" onclick="addFormSection()">+ Add</button>
        <script src="{{ asset('js/projectspage.js') }}" defer></script>
        <script>
            function deleteFormSection(button) {
                const formSection = button.closest(".form-section");
                formSection.remove();
            }
        </script>
    </div>
</body>

</html>