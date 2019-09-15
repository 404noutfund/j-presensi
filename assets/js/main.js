function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

if (hasGetUserMedia()) {
  // alert('Good to go!');
} else {
  alert('getUserMedia() is not supported by your browser');
}

function handleError(error) {
  console.error('navigator.getUserMedia error: ', error);
}

const constraints = {video: true};

(function() {
const captureVideoButton =
    document.querySelector('#screenshot .capture-button');
const screenshotButton = document.querySelector('#screenshot-button');
const img = document.querySelector('#screenshot img');
const video = document.querySelector('#screenshot video');

const canvas = document.createElement('canvas');

captureVideoButton.onclick = function() {
	alert('success');
  navigator.mediaDevices.getUserMedia(constraints).
    then(handleSuccess).catch(handleError);
};

screenshotButton.onclick = video.onclick = function() {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0);
  // Other browsers will fall back to image/png
  img.src = canvas.toDataURL('image/webp');
};

function handleSuccess(stream) {
  screenshotButton.disabled = false;
  video.srcObject = stream;
}
})();

// navigator.mediaDevices.enumerateDevices()
//   .then(gotDevices).then(getStream).catch(handleError);

// videoSelect.onchange = getStream;

// function gotDevices(deviceInfos) {
//   for (let i = 0; i !== deviceInfos.length; ++i) {
//     const deviceInfo = deviceInfos[i];
//     const option = document.createElement('option');
//     option.value = deviceInfo.deviceId;
//     if (deviceInfo.kind === 'videoinput') {
//       option.text = deviceInfo.label || 'camera ' +
//         (videoSelect.length + 1);
//       videoSelect.appendChild(option);
//     } else {
//       console.log('Found another kind of device: ', deviceInfo);
//     }
//   }
// }

// function getStream() {
//   if (window.stream) {
//     window.stream.getTracks().forEach(function(track) {
//       track.stop();
//     });
//   }

//   const constraints = {
//     video: {
//       deviceId: {exact: videoSelect.value}
//     }
//   };

//   navigator.mediaDevices.getUserMedia(constraints).
//     then(gotStream).catch(handleError);
// }