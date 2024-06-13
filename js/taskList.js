// Get the button and popup container elements
const updateBtns = document.getElementsByClassName('update-btn-form');
const updateContainers = document.getElementsByClassName('update-container');

// Add an event listener to each update button
Array.from(updateBtns).forEach((btn, index) => {
  btn.addEventListener('click', () => {
    // Toggle the display of the corresponding popup container
    updateContainers[index].style.display = 'block';
  });
});

// Add an event listener to each popup container to close it when clicked outside
Array.from(updateContainers).forEach((container) => {
  container.addEventListener('click', (e) => {
    if (e.target === container) {
      container.style.display = 'none';
    }
  });
});

// Get the button and popup container elements
const deleteBtns = document.getElementsByClassName('delete-btn-form');
const deleteContainers = document.getElementsByClassName('delete-container');

// Add an event listener to each update button
Array.from(deleteBtns).forEach((btn, index) => {
  btn.addEventListener('click', () => {
    // Toggle the display of the popup container
    deleteContainers[index].style.display = 'block';
  });
});

// Add an event listener to the popup container to close it when clicked outside
Array.from(deleteContainers).forEach((container) => {
  container.addEventListener('click', (e) => {
    if (e.target === container) {
      container.style.display = 'none';
    }
  })
});