const tagContainer = document.getElementById('tag-container');
const input = document.getElementById('tag-input-field');
const button = document.getElementById('tag-button');

function addTag(){
    const inputTag = input.value;

    if (inputTag === "") {
        return
    }

    const newTag = document.createElement('span');
    newTag.className = "bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-full inline-flex items-center gap-1.5";

    const tag = document.createTextNode(`#${inputTag}`);

    const xButton = document.createElement('button');
    xButton.setAttribute('type', 'button')
    xButton.className = "hover:text-red-500"
    xButton.innerHTML = '&times'

    newTag.appendChild(tag)
    newTag.appendChild(xButton)

    tagContainer.appendChild(newTag)

    input.value = ""
}

button.addEventListener("click", addTag());
input.addEventListener("keydown", (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        addTag();
    }
});

tagContainer.addEventListener("click", (event) => {
    if (event.target.tagName === 'BUTTON') {
        const parentSpan = event.target.closest('span')
        if (parentSpan) {
            parentSpan.remove()
        }
    }
})

