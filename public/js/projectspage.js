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
    const nepaliDateDisplay = formSection.querySelector('#nepali-date-display');

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
        onSelect: function(dateText) {
            // Send the selected date to the server for conversion
            $.ajax({
                url: '/convert-date',
                method: 'POST',
                data: {
                    engDate: dateText,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $(nepaliCalendar).val(response.nepaliDate);
                    nepaliDateDisplay.textContent = response.nepaliDate;
                }
            });
        },
    }).datepicker("setDate", today);

    // Initialize Nepali Date Picker
    $(nepaliCalendar).nepaliDatePicker({
        onChange: function() {
            const nepaliDateText = $(this).val();
            const englishDate = LaravelNepaliDate.from(nepaliDateText).toEnglishDate(); // Convert BS to AD
            $(englishCalendar).val(englishDate);
            nepaliDateDisplay.textContent = nepaliDateText;
        },
    });

    // Function to update the time picker with the current time
    function updateTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, "0");
        const minutes = now.getMinutes().toString().padStart(2, "0");
        const seconds = now.getSeconds().toString().padStart(2, "0");
        timePickerInput.value = `${hours}:${minutes}:${seconds}`;
    }

    // Update the time picker every second
    setInterval(updateTime, 1000);
    updateTime(); // Initial call to set the time immediately
}

function showNumberSelector(button) {
    const formSection = button.parentElement.parentElement;
    const numberSelector = formSection.querySelector('.number-selector');
    numberSelector.style.display = 'block';
}

function saveNumberSelection(button) {
    const formSection = button.parentElement.parentElement;
    const numberInput = formSection.querySelector('#number-input');
    const selectedNumber = numberInput.value;
    const selectedNumberDisplay = formSection.querySelector('#selected-number-display');
    const savedNumberSection = formSection.querySelector('.saved-number');

    if (selectedNumber.trim() === '' || isNaN(selectedNumber)) {
        alert('Please enter a valid number.');
        return;
    }

    selectedNumberDisplay.textContent = selectedNumber;
    savedNumberSection.style.display = 'block';
    formSection.querySelector('.number-selector').style.display = 'none';
}

function showPhotoUploader(button) {
    const formSection = button.parentElement.parentElement;
    const photoUploader = formSection.querySelector('.photo-uploader');
    photoUploader.style.display = 'block';
}

function savePhoto(button) {
    const formSection = button.parentElement.parentElement;
    const photoInput = formSection.querySelector('#photo-input');
    const photoDisplay = formSection.querySelector('#photo-display');
    const savedPhotoSection = formSection.querySelector('.saved-photo');

    if (photoInput.files && photoInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            photoDisplay.src = e.target.result;
            savedPhotoSection.style.display = 'block';
            formSection.querySelector('.photo-uploader').style.display = 'none';
        };
        reader.readAsDataURL(photoInput.files[0]);
    } else {
        alert('Please select a photo.');
    }
}

function showSingleChoice(button) {
    const formSection = button.parentElement.parentElement;
    const singleChoice = formSection.querySelector('.single-choice');
    singleChoice.style.display = 'block';
}

function saveSingleChoice(button) {
    const formSection = button.parentElement.parentElement;
    const selectedOption = formSection.querySelector('input[name="single-choice"]:checked');
    const selectedSingleChoiceDisplay = formSection.querySelector('#selected-single-choice-display');
    const savedSingleChoiceSection = formSection.querySelector('.saved-single-choice');

    if (!selectedOption) {
        alert('Please select an option.');
        return;
    }

    selectedSingleChoiceDisplay.textContent = selectedOption.value;
    savedSingleChoiceSection.style.display = 'block';
    formSection.querySelector('.single-choice').style.display = 'none';
}

function showRatingSelector(button) {
    const formSection = button.parentElement.parentElement;
    const ratingSelector = formSection.querySelector('.rating-selector');
    ratingSelector.style.display = 'block';
}

function saveRatingSelection(button) {
    const formSection = button.parentElement.parentElement;
    const selectedRatings = formSection.querySelectorAll('input[name="rating"]:checked');
    const selectedRatingDisplay = formSection.querySelector('#selected-rating-display');
    const savedRatingSection = formSection.querySelector('.saved-rating');

    if (selectedRatings.length === 0) {
        alert('Please select at least one rating.');
        return;
    }

    const ratings = Array.from(selectedRatings).map(rating => rating.value).join(', ');
    selectedRatingDisplay.textContent = ratings;
    savedRatingSection.style.display = 'block';
    formSection.querySelector('.rating-selector').style.display = 'none';
}

function showTextResponse(button) {
    const formSection = button.parentElement.parentElement;
    const textResponse = formSection.querySelector('.text-response');
    textResponse.style.display = 'block';
}

function saveTextResponse(button) {
    const formSection = button.parentElement.parentElement;
    const textInput = formSection.querySelector('#text-input');
    const textResponseDisplay = formSection.querySelector('#text-response-display');
    const savedTextResponseSection = formSection.querySelector('.saved-text-response');

    if (textInput.value.trim() === '') {
        alert('Please enter a response.');
        return;
    }

    textResponseDisplay.textContent = textInput.value;
    savedTextResponseSection.style.display = 'block';
    formSection.querySelector('.text-response').style.display = 'none';
}

function submitForm() {
    const formSections = document.querySelectorAll('.form-section');
    const summaryContent = document.getElementById('summary-content');
    summaryContent.innerHTML = '';

    let tableHTML = '<table class="table table-bordered"><thead><tr><th>Question</th><th>Selected Number</th><th>English Date</th><th>Nepali Date</th><th>Time</th><th>Uploaded Photo</th><th>Selected Option</th><th>Selected Ratings</th><th>Text Response</th></tr></thead><tbody>';

    formSections.forEach(section => {
        const question = section.querySelector('input[type="text"]').value;
        const selectedNumber = section.querySelector('#selected-number-display').textContent;
        const englishDate = section.querySelector('#english-calendar').value;
        const nepaliDate = section.querySelector('#nepali-calendar').value;
        const time = section.querySelector('.time-picker').value;
        const photoSrc = section.querySelector('#photo-display').src;
        const selectedSingleChoice = section.querySelector('#selected-single-choice-display').textContent;
        const selectedRating = section.querySelector('#selected-rating-display').textContent;
        const textResponse = section.querySelector('#text-response-display').textContent;

        tableHTML += `<tr>
            <td>${question || ''}</td>
            <td>${selectedNumber || ''}</td>
            <td>${englishDate || ''}</td>
            <td>${nepaliDate || ''}</td>
            <td>${time || ''}</td>
            <td>${photoSrc ? `<img src="${photoSrc}" alt="Uploaded Photo" style="max-width: 100px;">` : ''}</td>
            <td>${selectedSingleChoice || ''}</td>
            <td>${selectedRating || ''}</td>
            <td>${textResponse || ''}</td>
        </tr>`;
    });

    tableHTML += '</tbody></table>';
    summaryContent.innerHTML = tableHTML;

    document.querySelector('.summary-section').style.display = 'block';
}
