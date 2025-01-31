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
    hideUsedOption(button, "showDistrict"); //to close the questionTypes

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
    hideUsedOption(button, "showSingleChoice");
    const formSection = button.parentElement.parentElement;
    const singleChoice = formSection.querySelector(".single-choice");

    const optionInputs = singleChoice.querySelectorAll("input[type='text']");
    optionInputs.forEach((input) => {
        input.readOnly = false;
    });

    singleChoice.style.display = "block";
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

function showMultipleChoice(button) {
    hideUsedOption(button, "showMultipleChoice");
    const formSection = button.closest(".form-section");
    const multipleChoice = formSection.querySelector(".multiple-choice");

    const optionInputs = multipleChoice.querySelectorAll("input[type='text']");
    optionInputs.forEach((input) => {
        input.readOnly = false;
    });

    multipleChoice.style.display = "block";
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

function showDatePickers(button) {
    hideUsedOption(button, "showDatePickers");
}
function showNumberSelector(button) {
    hideUsedOption(button, "showNumberSelector");
}
function showPhotoUploader(button) {
    hideUsedOption(button, "showPhotoUploader");
}
function showRatingSelector(button) {
    hideUsedOption(button, "showRatingSelector");
}
function showTextResponse(button) {
    hideUsedOption(button, "showTextResponse");
}
function showRankingSelector(button) {
    hideUsedOption(button, "showRankingSelector");
}
function showAudioUploader(button) {
    hideUsedOption(button, "showAudioUploader");
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
