const tagContainer = document.getElementById('profile-tag-container');
const input = document.getElementById('profile-tag-input');
const button = document.getElementById('profile-tag-button');
const saveProfileBtn = document.getElementById('save-profile-btn');

function addTag() {
    const inputTag = input.value;

    if (inputTag === "") {
        return;
    }

    const newTag = document.createElement('span');
    newTag.className = "bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5 animate-fade-in";

    const tag = document.createTextNode(inputTag);

    const xButton = document.createElement('button');
    xButton.setAttribute('type', 'button');
    xButton.className = "hover:text-red-500 transition-colors";
    

    xButton.innerHTML = '<i data-lucide="x" class="w-3 h-3"></i>';

    newTag.appendChild(tag);
    newTag.appendChild(xButton);
    tagContainer.appendChild(newTag);


    input.value = "";
 
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}


if (button) {
    button.addEventListener("click", addTag);
}

if (input) {
    input.addEventListener("keydown", (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            addTag();
        }
    });
}

if (tagContainer) {
    tagContainer.addEventListener("click", (event) => {
        const clickedBtn = event.target.closest('button');
        if (clickedBtn) {
            const parentSpan = clickedBtn.closest('span');
            if (parentSpan) {
                parentSpan.remove();
            }
        }
    });
}


if (saveProfileBtn) {
    saveProfileBtn.addEventListener('click', async () => {
        const originalText = saveProfileBtn.innerHTML;
        saveProfileBtn.innerHTML = `<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Saving...`;
        if (typeof lucide !== 'undefined') lucide.createIcons();

        try {
            await new Promise(resolve => setTimeout(resolve, 1000));
            alert('Profile changes saved successfully!');
        } catch (error) {
            console.error("Failed to save profile");
        } finally {
            saveProfileBtn.innerHTML = originalText;
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    });
}

const dropZone = document.getElementById('resume-drop-zone');
const fileInput = document.getElementById('resume-file-input');
const fileNameDisplay = document.getElementById('current-file-name');

if (dropZone && fileInput) {
    
    
    dropZone.addEventListener('click', function(event) {
        if (event.target !== fileInput) {
            fileInput.click();
        }
    });

   
    fileInput.addEventListener('change', function() {
        processFile(this.files);
    });

   
    dropZone.addEventListener('dragover', function(event) {
        event.preventDefault(); 
        
        dropZone.classList.add('border-[#1f48ff]', 'bg-blue-50/50'); 
    });

    dropZone.addEventListener('dragleave', function(event) {
        event.preventDefault();
        
        dropZone.classList.remove('border-[#1f48ff]', 'bg-blue-50/50');
    });

    
    dropZone.addEventListener('drop', function(event) {
        event.preventDefault();
        dropZone.classList.remove('border-[#1f48ff]', 'bg-blue-50/50');
        
        
        if (event.dataTransfer.files.length > 0) {
            fileInput.files = event.dataTransfer.files; 
            processFile(event.dataTransfer.files);
        }
    });
}


function processFile(files) {
    if (files.length === 0) return;

    const file = files[0];
    const maxSize = 5 * 1024 * 1024; 

    
    if (file.size > maxSize) {
        alert("File is too large! Please upload a document under 5MB.");
        fileInput.value = ""; 
        return;
    }

   
    const validExtensions = ['.pdf', '.doc', '.docx'];
    const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
    
    if (!validExtensions.includes(fileExtension)) {
        alert("Invalid file format. Please upload a PDF or DOCX file.");
        fileInput.value = ""; 
        return;
    }

    if (fileNameDisplay) {

        fileNameDisplay.innerText = "Ready to save: " + file.name;
        fileNameDisplay.classList.add('bg-blue-50', 'text-[#1f48ff]', 'border-[#1f48ff]/30');
    }
}