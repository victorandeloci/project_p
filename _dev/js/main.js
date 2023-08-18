function docReady(fn) {
  // see if DOM is already available
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    // call on next available tick
    setTimeout(fn, 1);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

function getFormValues(element) {
  let formData = new FormData();

  element.querySelectorAll('input, textarea, select').forEach((item, i) => {
    formData.append(item.getAttribute('name'), item.value);
  });

  return formData;
}

async function sendByAction(method, action, formData = null, params = null) {
  let response = '';
  if (method == 'GET' || method == 'get') {

    params['action'] = action;
    response = await fetch(apiUrl + '?' + new URLSearchParams(params))
      .then(function (response) {
        return response.text();
      });

  } else if (method == 'POST' || method == 'post') {

    formData.append('action', action);
    response = await fetch(apiUrl, {
      method: method,
      body: formData
    })
      .then(function (response) {
        return response.text();
      });

  }

  return response;
}

docReady(function () {
  // category selector
  let categorySelector = document.getElementById('category_selector');
  if (categorySelector) {
    categorySelector.addEventListener('change', function () {
      if (categorySelector.value != null && categorySelector.value != '') {
        window.location.href = siteUrl + '/category/' + categorySelector.value;
      }
    });
  }

  // plyr audio player
  const player = new Plyr('#player');

  // contact form
  let contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();

      let formData = getFormValues(contactForm);
      sendByAction('POST', 'pp_contact', formData).then(function (response) {
        if (response != null && response != '') {
          contactForm.querySelector('button').innerHTML = response;
          contactForm.querySelector('button').setAttribute('disabled', 'true');
        }
      });
    });
  }

  // lazy load
  elementsIndexes = Array.from(document.querySelectorAll('[lazy-load-img]'));

  let initVisibleBackgrounds = function () {
    let currentScroll = document.scrollingElement.scrollTop;

    elementsIndexes.forEach((element, i) => {
      if ((currentScroll > element.getBoundingClientRect().top - 250)) {
        let background = element.getAttribute('lazy-load-img');
        element.setAttribute('src', background);
        elementsIndexes.splice(i, 1);

        element.removeAttribute('lazy-load-img');
      }
    });
  };

  if (elementsIndexes !== null && elementsIndexes.length > 0) {
    initVisibleBackgrounds();
    window.addEventListener('scroll', function (e) {
      if (elementsIndexes !== null && elementsIndexes.length > 0)
        initVisibleBackgrounds();
    }, false);
  }
});
