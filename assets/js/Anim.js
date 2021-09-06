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

