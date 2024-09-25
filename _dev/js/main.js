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

function formatSeconds(s) {
  return (s - (s %= 60)) / 60 + (9 < s ? ':' : ':0') + s;
}

function dragElement(elmnt) {
  let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

docReady(function () {
  console.log("Machines aren't capable of evil. Humans make them that way. - Lucca");

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
  let playerElements = document.querySelectorAll('audio');
  if (playerElements) {
    playerElements.forEach((audioElement) => {
      if (!audioElement.classList.contains('playlist-audio')) {
        let player = new Plyr(audioElement, {
          controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'download', 'settings']
        });
      }
    });
  }

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

  // playlist player
  let playlistBtns = document.querySelectorAll('.playlist-play-btn');
  if (playlistBtns != null && playlistBtns.length > 0) {
    playlistBtns.forEach((playlistBtn) => {
      playlistBtn.addEventListener('click', function (e) {
        e.preventDefault();

        let slug = '';
        if (e.target.tagName == 'path') {          
          slug = e.target.parentElement.parentElement.getAttribute('data-slug');
        } else if (e.target.tagName == 'svg') {
          slug = e.target.parentElement.getAttribute('data-slug');
        } else {
          slug = e.target.getAttribute('data-slug');
        }

        let targetUrl = siteUrl + '/playlist/' + slug + '?mode=player';

        if (document.getElementById('playlistBox')) {
          document.getElementById('playlistBoxIframe').setAttribute('src', targetUrl);
          document.getElementById('playlistBox').classList.add('show');
        }
      });
    });
  }

  // playlist draggable box
  if (document.getElementById('playlistBox')) {    
    dragElement(document.getElementById('playlistBox'));
  }

  // playlist player controls
  let playlistPlayerMedia = document.getElementById('playlistAudio');
  if (playlistPlayerMedia) {
    let playBtn = document.getElementById('ppPlay');
    let pauseBtn = document.getElementById('ppPause');
    let stopBtn = document.getElementById('ppStop');
    let backwardBtn = document.getElementById('ppBackward');
    let forwardBtn = document.getElementById('ppForward');
    let previousBtn = document.getElementById('ppPrevious');
    let nextBtn = document.getElementById('ppNext');
    let trackDurationLabel = document.getElementById('ppTrackDuration');
    let playlistPlayerPosition = document.getElementById('playlistPlayerPosition');

    // startup
    playlistPlayerMedia.addEventListener('canplay', function (e) {
      // track details
      trackDurationLabel.innerHTML = formatSeconds(Math.floor(playlistPlayerMedia.duration));

      // enables play
      playBtn.removeAttribute('disabled');

      // time position
      playlistPlayerMedia.addEventListener('timeupdate', function (e) {
        let seconds = Math.floor(playlistPlayerMedia.currentTime);
        playlistPlayerPosition.innerHTML = formatSeconds(seconds);
      });
    });

    // track selector
    let selector = document.querySelector('#ppTrackSelector select');
    selector.addEventListener('change', function () {
      // update track duration label
      trackDurationLabel.innerHTML = 'Carregando...';

      let mp3Url = selector.value;
      if (mp3Url != null && mp3Url != '') {
        // disable all buttons
        playBtn.setAttribute('disabled', true);
        pauseBtn.setAttribute('disabled', true);
        stopBtn.setAttribute('disabled', true);
        backwardBtn.setAttribute('disabled', true);
        forwardBtn.setAttribute('disabled', true);
        previousBtn.setAttribute('disabled', true);
        nextBtn.setAttribute('disabled', true);

        playlistPlayerMedia.setAttribute('src', mp3Url);
      }
    });

    // play btn    
    playBtn.addEventListener('click', function () {
      playlistPlayerMedia.play();
      playBtn.setAttribute('disabled', true);
      pauseBtn.removeAttribute('disabled');
      stopBtn.removeAttribute('disabled');

      // time controls
      backwardBtn.removeAttribute('disabled');
      forwardBtn.removeAttribute('disabled');
    });

    // pause btn    
    pauseBtn.addEventListener('click', function () {
      playlistPlayerMedia.pause();
      pauseBtn.setAttribute('disabled', true);
      playBtn.removeAttribute('disabled');
    });

    // stop btn    
    stopBtn.addEventListener('click', function () {
      playlistPlayerMedia.pause();
      playlistPlayerMedia.load();

      pauseBtn.setAttribute('disabled', true);
      stopBtn.setAttribute('disabled', true);
      playBtn.removeAttribute('disabled');
      backwardBtn.setAttribute('disabled', true);
      forwardBtn.setAttribute('disabled', true);
    });

    // backward btn    
    backwardBtn.addEventListener('click', function () {
      playlistPlayerMedia.currentTime = (playlistPlayerMedia.currentTime - 15);
    });

    // backward btn    
    forwardBtn.addEventListener('click', function () {
      playlistPlayerMedia.currentTime = (playlistPlayerMedia.currentTime + 15);
    });
  }
});
