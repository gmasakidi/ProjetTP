// AJAX MODIFICATION D'ADRESSE MAIL

var updateMailButton = document.getElementById('confirm');

if(updateMailButton != null){
  document.querySelector('#confirm').addEventListener('click', () => {
    document.querySelector('#userMail').innerHTML = '';
    document.querySelector('#mailError').innerHTML = '';
    document.querySelector('#mailError').classList.remove('invalid-feedback');
    document.querySelector('#mailError').classList.remove('valid-feedback');
    mail.classList.remove('is-invalid');
    mail.classList.remove('is-valid');
    let ajax = true;
    let xmlhttp = new XMLHttpRequest();
  
    xmlhttp.onreadystatechange = function () {
  
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        if (this.responseText == 1) {
          document.querySelector('#mailError').innerHTML = 'Votre adresse mail a bien été modifiée.';
          document.querySelector('#userMail').innerHTML = mail.value;
          document.querySelector('#mailError').classList.add('valid-feedback');
          mail.classList.add('is-valid');
        } else {
          let formErrors = JSON.parse(this.responseText);
          console.log(formErrors.mail);
          document.querySelector('#mailError').innerHTML = formErrors.mail;
          document.querySelector('#mailError').classList.add('invalid-feedback');
          mail.classList.add('is-invalid');
        }
      }
    }
    xmlhttp.open('GET', 'controllers/userProfileController.php?ajax=' + ajax + '&mail=' + mail.value);
    xmlhttp.send();
});
}

// AJAX MODIFICATION DE MOT DE PASSE

var updatePasswordButton = document.querySelector('#confirmPasswordChange');

  if(updatePasswordButton != null){
    document.querySelector('#confirmPasswordChange').addEventListener('click', () => {
      document.querySelector('#passwordError').innerHTML = '';
      document.querySelector('#passwordError').classList.remove('invalid-feedback');
      document.querySelector('#passwordError').classList.remove('valid-feedback');
      password.classList.remove('is-invalid');
      password.classList.remove('is-valid');
      document.querySelector('#confirmPasswordError').innerHTML = '';
      document.querySelector('#confirmPasswordError').classList.remove('invalid-feedback');
      document.querySelector('#confirmPasswordError').classList.remove('valid-feedback');
      confirmPassword.classList.remove('is-invalid');
      confirmPassword.classList.remove('is-valid');
    
      let passwordAjax = true;
      let xmlhttp = new XMLHttpRequest();
    
      xmlhttp.onreadystatechange = function () {
    
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          if (this.responseText == 1) {
            document.querySelector('#confirmPasswordError').innerHTML = 'Votre mot de passe a bien été modifié.';
            document.querySelector('#confirmPasswordError').classList.add('valid-feedback');
            password.classList.add('is-valid');
            confirmPassword.classList.add('is-valid');
          } else {
            let formErrors = JSON.parse(this.responseText);
            console.log(formErrors.password);
            document.querySelector('#passwordError').innerHTML = formErrors.password;
            document.querySelector('#confirmPasswordError').innerHTML = formErrors.confirmPassword;
            document.querySelector('#passwordError').classList.add('invalid-feedback');
            document.querySelector('#confirmPasswordError').classList.add('invalid-feedback');
            password.classList.add('is-invalid');
            confirmPassword.classList.add('is-invalid');
          }
        }
      }
      xmlhttp.open('GET', 'controllers/userProfileController.php?passwordAjax=' + passwordAjax + '&password=' + password.value + '&confirmPassword=' + confirmPassword.value);
      xmlhttp.send();
  });
  }

//AJAX RESULTAT RECHERCHE SERIE

var seriesSearchButton = document.querySelector('#seriesSearchButton');

if(seriesSearchButton != null){
  document.querySelector('#seriesSearchButton').addEventListener('click', () => {

    let ajax = true;
    let xmlhttp = new XMLHttpRequest();
  
    xmlhttp.onreadystatechange = function () {
  
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText != false) {
          document.querySelector('#searchResultNumber').classList.remove('d-none');
          document.querySelector('#searchResultContent').classList.remove('d-none');
          let seriesResult = JSON.parse(this.responseText);
          for (let series of seriesResult) {
            console.log(series);
            // document.getElementById('test').innerHTML += '<li>' + series.title + '</li>';
            
          }
        }
      }
    }
    xmlhttp.open('GET', 'controllers/seriesPageController.php?seriesSearchAjax=' + ajax + '&search=' + search.value);
    xmlhttp.send();
  });
}