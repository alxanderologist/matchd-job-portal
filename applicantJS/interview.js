const rescheduleInput = document.getElementById('reschedule-input');
const dateText = document.getElementById('interview-date-text');
const rescheduleBtn = document.getElementById('reschedule-btn');
const attemptsText = document.getElementById('attempts-text');

let attemptsLeft = 3;

if (rescheduleInput && dateText && rescheduleBtn) {
    
    rescheduleBtn.addEventListener('click', function() {
        if (attemptsLeft > 0 && typeof rescheduleInput.showPicker === 'function') {
            rescheduleInput.showPicker();
        }
    });

    rescheduleInput.addEventListener('change', function(event) {
        if (attemptsLeft <= 0) return;

        const selectedDate = new Date(event.target.value);
        if (isNaN(selectedDate)) return;

        const formattedDate = selectedDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        const formattedTime = selectedDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

        const companyName = dateText.innerText.split('•')[0].trim();
        dateText.innerText = `${companyName} • Scheduled for ${formattedDate} @ ${formattedTime}`;

        attemptsLeft--;

        if (attemptsText) {
            if (attemptsLeft === 1) {
                attemptsText.innerText = "1 attempt remaining";
                attemptsText.classList.replace('text-slate-400', 'text-red-500');
            } else if (attemptsLeft === 0) {
                attemptsText.innerText = "No attempts left.\nContact employer for rescheduling.";
                attemptsText.classList.replace('text-amber-500', 'text-red-500');
                
                rescheduleBtn.disabled = true;
                rescheduleBtn.classList.add('opacity-50', 'cursor-not-allowed');
                rescheduleBtn.classList.remove('hover:bg-slate-200');
            } else {
                attemptsText.innerText = `${attemptsLeft} attempts remaining`;
            }
        }

        if (attemptsLeft > 0) {
            const originalHTML = rescheduleBtn.innerHTML;
            rescheduleBtn.innerHTML = '<i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i> Updated';
            if (typeof lucide !== 'undefined') lucide.createIcons();

            setTimeout(function() {
                rescheduleBtn.innerHTML = originalHTML;
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }, 2000);
        } else {
            rescheduleBtn.innerHTML = '<i data-lucide="ban" class="w-3.5 h-3.5 text-slate-400"></i> Locked';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    });
}

const tabUpcoming = document.getElementById('tab-upcoming');
const tabCompleted = document.getElementById('tab-completed');
const viewUpcoming = document.getElementById('upcoming-view');
const viewCompleted = document.getElementById('completed-view');

if (tabUpcoming && tabCompleted && viewUpcoming && viewCompleted) {
    

    const activeClass = "px-3 py-1.5 bg-white text-slate-900 rounded-lg font-bold shadow-xs transition-all";
    const inactiveClass = "px-3 py-1.5 hover:text-slate-900 hover:bg-slate-300/50 rounded-lg transition-all text-slate-500";

    tabUpcoming.addEventListener('click', () => {
        viewUpcoming.classList.remove('hidden');
        viewCompleted.classList.add('hidden');
        
        tabUpcoming.className = activeClass;
        tabCompleted.className = inactiveClass;
    });

    tabCompleted.addEventListener('click', () => {
        viewCompleted.classList.remove('hidden');
        viewUpcoming.classList.add('hidden');
        
        tabCompleted.className = activeClass;
        tabUpcoming.className = inactiveClass;
    });
}