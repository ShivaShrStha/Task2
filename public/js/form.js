function addFormSection() {
    const container = document.getElementById("form-container");
    const template = document.getElementById("form-section-template");

    if (!container) {
        console.error("Container element not found");
        return;
    }
    if (!template) {
        console.error("Template element not found");
        return;
    }

    const clone = template.cloneNode(true);
    clone.style.display = "block";
    clone.id = "";
    container.appendChild(clone);

    const newInput = clone.querySelector("#question-input");
    if (newInput) {
        newInput.focus();
    }

    const addQuestionButton = clone.querySelector(".bg-blue-500");
    if (addQuestionButton) {
        addQuestionButton.style.display = "block";
    } else {
        console.error("Add question button not found in the template");
    }
}

function showQuestionTypes(button) {
    const formSection = button.closest(".form-section");
    const questionTypes = formSection.querySelector(".question-types");
    const input = formSection.querySelector("input[type='text']");

    if (!input || input.value.trim() === "") {
        alert("Please enter a question first.");
        return;
    }

    questionTypes.style.display = "grid";
}

function showDistrict(button) {
    const formSection = button.closest(".form-section");
    const districtDropdown = formSection.querySelector(".district-dropdown");

    districtDropdown.innerHTML = "<option>Loading...</option>";

    fetch("/get-districts")
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((districts) => {
            districtDropdown.innerHTML = "";

            const defaultOption = document.createElement("option");
            defaultOption.textContent = "Select a district";
            defaultOption.value = "";
            districtDropdown.appendChild(defaultOption);

            districts.forEach((district) => {
                const option = document.createElement("option");
                option.value = district;
                option.textContent = district;
                districtDropdown.appendChild(option);
            });

            const districtSelector = formSection.querySelector(".district");
            districtSelector.style.display = "block";
        })
        .catch((error) => {
            console.error("Error loading districts:", error);
            districtDropdown.innerHTML =
                "<option>Error loading districts</option>";
        });
    districtDropdown.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";
}
function saveDistrict(button) {
    const formSection = button.closest(".form-section");
    const districtDropdown = formSection.querySelector(".district-dropdown");
    const selectedDistrict = districtDropdown.value;
    const selectedDistrictDisplay = formSection.querySelector(
        ".selected-district-display"
    );
    const savedDistrictSection = formSection.querySelector(".saved-district");

    if (selectedDistrict.trim() === "") {
        return;
    }

    selectedDistrictDisplay.textContent = selectedDistrict;
    savedDistrictSection.style.display = "block";
    formSection.querySelector(".district").style.display = "none";
}

function showSingleChoice(button) {
    const formSection = button.parentElement.parentElement;
    const singleChoice = formSection.querySelector(".single-choice");
    const questionTypes = formSection.querySelector(".question-types");

    const optionInputs = singleChoice.querySelectorAll("input[type='text']");
    optionInputs.forEach((input) => {
        input.readOnly = false;
    });

    singleChoice.style.display = "block";
    questionTypes.style.display = "none";
}

function addSingleChoiceOption(button) {
    const formSection = button.closest(".form-section");
    const singleChoiceOptions = formSection.querySelector(
        ".single-choice-options"
    );

    if (!singleChoiceOptions) {
        console.error("Element '.single-choice-options' not found");
        return;
    }

    const optionCount = singleChoiceOptions.children.length + 1;

    const newOption = document.createElement("div");
    newOption.classList.add("flex", "items-center");
    newOption.innerHTML = `
        <input type="radio" name="single-choice" class="mr-2">
        <input type="text" placeholder="Option ${optionCount}"
            class="w-full p-2 border border-gray-300 rounded-md"
            oninput="updateOptionVal(this)">
    `;

    singleChoiceOptions.appendChild(newOption);
}
function updateOptionVal(input) {
    const radio = input.previousElementSibling;
    radio.value = input.value;
}

function fetchOptions(button) {
    const questionContainer = button.closest(".single-choice");
    const searchInput = questionContainer.querySelector("#search-bar");
    const optionsContainer = questionContainer.querySelector(
        ".single-choice-options"
    );

    const query = searchInput.value.trim();

    if (query.length < 2) {
        optionsContainer.innerHTML =
            "<p class='text-gray-500'>Enter at least 2 characters</p>";
        return;
    }

    fetch(`/get-options?query=${encodeURIComponent(query)}`)
        .then((response) => response.json())
        .then((data) => {
            optionsContainer.innerHTML = "";

            if (data.length === 0) {
                optionsContainer.innerHTML = `<p class="text-gray-500">No options found.</p>`;
                return;
            }

            data.forEach((option, index) => {
                const newOption = document.createElement("div");
                newOption.classList.add("flex", "items-center", "mb-2");
                newOption.innerHTML = `
                    <input type="radio" name="single-choice-${questionContainer.dataset.questionId}" id="option${index}" class="mr-2" value="${option}">
                    <input type="text" placeholder="Option ${index}" class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionVal(this)" value="${option}">

                    `;
                optionsContainer.appendChild(newOption);
            });
        })
        .catch((error) => console.error("Error fetching options:", error));
}
function showMultipleChoice(button) {
    const formSection = button.closest(".form-section");
    const multipleChoice = formSection.querySelector(".multiple-choice");

    const optionInputs = multipleChoice.querySelectorAll("input[type='text']");
    optionInputs.forEach((input) => {
        input.readOnly = false;
    });

    multipleChoice.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";
}

function addMultipleChoiceOption(button) {
    const formSection = button.closest(".form-section");
    const multipleChoiceOptions = formSection.querySelector(
        ".multiple-choice-options"
    );
    const optionCount = multipleChoiceOptions.children.length + 1;

    const newOption = document.createElement("div");
    newOption.classList.add("flex", "items-center", "mt-2");
    newOption.innerHTML = `
    <input type="checkbox" class="mr-2">
    <input type="text" placeholder="Option ${optionCount}" class="w-full p-2 border border-gray-300 rounded-md" oninput="updateOptionValue(this)">
    `;
    multipleChoiceOptions.appendChild(newOption);
}

function updateOptionValue(input) {
    const checkbox = input.previousElementSibling;
    checkbox.value = input.value;
}

function showTextResponse(button) {
    hideUsedOption(button, "showTextResponse");
    formSection.querySelector(".question-types").style.display = "none";
}
function showNumberSelector(button) {
    hideUsedOption(button, "showNumberSelector");
    formSection.querySelector(".question-types").style.display = "none";
}
function showDecimalInput(button) {
    hideUsedOption(button, "showDecimalInput");
    formSection.querySelector(".question-types").style.display = "none";
}

function showDatePicker(button) {
    const formSection = button.closest(".form-section");
    const datePicker = formSection.querySelector(".datepicker");
    const datepickerInput = formSection.querySelector("#datepicker");
    const nepaliDateDisplay = formSection.querySelector("#nepaliDate");

    datePicker.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";

    datepickerInput.addEventListener("change", function () {
        const selectedDate = new Date(this.value);
        const adYear = selectedDate.getFullYear();
        const adMonth = selectedDate.getMonth() + 1;
        const adDay = selectedDate.getDate();

        const bsDate = adToBs(adYear, adMonth, adDay);
        nepaliDateDisplay.value = `${bsDate.year}-${bsDate.month
            .toString()
            .padStart(2, "0")}-${bsDate.day.toString().padStart(2, "0")}`;
    });
}
function resetDatePicker(button) {
    const formSection = button.closest(".form-section");
    const datepickerInput = formSection.querySelector("#datepicker");
    const nepaliDateDisplay = formSection.querySelector("#nepaliDate");

    datepickerInput.value = "";
    nepaliDateDisplay.value = "";
}

function showTime(button) {
    const formSection = button.closest(".form-section");
    const timeInput = formSection.querySelector(".timepicker");

    timeInput.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";
}
function resetTimePicker(button) {
    const timePicker = button.closest(".timepicker");
    timePicker.querySelector("#timepicker").value = "";
}

function showDateTimePicker(button) {
    const formSection = button.closest(".form-section");
    const dateTimePicker = formSection.querySelector(".datetimepicker");

    dateTimePicker.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";
}
function resetDateTimePicker(button) {
    const dateTimePicker = button.closest(".datetimepicker");
    dateTimePicker.querySelector("#datepicker").value = "";
    dateTimePicker.querySelector("#timepicker").value = "";
}

function showPointSelector(button) {
    const formSection = button.closest(".form-section");
    const pointSelector = formSection.querySelector(".point-selector");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude;

                pointSelector.querySelector(
                    "#latitude"
                ).innerText = `Latitude: ${latitude}`;
                pointSelector.querySelector(
                    "#longitude"
                ).innerText = `Longitude: ${longitude}`;
            },
            function (error) {
                console.error("Error getting location:", error.message);
                alert("Unable to retrieve location. Please enable GPS.");
            }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    pointSelector.style.display = "block";
    formSection.querySelector(".question-types").style.display = "none";
}

function showPhotoUploader(button) {
    hideUsedOption(button, "showPhotoUploader");
    formSection.querySelector(".question-types").style.display = "none";
}
function showAudio(button) {
    hideUsedOption(button, "showAudio");
    formSection.querySelector(".question-types").style.display = "none";
}
function showVideoUploader(button) {
    hideUsedOption(button, "showVideoUploader");
    formSection.querySelector(".question-types").style.display = "none";
}
function showLine(button) {
    const formSection = button.closest(".form-section");
    if (!formSection) return;

    const line = formSection.querySelector(".geopicker");
    if (line) {
        line.style.display = "block";
        if (!line.dataset.mapInitialized) {
            initializeMap(line);
            line.dataset.mapInitialized = "true";
        }
    }

    const questionTypes = formSection.querySelector(".question-types");
    if (questionTypes) {
        questionTypes.style.display = "none";
    }
}

function initializeMap(geopickerContainer) {
    const mapDiv = geopickerContainer.querySelector("#map");
    if (!mapDiv) {
        console.error("Map container not found within geopicker");
        return;
    }
    mapDiv.id = "map-" + Date.now();

    let map = L.map(mapDiv.id).setView([27.7172, 85.324], 13);
    let polyline = L.polyline([], { color: "blue" }).addTo(map);
    let markers = [];

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    function updateMap(lat, lng) {
        let marker = L.marker([lat, lng]).addTo(map);
        markers.push(marker);
        polyline.addLatLng([lat, lng]);
        const latInput = geopickerContainer.querySelector("#lat");
        const lngInput = geopickerContainer.querySelector("#long");
        if (latInput) {
            latInput.value = lat;
        }
        if (lngInput) {
            lngInput.value = lng;
        }
    }

    map.on("click", function (e) {
        updateMap(e.latlng.lat, e.latlng.lng);
    });

    const detectLocationButton =
        geopickerContainer.querySelector("#detect-location");
    if (detectLocationButton) {
        detectLocationButton.addEventListener("click", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        let lat = position.coords.latitude;
                        let lng = position.coords.longitude;
                        map.setView([lat, lng], 13);
                        updateMap(lat, lng);
                    },
                    function () {
                        alert("Geolocation is not available");
                    }
                );
            } else {
                alert("Geolocation is not supported by your browser");
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    if (typeof NepaliFunctions === "undefined") {
        console.error(
            "Error: NepaliFunctions is not defined. Check your Nepali date picker library inclusion."
        );
        return;
    }
    const datepickerInput = document.querySelector("#datepicker");
    if (datepickerInput) {
        new NepaliDatePicker(datepickerInput, {});
    }
});
function showNoteInput(button) {
    hideUsedOption(button, "showNoteInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showBarcode(button) {
    const formSection = button.closest(".form-section");
    if (!formSection) return;

    const barcode = formSection.querySelector(".barcode");
    if (barcode) {
        barcode.style.display = "block";
    }

    const questionTypes = formSection.querySelector(".question-types");
    if (questionTypes) {
        questionTypes.style.display = "none";
    }
}
function showQr(button) {
    const formSection = button.closest(".form-section");
    if (!formSection) return;

    const qrcode = formSection.querySelector(".qrcode");
    if (qrcode) {
        qrcode.style.display = "block";
    }

    const questionTypes = formSection.querySelector(".question-types");
    if (questionTypes) {
        questionTypes.style.display = "none";
    }
}

function openCamera() {
    let scannerDiv = document.getElementById("qr-reader");
    if (!scannerDiv) {
        scannerDiv = document.createElement("div");
        scannerDiv.id = "qr-reader";
        scannerDiv.style.width = "300px";
        document.body.appendChild(scannerDiv);
    }

    const html5QrCode = new Html5Qrcode("qr-reader");

    navigator.mediaDevices
        .getUserMedia({ video: true })
        .then(() => {
            html5QrCode
                .start(
                    { facingMode: "user" },
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 },
                    },
                    (decodedText) => {
                        console.log("QR Code Detected:", decodedText);
                        const inputField =
                            document.getElementById("decoded-text");
                        if (inputField) {
                            inputField.value = decodedText;
                            console.log(
                                "Inserted decoded text:",
                                inputField.value
                            );
                        } else {
                            console.error("Input field not found!");
                        }
                        html5QrCode.stop();
                    },
                    (error) => {
                        console.log("QR Code scan error:", error);
                    }
                )
                .catch((err) => {
                    console.log("Camera error: ", err);
                });
        })
        .catch((err) => {
            console.log("Camera permission denied: ", err);
            alert("Please allow camera access in your browser settings.");
        });
}

function showAcknowledgment(button) {
    hideUsedOption(button, "showAcknowledgement");
    formSection.querySelector(".question-types").style.display = "none";
}
function showAreaSelector(button) {
    hideUsedOption(button, "showAreaSelector");
    const questionTypes = formSection.querySelector(".question-types");
    questionTypes.style.display = "none";
}
function showRatingSelector(button) {
    const formSection = button.closest(".form-section");
    if (!formSection) return;

    const rating = formSection.querySelector(".rating-card");
    if (rating) {
        rating.style.display = "block";
    }

    const questionTypes = formSection.querySelector(".question-types");
    if (questionTypes) {
        questionTypes.style.display = "none";
    }
}
function addOption() {
    const optionsRow = document.getElementById("options-row");
    const optionCount = optionsRow.querySelectorAll(
        "th:not(:last-child)"
    ).length;

    const newOption = document.createElement("th");
    newOption.innerHTML = `<span class="option-input" contenteditable="true">Option ${optionCount}</span> <button class="delete-option ml-2 text-red-500" onclick="delOption(this)">x</button>`;

    optionsRow.insertBefore(newOption, optionsRow.lastElementChild);

    const criteriaBody = document.getElementById("criteria-body");
    criteriaBody.querySelectorAll("tr").forEach((row, index) => {
        const newCell = document.createElement("td");
        newCell.innerHTML = `<input type="radio" name="q${
            index + 1
        }" class="ml-5">`;
        if (row.lastElementChild) {
            row.insertBefore(newCell, row.lastElementChild);
        } else {
            row.appendChild(newCell);
        }
    });
}

function delOption(button) {
    const th = button.closest("th");
    const index = Array.from(th.parentNode.children).indexOf(th);

    if (index === th.parentNode.children.length - 1) return;

    th.remove();

    const criteriaBody = document.getElementById("criteria-body");
    criteriaBody.querySelectorAll("tr").forEach((row) => {
        if (row.children.length > index) {
            row.children[index].remove();
        }
    });
}

function addQuestion() {
    const criteriaBody = document.getElementById("criteria-body");
    const rowCount = criteriaBody.querySelectorAll("tr").length + 1;
    const newRow = document.createElement("tr");

    const questionCell = document.createElement("td");
    questionCell.innerHTML = `<span class="question-input" contenteditable="true">Question ${rowCount}</span> <button class="delete-question ml-2 text-red-500" onclick="delQuestion(this)">×</button>`;
    newRow.appendChild(questionCell);

    const optionsRow = document.getElementById("options-row");
    const numOptions =
        optionsRow.querySelectorAll("th:not(:last-child)").length - 1;

    for (let i = 0; i < numOptions; i++) {
        const newCell = document.createElement("td");
        newCell.innerHTML = `<input type="radio" name="q${rowCount}" class="ml-5">`;
        newRow.appendChild(newCell);
    }

    criteriaBody.appendChild(newRow);
}

function delQuestion(button) {
    button.parentNode.parentNode.remove();
}
function showMatrixInput(button) {
    hideUsedOption(button, "showMatrixInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showRankingSelector(button) {
    hideUsedOption(button, "showRankingSelector");
    formSection.querySelector(".question-types").style.display = "none";
}
function showCalculator(button) {
    hideUsedOption(button, "showCalculator");
    formSection.querySelector(".question-types").style.display = "none";
}
function showSignature(button) {
    hideUsedOption(button, "showSignature");
    formSection.querySelector(".question-types").style.display = "none";
}
function showTableInput(button) {
    hideUsedOption(button, "showTableInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showFileUploader(button) {
    hideUsedOption(button, "showFileUploader");
    formSection.querySelector(".question-types").style.display = "none";
}

function hideUsedOption(button, optionType) {
    const formSection = button.closest(".form-section");
    const questionTypes = formSection.querySelector(".question-types");
    const allOptions = questionTypes.querySelectorAll("button");
    allOptions.forEach((option) => {
        option.style.display = "none";
    });
    questionTypes.style.display = "none";
    formSection.querySelector(".add-question-button").style.display = "none";
}
function showAllOptions() {
    const allOptions = document.querySelectorAll(`.question-types button`);
    allOptions.forEach((option) => {
        option.style.display = "inline-block";
    });
}
