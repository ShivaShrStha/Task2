<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    {{--
    <script src="https://unpkg.com/nepali-date-picker@2.0.1/dist/nepaliDatePicker.min.js"></script> --}}

</head>

<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4 mt-10 border border-green-200 ">
        <h2 class="text-2xl font-bold text-center mb-6">Form</h2>
        <div id="form-container">
            <div class="form-section bg-white p-6 rounded-lg shadow-md mb-6 hidden" id="form-section-template">
                <button class="delete-button" onclick="deleteFormSection(this)">x</button>
                <div class="flex items-center space-x-5">
                    <x-text-input type="text" id="question-input" placeholder="Enter your question here" />
                    <button class="bg-blue-500 text-white p-2 rounded-md" onclick="showQuestionTypes(this)">Add
                        Question</button>
                </div>

                <div class="question-types grid grid-cols-4 gap-4 mb-4">
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showSingleChoice(this)"><i class="fas fa-dot-circle mr-2"></i> Select One</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMultipleChoice(this)"><i class="fas fa-check-square mr-2"></i> Select
                        Many</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTextResponse(this)"><i class="fas fa-font mr-2"></i> Text</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showNumberSelector(this)"><i class="fas-solid fa-1 mr-2"></i> Number</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDecimalInput(this)"><i class="fas fa-percentage mr-2"></i> Decimal</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDatePicker(this)"><i class="fas fa-calendar-alt mr-2"></i> Date</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTime(this)"><i class="fas fa-clock mr-2"></i> Time</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDateTimePicker(this)"><i class="fas fa-calendar-alt mr-2"></i> Date &
                        Time</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showDistrict(this)"><i class="fas fa-location-dot mr-2"></i> District</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPointSelector(this)"><i class="fas fa-map-location-dot mr-2"></i>
                        Point</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showPhotoUploader(this)"><i class="fas fa-camera mr-2"></i> Photo</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAudio(this)"><i class="fas fa-volume-high mr-2"></i> Audio</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showVideoUploader(this)"><i class="fas fa-video mr-2"></i> Video</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showLine(this)"><i class="fas fa-arrow-trend-up mr-2"></i> Line</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showNoteInput(this)"><i class="fa-solid fa-bars mr-2"></i> Note</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showBarcode(this)"><i class="fas fa-barcode mr-2"></i> Barcode</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showQr(this)"><i class="fas fa-qrcode mr-2"></i> QR Code</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAcknowledgment(this)"><i class="fas fa-square-check mr-2"></i>
                        Acknowledge</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showAreaSelector(this)"><i class="fas fa-square mr-2"></i> Area</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRatingSelector(this)"><i class="fas fa-star mr-2"></i> Rating</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showMatrixInput(this)"><i class="fas fa-th mr-1"></i> Question Matrix</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showRankingSelector(this)"><i class="fas fa-list-ol mr-2"></i> Ranking</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showCalculator(this)"><i class="fas fa-calculator mr-2"></i> Calculate</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="hidden(this)"><i class="fas fa-eye-slash mr-2"></i> Hidden</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="signature(this)"><i class="fas fa-signature mr-2"></i> Signature</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showTableInput(this)"><i class="fas fa-table mr-2"></i> Table</button>
                    <button class="bg-gray-200 p-4 rounded-md hover:bg-gray-300 flex items-center justify-center"
                        onclick="showFileUploader(this)"><i class="fas fa-file-upload mr-2"></i> File
                        Upload</button>
                </div>
                <div class="single-choice mt-4" style="display: none;">
                    <input type="text" id="search-bar" placeholder="Search for options..."
                        class="w-80 p-2 border border-gray-300 rounded-md">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-3" onclick="fetchOptions(this)">
                        <i class="fas fa-search"></i>
                    </button>
                    <h4 class=" text-lg font-semibold mb-2 mt-2">Select One:</h4>
                    <div class="single-choice-options space-y-2">

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

                {{-- District --}}
                <div class="district" style="display: none;">
                    <p class="text-lg font-semibold mb-2">Select District:</p>
                    <select name=" district" class="district-dropdown mt-4 border border-gray-600 rounded-lg">
                        <option value="">Select a district</option>
                    </select>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 mt-4"
                        onclick="saveDistrict(this)">Save</button>
                </div>

                <div class="saved-district" style="display: none;">
                    <h4>Selected District:</h4>
                    <p class="selected-district-display mt-4"></p>
                </div>

                {{-- Current Location--}}
                <div class="point-selector mt-4" style="display: none;">
                    <p id="latitude" class="mt-2 text-gray-600"></p>
                    <p id="longitude" class="mt-2 text-gray-600"></p>
                </div>

                {{-- Line --}}
                <div class="geopicker widget hidden" id="geopicker">
                    <div class="search-bar">
                        <button id="detect-location" class="border border-gray-600 rounded-md"
                            title="Detect current location">
                            <span>📍 Detect Location</span>
                        </button>
                    </div>
                    <div class="map-canvas-wrapper">
                        <div id="map" style="height: 300px;"></div>
                    </div>
                    <div class="geo-inputs">
                        <label>Latitude: <input class="w-80 p-2 border border-gray-300 rounded-md" id="lat"
                                type="number" step="0.000001" min="-90" max="90"></label>
                        <label>Longitude: <input class="w-80 p-2 border border-gray-300 rounded-md" id="long"
                                type="number" step="0.000001" min="-180" max="180"></label>
                    </div>
                </div>

                {{-- Barcode --}}
                <div class="barcode hidden">
                    <h4 class="text-lg font-semibold mb-2">Barcode:</h4>
                    <input type="text" placeholder="Barcode Number"
                        class="w-full p-2 border border-gray-300 rounded-md">
                </div>

                {{-- QR --}}
                <div class="qrcode" style="display: none;">
                    <button id="camButton" class="bg-blue-500 text-white p-3 rounded-md mt-2" onclick="openCamera()">
                        <i class="fas fa-camera"></i> Open Camera
                    </button>
                    <h4 class="text-lg font-semibold mb-2">Decoded Text:</h4>
                    {{-- <input type="text" id="decoded-text" placeholder="QR Code Text"
                        class="w-full p-2 border border-gray-300 rounded-md"> --}}
                    <input type="text" id="decoded-text">
                </div>

                {{-- Date Picker --}}
                <div class="datepicker mt-4" style="display: none;">
                    <h4 class="text-lg font-semibold mb-2">Date:</h4>

                    <input class="w-40 p-2 border border-gray-300 rounded-md" type="date" id="datepicker">
                    <input type="text" id="nepaliDate" readonly class="w-40 p-2 border border-gray-300 rounded-md mt-2"
                        placeholder="Nepali Date">
                    <button type="button" class="btn-icon-only btn-reset mt-4" aria-label="reset"
                        onclick="resetDatePicker(this)">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>

                {{-- Time Picker --}}
                <div class="timepicker
                    mt-4" style="display: none;">
                    <h4 class="text-lg font-semibold mb-2">Time:</h4>

                    <input type="time" class="w-40 p-2 border border-gray-300 rounded-md" id="timepicker">
                    <button type="button" class="btn-icon-only btn-reset mt-4" aria-label="reset"
                        onclick="resetTimePicker(this)">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>

                {{-- Date Time Picker --}}
                <div class="datetimepicker widget mt-4 inline" style="display: none;">
                    <h4 class="text-lg font-semibold mb-2">Date & Time:</h4>

                    <div class="date">
                        <input class="w-40 p-2 border border-gray-300 rounded-md" type="date" placeholder="yyyy-mm-dd"
                            id="datepicker">
                        <input type="time" class="w-40 p-2 border border-gray-300 rounded-md" placeholder="hh:mm"
                            id="timepicker">
                        <button type="button" class="btn-icon-only btn-reset mt-4" aria-label="reset"
                            onclick="resetDateTimePicker(this)">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md mb-6" onclick="addFormSection()"><i
                class="fa-solid fa-plus"></i></button>
        <script src="{{ asset('js/form.js') }}" defer></script>
        <script>
            function deleteFormSection(button) {
                const formSection = button.closest(".form-section");
                if (confirm("Are you sure you want to delete this question? This action cannot be undone.")) {
                    formSection.remove();
                }
            }

        </script>
    </div>
</body>

</html>