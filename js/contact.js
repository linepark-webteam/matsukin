document.addEventListener("DOMContentLoaded", function() {
  let errorFieldId = document.getElementById('errorField').value;
  if (errorFieldId && document.getElementById(errorFieldId)) {
      document.getElementById(errorFieldId).focus();
  }
});
