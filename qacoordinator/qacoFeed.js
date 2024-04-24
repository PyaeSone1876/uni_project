document.addEventListener("DOMContentLoaded", function () {
  // Select the post button and the text area by their IDs
  const postButton = document.getElementById("btnSubmit");
  const textArea = document.getElementById("postContent");
  const backFilter = document.getElementById("backFilter"); // Select backFilter by id
  const statusPlace = document.getElementById("statusplace"); // Select statusplace by id
  const btnBackNewIdea = document.getElementById("btnBackNewIdea"); // Select btnBackNewIdea by id
  const btnIdea = document.getElementById("btnIdea");

  // Initially, disable the post button if the text area is empty
  if (textArea.value.trim() === "") {
    postButton.disabled = true;
  }

  // Function to toggle hover effect based on text area content
  function toggleHoverEffect() {
    if (textArea.value.trim() === "") {
      // If text area is empty, add disabled-hover class to disable hover effect
      postButton.classList.add("disabled-hover");
    } else {
      // If text area has content, remove disabled-hover class to enable hover effect
      postButton.classList.remove("disabled-hover");
      // Change the hover effect to green when there is text in the text area
      postButton.classList.add("text-present-hover");
    }
  }

  // Add an event listener to the text area to enable/disable the post button based on its content
  textArea.addEventListener("input", function () {
    if (textArea.value.trim() !== "") {
      // Enable the post button and change its background color to blue if the text area is not empty
      postButton.disabled = false;
      // postButton.style.backgroundColor = 'blue';
    } else {
      // Disable the post button and remove any background color styling if the text area is empty
      postButton.disabled = true;
      postButton.style.backgroundColor = "";
    }
    // Toggle hover effect based on text area content
    toggleHoverEffect();
  });

  // Initial toggle of hover effect
  toggleHoverEffect();

  // Add event listener to btnBackNewIdea
  btnBackNewIdea.addEventListener("click", function () {
    // Hide statusplace and backFilter
    statusPlace.style.display = "none";
    backFilter.style.display = "none";
    document.body.style.overflow = "auto"; // Set body overflow to auto
  });

  btnIdea.addEventListener("click", function () {
    statusPlace.style.display = "block"; // Show statusplace
    backFilter.style.display = "block"; // Show backFilter
    document.body.style.overflow = "hidden"; // Set body overflow to hidden
  });
});
