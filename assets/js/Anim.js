// USER PROFILE SIDEBAR

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


// SELECTION SERIES

function selectSeries() {
  if (this.checked) {
    this.parentNode.parentNode.parentNode.classList.add('validCardBorder');
  } else {
    this.parentNode.parentNode.parentNode.classList.remove('validCardBorder');
  }
}

var checkbox = document.querySelectorAll("input[type=checkbox]");
for (let i = 0; i < checkbox.length; i++) {
  checkbox[i].addEventListener('click', selectSeries);
}

// DELETE MODALS

// sert à mettre dans une variable l'Id de la modal et du boutton
var deleteArticleModal = document.getElementById('deleteArticleModal');
//Je vérifie s'il trouve bien cette élément dans ma page, si oui alors il exécute la condition
//Vérification mise en place car elle parasitait ma seconde modale de suppression située sur la page seriesList 
//Il arretait la lecture à cette fonction car ne trouvait pas l'id sur la page dans laquelle j'étais
if (deleteArticleModal != null) {
  // show.bs.modal est un évènement de modal bootstrap
  deleteArticleModal.addEventListener('show.bs.modal', function (event) {
    //Sert à récupérer les données du bouton, on stocke ça dans une variable. On ne peux pas toucher au event.relatedTarget sinon ça ne marche plus
    var trigger = event.relatedTarget;
    //Je done à la variable articleId la valeur de l'attribut correspondant sur mon bouton
    var articleId = trigger.getAttribute('data-bs-id');
    //Je done à la variable articleTitle la valeur de l'attribut correspondant sur mon bouton
    var articleTitle = trigger.getAttribute('data-bs-title');

    //Je déclare l'endroit où je vais afficher mon id : ici, dans l'input 'idRecipient'
    var recipient = deleteArticleModal.querySelector('#idRecipient'); // l'id de l'endroit où tu veux que tes données apparaissent
    var articleTitleRecipient = deleteArticleModal.querySelector('#article');

    //Je stocke dans mon input la valeur stockée dans mon data-bs-test de mon bouton supprimer (l'id du patient ici)
    recipient.value = articleId;
    articleTitleRecipient.textContent = `L\'article nommé "${articleTitle}" sera définitivement supprimé.`;
  })
}


// sert à mettre dans une variable l'Id de la modal et du boutton
var deleteSeriesModal = document.getElementById('deleteSeriesModal');
// show.bs.modal est un évènement de modal bootstrap
if (deleteSeriesModal != null) {
  deleteSeriesModal.addEventListener('show.bs.modal', function (event) {
    //Sert à récupérer les données du bouton, on stocke ça dans une variable. On ne peux pas toucher au event.relatedTarget sinon ça ne marche plus
    var trigger = event.relatedTarget;
    //Je done à la variable articleId la valeur de l'attribut correspondant sur mon bouton
    var seriesId = trigger.getAttribute('data-bs-id');
    //Je done à la variable articleTitle la valeur de l'attribut correspondant sur mon bouton
    var seriesTitle = trigger.getAttribute('data-bs-title');

    //Je déclare l'endroit où je vais afficher mon id : ici, dans l'input 'idRecipient'
    var recipient = deleteSeriesModal.querySelector('#idRecipient'); // l'id de l'endroit où tu veux que tes données apparaissent
    var seriesTitleRecipient = deleteSeriesModal.querySelector('#series');

    //Je stocke dans mon input la valeur stockée dans mon data-bs-test de mon bouton supprimer (l'id du patient ici)
    recipient.value = seriesId;
    seriesTitleRecipient.textContent = `La série nommée "${seriesTitle}" sera définitivement supprimée.`;
  })
}
