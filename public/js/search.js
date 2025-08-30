document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="q"]');
    const resultsDiv = document.getElementById('search-results');

    if (!searchInput || !resultsDiv) return;

    let timeout = null;

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();

        clearTimeout(timeout);

        if(query.length < 2) {
            resultsDiv.classList.add('hidden');
            resultsDiv.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {
            fetch(`/products/ajax-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    resultsDiv.classList.remove('hidden');
                    resultsDiv.innerHTML = data.map(item => `
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                            <div class="font-bold text-gray-800 text-sm">${item.title}</div>
                            <div class="text-gray-500 text-xs">${item.category}</div>
                        </a>
                    `).join('');
                } else {
                    resultsDiv.classList.remove('hidden');
                    resultsDiv.innerHTML = '<div class="px-4 py-2 text-gray-400 text-sm">نتیجه ای یافت نشد</div>'
                }
            });
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if(!searchInput.contains(e.target) && !resultsDiv.contains(e.target)) {
            resultsDiv.classList.add('hidden');
        }
    });
});