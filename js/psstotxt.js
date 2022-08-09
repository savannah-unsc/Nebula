function altpas(){
if (document.getElementById('password').type == 'password') {
document.getElementById('password').type = 'text';
document.getElementById('password2').type = 'text';
document.getElementById('password3').type = 'text';
document.getElementById('passcon').type = 'text';
} else {
document.getElementById('password').type = 'password';
document.getElementById('password2').type = 'password';
document.getElementById('password3').type = 'password';
document.getElementById('passcon').type = 'password';
}
}
