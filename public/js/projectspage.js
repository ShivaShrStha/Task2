function addFormSection() {
    const container = document.getElementById("form-container");
    const template = document.getElementById("form-section-template");
    const clone = template.cloneNode(true);
    clone.style.display = "block";
    clone.id = "";
    container.appendChild(clone);
    clone.querySelector(".add-question-button").style.display = "block";
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
    hideUsedOption(button, "showDistrict");

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
}

function showSingleChoice(button) {
    // hideUsedOption(button, "showSingleChoice");
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

// function populateOptions(select) {
//     const selectedValue = select.value;
//     const formSection = select.closest(".form-section");
//     const singleChoiceOptions = formSection.querySelector(
//         ".single-choice-options"
//     );

//     // Clear existing options
//     singleChoiceOptions.innerHTML = "";

//     let options = [];
//     switch (selectedValue) {
//         case "gender":
//             options = ["Male", "Female", "Other"];
//             break;
//         case "relation":
//             options = ["Parent", "Sibling", "Spouse", "Friend"];
//             break;
//         case "marital":
//             options = ["Single", "Married", "Divorced", "Widowed"];
//             break;
//         default:
//             options = ["Option 1", "Option 2"];
//             break;
//     }

//     options.forEach((option, index) => {
//         const newOption = document.createElement("div");
//         newOption.classList.add("flex", "items-center");
//         newOption.innerHTML = `
//             <input type="radio" name="single-choice" class="mr-2">
//             <input type="text" placeholder="Option ${index + 1}"
//                 class="w-full p-2 border border-gray-300 rounded-md"
//                 oninput="updateOptionVal(this)" value="${option}">
//         `;
//         singleChoiceOptions.appendChild(newOption);
//     });
// }

function showMultipleChoice(button) {
    // hideUsedOption(button, "showMultipleChoice");
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
function showDatePickers(button) {
    hideUsedOption(button, "showDatePickers");
    formSection.querySelector(".question-types").style.display = "none";
}
function showTimeInput(button) {
    hideUsedOption(button, "showTimeInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showPointSelector(button) {
    hideUsedOption(button, "showPointSelector");

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
function showLineInput(button) {
    hideUsedOption(button, "showLineInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showNoteInput(button) {
    hideUsedOption(button, "showNoteInput");
    formSection.querySelector(".question-types").style.display = "none";
}
function showBarcodeScanner(button) {
    hideUsedOption(button, "showBarcodeScanner");
    formSection.querySelector(".question-types").style.display = "none";
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
    hideUsedOption(button, "showRatingSelector");
    formSection.querySelector(".question-types").style.display = "none";
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
// function hideUsedOption(button, action) {
//     const formSection = button.parentElement.parentElement;
//     const usedOption = formSection.querySelector(".used-option");

//     if (!usedOption) {
//         console.error("Element '.used-option' not found");
//         return;
//     }

//     // Hide the used option
//     usedOption.style.display = "none";
//     // console.log(`Used option hidden for action: ${action}`);
// }

function showAllOptions() {
    const allOptions = document.querySelectorAll(`.question-types button`);
    allOptions.forEach((option) => {
        option.style.display = "inline-block";
    });
}
