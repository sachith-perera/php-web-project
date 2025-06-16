document.addEventListener('DOMContentLoaded', function () {
    const toastElement = document.getElementById('myToast');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();

    const goBackButton = document.getElementById('goBackButton');
      goBackButton.addEventListener('click', function () {
        history.back(); // Navigate to the previous page
      });
  });