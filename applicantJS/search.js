document.addEventListener('DOMContentLoaded', () => {
    const searchInputs = document.querySelectorAll('header input[type="text"]');
    
    function debounce(func, delay) {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }

    searchInputs.forEach(input => {
        input.addEventListener('input', debounce((e) => {
            const query = e.target.value.trim();
            console.log(`Searching for: ${query}`);
            // Hi Jenardch: Add fetch call to your PHP search handler here
        }, 400));
    });
});