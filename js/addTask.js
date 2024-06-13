const addTask_btn = document.getElementById('add-task-btn');
const addTask_container = document.getElementById('add-task-container');

addTask_btn.addEventListener('click', () => {
    addTask_container.style.display = 'block';
});

addTask_container.addEventListener('click', (e) => {
    if (e.target === addTask_container) {
        addTask_container.style.display = 'none';
    }
});