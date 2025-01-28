function addFormSection() {
    const container = document.getElementById("form-container");
    const template = document.getElementById("form-section-template");
    const clone = template.cloneNode(true);
    clone.style.display = "block";
    clone.id = "";
    container.appendChild(clone);
    clone.querySelector(".add-question-button").style.display = "block";
    clone.querySelector(".remove-options-button").style.display = "none";
}

function removeAllOptions(button) {
    const formSection = button.parentElement;
    const questionTypes = formSection.querySelector(".question-types");
    questionTypes.style.display = "none";
    formSection.querySelector(".add-question-button").style.display = "block";
    formSection.querySelector(".remove-options-button").style.display = "none";
}

function showQuestionTypes(button) {
    removeAllOptions(button);
    const formSection = button.parentElement;
    const questionTypes = formSection.querySelector(".question-types");
    const input = formSection.querySelector("input").value;

    if (input.trim() === "") {
        alert("Please enter a question first.");
        return;
    }

    questionTypes.style.display = "block";
}

function showDatePickers(button) {
    hideUsedOption(button, "showDatePickers");
    const formSection = button.parentElement.parentElement;
    const datePickers = formSection.querySelector(".date-pickers");
    datePickers.style.display = "block";
    const today = new Date();
    formSection.querySelector("#english-calendar").value = today
        .toISOString()
        .split("T")[0];
    formSection.querySelector("#nepali-calendar").value = today
        .toISOString()
        .split("T")[0];
    saveDatePickers(button);
    saveQuestionType(button, "Date");
}

function showDistrict(button) {
    const districtDropdown = document.querySelector("#district");
    districtDropdown.innerHTML = "<option>Loading...</option>"; // Placeholder during fetch

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

            const formSection = button.parentElement.parentElement;
            const districtSelector = formSection.querySelector(".district");
            districtSelector.style.display = "block";
        })
        .catch((error) => {
            console.error("Error loading districts:", error);
            districtDropdown.innerHTML =
                "<option>Error loading districts</option>";
        });
}

function showNumberSelector(button) {
    hideUsedOption(button, "showNumberSelector");
    const formSection = button.parentElement.parentElement;
    const numberSelector = formSection.querySelector(".number-selector");
    numberSelector.style.display = "block";
    saveNumberSelection(button);
}

function saveNumberSelection(button) {
    const formSection = button.parentElement.parentElement;
    const numberInput = formSection.querySelector("#number-input");
    const selectedNumber = numberInput.value;
    const selectedNumberDisplay = formSection.querySelector(
        "#selected-number-display"
    );
    const savedNumberSection = formSection.querySelector(".saved-number");

    if (selectedNumber.trim() === "" || isNaN(selectedNumber)) {
        return;
    }

    selectedNumberDisplay.textContent = selectedNumber;
    savedNumberSection.style.display = "block";
    formSection.querySelector(".number-selector").style.display = "none";
    hideUsedOption(button, "number");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showPhotoUploader(button) {
    hideUsedOption(button, "showPhotoUploader");
    const formSection = button.parentElement.parentElement;
    const photoUploader = formSection.querySelector(".photo-uploader");
    photoUploader.style.display = "block";
    savePhoto(button);
}

function savePhoto(button) {
    const formSection = button.parentElement.parentElement;
    const photoInput = formSection.querySelector("#photo-input");
    const photoDisplay = formSection.querySelector("#photo-display");
    const savedPhotoSection = formSection.querySelector(".saved-photo");

    if (photoInput.files && photoInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            photoDisplay.src = e.target.result;
            savedPhotoSection.style.display = "block";
            formSection.querySelector(".photo-uploader").style.display = "none";
            hideUsedOption(button, "photo");
            showAllOptions();
            button
                .closest(".form-section")
                .querySelector(".question-types").style.display = "none";
            button
                .closest(".form-section")
                .querySelector(".add-question-button").style.display = "none";
            showSubmitButton();
            showSubmitButtonIfNeeded();
        };
        reader.readAsDataURL(photoInput.files[0]);
    }
}

function showSingleChoice(button) {
    hideUsedOption(button, "showSingleChoice");
    const formSection = button.parentElement.parentElement;
    const singleChoice = formSection.querySelector(".single-choice");
    singleChoice.style.display = "block";
    saveSingleChoice(button);
}

function saveSingleChoice(button) {
    const formSection = button.parentElement.parentElement;
    const selectedOption = formSection.querySelector(
        'input[name="single-choice"]:checked'
    );
    const selectedSingleChoiceDisplay = formSection.querySelector(
        "#selected-single-choice-display"
    );
    const savedSingleChoiceSection = formSection.querySelector(
        ".saved-single-choice"
    );

    if (!selectedOption) {
        return;
    }

    selectedSingleChoiceDisplay.textContent = selectedOption.value;
    savedSingleChoiceSection.style.display = "block";
    formSection.querySelector(".single-choice").style.display = "none";
    hideUsedOption(button, "single-choice");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showRatingSelector(button) {
    hideUsedOption(button, "showRatingSelector");
    const formSection = button.parentElement.parentElement;
    const ratingSelector = formSection.querySelector(".rating-selector");
    ratingSelector.style.display = "block";
    saveRatingSelection(button);
}

function saveRatingSelection(button) {
    const formSection = button.parentElement.parentElement;
    const selectedRatings = formSection.querySelectorAll(
        'input[name="rating"]:checked'
    );
    const selectedRatingDisplay = formSection.querySelector(
        "#selected-rating-display"
    );
    const savedRatingSection = formSection.querySelector(".saved-rating");

    if (selectedRatings.length === 0) {
        //
        return;
    }

    const ratings = Array.from(selectedRatings)
        .map((rating) => rating.value)
        .join(", ");
    selectedRatingDisplay.textContent = ratings;
    savedRatingSection.style.display = "block";
    formSection.querySelector(".rating-selector").style.display = "none";
    hideUsedOption(button, "rating");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showTextResponse(button) {
    hideUsedOption(button, "showTextResponse");
    const formSection = button.parentElement.parentElement;
    const textResponse = formSection.querySelector(".text-response");
    textResponse.style.display = "block";
    saveTextResponse(button);
}

function saveTextResponse(button) {
    const formSection = button.parentElement.parentElement;
    const textInput = formSection.querySelector("#text-input");
    const textResponseDisplay = formSection.querySelector(
        "#text-response-display"
    );
    const savedTextResponseSection = formSection.querySelector(
        ".saved-text-response"
    );

    if (textInput.value.trim() === "") {
        //
        return;
    }

    textResponseDisplay.textContent = textInput.value;
    savedTextResponseSection.style.display = "block";
    formSection.querySelector(".text-response").style.display = "none";
    hideUsedOption(button, "text");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showMultipleChoice(button) {
    hideUsedOption(button, "showMultipleChoice");
    const formSection = button.parentElement.parentElement;
    const multipleChoice = formSection.querySelector(".multiple-choice");
    multipleChoice.style.display = "block";
    saveMultipleChoice(button);
}

function addMultipleChoiceOption(button) {
    const formSection = button.parentElement;
    const multipleChoiceOptions = formSection.querySelector(
        ".multiple-choice-options"
    );
    const optionCount = multipleChoiceOptions.children.length + 1;

    const newOption = document.createElement("div");
    newOption.innerHTML = `
        <input type="checkbox" id="multiOption${optionCount}" name="multiple-choice" value="Option ${optionCount}">
        <input type="text" value="Option ${optionCount}" class="form-control d-inline-block w-auto" oninput="updateOptionValue(this)">
    `;
    multipleChoiceOptions.appendChild(newOption);
}

function updateOptionValue(input) {
    const checkbox = input.previousElementSibling;
    checkbox.value = input.value;
}

function saveMultipleChoice(button) {
    const formSection = button.parentElement.parentElement;
    const selectedOptions = formSection.querySelectorAll(
        'input[name="multiple-choice"]:checked'
    );
    const selectedMultipleChoiceDisplay = formSection.querySelector(
        "#selected-multiple-choice-display"
    );
    const savedMultipleChoiceSection = formSection.querySelector(
        ".saved-multiple-choice"
    );

    if (selectedOptions.length === 0) {
        return;
    }

    const options = Array.from(selectedOptions)
        .map((option) => option.value)
        .join(", ");
    selectedMultipleChoiceDisplay.textContent = options;
    savedMultipleChoiceSection.style.display = "block";
    formSection.querySelector(".multiple-choice").style.display = "none";
    hideUsedOption(button, "multiple-choice");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showRankingSelector(button) {
    hideUsedOption(button, "showRankingSelector");
    const formSection = button.parentElement.parentElement;
    const rankingSelector = formSection.querySelector(".ranking-selector");
    rankingSelector.style.display = "block";
    saveRankingSelection(button);
}

function saveRankingSelection(button) {
    const formSection = button.parentElement.parentElement;
    const rankingInput = formSection.querySelector("#ranking-input");
    const selectedRankingDisplay = formSection.querySelector(
        "#selected-ranking-display"
    );
    const savedRankingSection = formSection.querySelector(".saved-ranking");

    if (rankingInput.value.trim() === "" || isNaN(rankingInput.value)) {
        return;
    }

    selectedRankingDisplay.textContent = rankingInput.value;
    savedRankingSection.style.display = "block";
    formSection.querySelector(".ranking-selector").style.display = "none";
    hideUsedOption(button, "ranking");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}

function showAudioUploader(button) {
    hideUsedOption(button, "showAudioUploader");
    const formSection = button.parentElement.parentElement;
    const audioUploader = formSection.querySelector(".audio-uploader");
    audioUploader.style.display = "block";
}

function saveAudio(button) {
    const formSection = button.parentElement.parentElement;
    const audioInput = formSection.querySelector("#audio-input");
    const audioDisplay = formSection.querySelector("#audio-display");
    const savedAudioSection = formSection.querySelector(".saved-audio");

    if (audioInput.files && audioInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            audioDisplay.src = e.target.result;
            savedAudioSection.style.display = "block";
            formSection.querySelector(".audio-uploader").style.display = "none";
            hideUsedOption(button, "audio");
            showAllOptions();
            button
                .closest(".form-section")
                .querySelector(".question-types").style.display = "none";
            button
                .closest(".form-section")
                .querySelector(".add-question-button").style.display = "none";
            showSubmitButton();
            showSubmitButtonIfNeeded();
        };
        reader.readAsDataURL(audioInput.files[0]);
    }
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
    formSection.querySelector(".remove-options-button").style.display = "block";
}

function showAllOptions() {
    const allOptions = document.querySelectorAll(`.question-types button`);
    allOptions.forEach((option) => {
        option.style.display = "inline-block";
    });
}

// function showSubmitButton() {
//     document.getElementById("submit-button").style.display = "block";
// }

// function showSubmitButtonIfNeeded() {
//     const formSections = document.querySelectorAll(".form-section");
//     let showButton = false;

//     formSections.forEach((section) => {
//         if (
//             section.querySelector(".saved-number").style.display === "block" ||
//             section.querySelector(".saved-photo").style.display === "block" ||
//             section.querySelector(".saved-single-choice").style.display ===
//                 "block" ||
//             section.querySelector(".saved-rating").style.display === "block" ||
//             section.querySelector(".saved-text-response").style.display ===
//                 "block" ||
//             section.querySelector(".saved-multiple-choice").style.display ===
//                 "block" ||
//             section.querySelector(".saved-ranking").style.display === "block"
//         ) {
//             showButton = true;
//         }
//     });

//     if (showButton) {
//         document.getElementById("submit-button").style.display = "block";
//     } else {
//         document.getElementById("submit-button").style.display = "none";
//     }
// }

function saveDatePickers(button) {
    const formSection = button.parentElement.parentElement;
    const englishDate = formSection.querySelector("#english-calendar").value;
    const nepaliDate = formSection.querySelector("#nepali-calendar").value;
    const time = formSection.querySelector(".time-picker").value;
    const savedDateSection = formSection.querySelector(".saved-date");

    if (!englishDate || !nepaliDate || !time) {
        alert("Please select a date and time.");
        return;
    }

    formSection.querySelector(".date-pickers").style.display = "none";
    hideUsedOption(button, "date");
    showAllOptions();
    button
        .closest(".form-section")
        .querySelector(".question-types").style.display = "none";
    button
        .closest(".form-section")
        .querySelector(".add-question-button").style.display = "none";
    showSubmitButton();
    showSubmitButtonIfNeeded();
}
