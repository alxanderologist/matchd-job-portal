document.addEventListener('DOMContentLoaded', () => {
    const tabAllApps = document.getElementById('tab-all-apps');
    const tabActiveApps = document.getElementById('tab-active-apps');
    const tabInterviewApps = document.getElementById('tab-interview-apps');
    const appCards = document.querySelectorAll('.app-card');

    if (tabAllApps && tabActiveApps && tabInterviewApps) {
        
        const activeStyling = "px-3 py-1.5 bg-white text-slate-900 rounded-lg font-bold shadow-xs transition-all";
        const inactiveStyling = "px-3 py-1.5 hover:text-slate-900 hover:bg-slate-300/50 rounded-lg transition-all text-slate-500";

        function filterApplications(clickedTab, statusToKeep) {
            
            tabAllApps.className = inactiveStyling;
            tabActiveApps.className = inactiveStyling;
            tabInterviewApps.className = inactiveStyling;

            
            clickedTab.className = activeStyling;

            appCards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');

                if (statusToKeep === 'all' || statusToKeep === cardStatus) {
                    card.classList.remove('hidden');
                    card.style.display = ''; 
                } else {
                    card.classList.add('hidden');
                    card.style.display = 'none'; 
                }
            });
        }

    
        tabAllApps.addEventListener('click', () => filterApplications(tabAllApps, 'all'));
        tabActiveApps.addEventListener('click', () => filterApplications(tabActiveApps, 'active'));
        tabInterviewApps.addEventListener('click', () => filterApplications(tabInterviewApps, 'interview'));
        
    } else {
        console.error("Matchd Error: Tab buttons are missing! Check your HTML IDs.");
    }
});