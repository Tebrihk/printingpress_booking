function validateform(){
		const passwordInput = document.getElementById("pword");
const confirmPasswordInput = document.getElementById("confirm_password");
const passwordError = document.getElementById("password_error");

confirmPasswordInput.addEventListner("input", function()
{
 if (confirmPasswordInput.value !== passwordInput.value)
 {
 passwordError.textContent = "password does not match";
 }else{
 passwordError.textContent = "";
 }
});
}