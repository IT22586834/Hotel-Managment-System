<script>
  // JavaScript code for handling form submission
  document.addEventListener("DOMContentLoaded", function() {
    var form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent form submission

      // Get form values
      var nameInput = document.getElementById("name");
      var emailInput = document.getElementById("email");
      var messageInput = document.getElementById("message");

      var name = nameInput.value;
      var email = emailInput.value;
      var message = messageInput.value;

      // Perform form validation
      if (name === "" || email === "" || message === "") {
        alert("Please fill in all fields.");
        return;
      }

      // Display confirmation message
      var confirmationMessage = "Thank you, " + name + "! Your message has been sent.";
      alert(confirmationMessage);

      // Reset form
      form.reset();
    });
  });
</script>
