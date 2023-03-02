//password show/hide
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#id_password');

togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('bi-eye-slash-fill');
    this.classList.toggle('bi-eye-fill');
});

const togglePassword02 = document.querySelector('#togglePassword02');
const password02 = document.querySelector('#id_password02');

togglePassword02.addEventListener('click', function (e) {
    const type = password02.getAttribute('type') === 'password' ? 'text' : 'password';
    password02.setAttribute('type', type);
    this.classList.toggle('bi-eye-slash-fill');
    this.classList.toggle('bi-eye-fill');
});

//input file preview
function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("image-file-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

//document.getElementById('image-file').onchange = function () {
//    alert('Selected file: ' + this.value);
//};

//clear edit form data
function clearEditForm() {
    document.querySelector('#name').value = '';
    document.querySelector('#email').value = '';
    document.querySelector('#role').value = '1';
    document.querySelector('#dob').value = '';
    document.querySelector('#phone').value = '';
    document.querySelector('#address').value = '';
    document.querySelector('#profile').value = '';
    document.querySelector('#image-file-preview').src = '';
    document.querySelector('#id_password').value = '';
    document.querySelector('#id_password02').value = '';
}

function clearPostEditForm() {
    document.querySelector('#title').value = '';
    document.querySelector('#description').value = '';
    document.querySelector('#status').value = '1';
}



