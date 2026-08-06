document.addEventListener('DOMContentLoaded', () => {
    const mainGrid = document.querySelector('.grid-cols-1.lg\\:grid-cols-3');
    
    if (mainGrid) {
        mainGrid.addEventListener('click', (e) => {
            const applyBtn = e.target.closest('.apply-job-btn');
            
            if (applyBtn) {
                const jobId = applyBtn.getAttribute('data-job-id');
                submitApplication(jobId, applyBtn);
            }
        });
    }

    async function submitApplication(jobId, btnElement) {
        const originalText = btnElement.innerHTML;
        btnElement.innerHTML = `<i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i> Applying...`;
        btnElement.disabled = true;
        if (typeof lucide !== 'undefined') lucide.createIcons();

        setTimeout(() => {
            btnElement.innerHTML = `<i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Applied`;
            btnElement.classList.replace('bg-[#1f48ff]', 'bg-emerald-600');
            btnElement.classList.replace('hover:bg-[#1a3ed6]', 'hover:bg-emerald-700');
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }, 800);
    }
});