var triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-home-tab'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

var triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-profile-tab'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

var triggerTabList = [].slice.call(document.querySelectorAll('v-pills-messages-tab'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

var triggerTabList = [].slice.call(document.querySelectorAll('v-pills-settings-tab'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

// AJAX MODIFICATION D'ADRESSE MAIL

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
        document.querySelector('#userMail').innerHTML = '<?= $usersProfile->mail; ?>';
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