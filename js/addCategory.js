const addCategory_btn = document.getElementById('add-category-btn');
const addCategory_container = document.getElementById('add-category-container');

addCategory_btn.addEventListener('click', () => {
    addCategory_container.style.display = 'block';
});

addCategory_container.addEventListener('click', (e) => {
    if (e.target === addCategory_container) {
        addCategory_container.style.display = 'none';
    }
});