

async function checkLogin(){
    const username  = document.getElementById('username').value;
    const password  = document.getElementById('password').value;

    const hashedPassword = CryptoJS.MD5(password).toString();

    const loginData ={
        username:username,
        password:hashedPassword
    };

    try{
        const response = await fetch('http://localhost/Assignment3/api/get_user.php',{
            method:'POST',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify(loginData)
        });

        if (response.ok){
            const data = await response.json();
            if(data.id==1){
                sessionStorage.setItem('username', data.userName);
                window.location.href = 'patient.php';
            }else{
                showToast('Login failed: ' + data.message);
            }
        }else{
            showToast('Login failed: Server error');
        }

        
    }catch (error) {
        console.error('Error:', error);
        showToast('Login failed: Network error');
      }

}

function showToast(message) {
    // Select the toast element
    const toastElement = document.getElementById('liveToast');
    const toastBody = toastElement.querySelector('.toast-body');

    // Set the new message
    toastBody.textContent = message;

    // Initialize the toast
    const toast = new bootstrap.Toast(toastElement);

    // Show the toast
    toast.show();
  }