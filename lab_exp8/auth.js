function validateSignup() {
  let name = document.forms["signup"]["name"].value;
  let email = document.forms["signup"]["email"].value;
  let password = document.forms["signup"]["password"].value;

  if (name === "" || email === "" || password === "") {
    alert("All fields are required");
    return false;
  }

  if (password.length < 6) {
    alert("Password must be at least 6 characters");
    return false;
  }

  return true;
}

function validateLogin() {
  let email = document.forms["login"]["email"].value;
  let password = document.forms["login"]["password"].value;

  if (email === "" || password === "") {
    alert("All fields required");
    return false;
  }

  return true;
}