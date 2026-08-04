const jobForm = document.getElementById('job-form')
const tagContainer = document.getElementById('tag-container');
const submittedTagsContainer = document.getElementById('submitted-tags-container');

jobForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const tagElements = tagContainer.querySelectorAll('span');

    const tagsArray = Array.from(tagElements).map(span => {
        let cleanText = span.textContent.replace('#', '').replace('×', '');
        return cleanText.trim();
    })

    submittedTagsContainer.value = tagsArray.join(',');

    jobForm.submit();
})
